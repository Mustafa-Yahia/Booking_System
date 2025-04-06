<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use DatePeriod;
use DateTime;
use DateInterval;
use App\Models\Property;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexForLessor(Property $property)
    {
        $bookings = Booking::where('property_id', $property->id)->with('user')->get();
        return view('lessor.bookings.index', compact('bookings', 'property'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('booking.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'property_id' => 'required|integer',
        'user_id' => 'required|string',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d|after:start_date',
        'total' => 'required|numeric'
    ]);

    $booking = Booking::create([
        'user_id' => $request->user_id,
        'property_id' => $request->property_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => 'pending',
        'total' => $request->total,
    ]);

    $booking_id = $booking->id;

    Payment::create([
        'user_id' => $request->user_id,
        "booking_id" => $booking_id,
        'amount' => $request->total,
        'payment_method' => 'visa',
        'status' => 'completed'
    ]);

    // ✅ إرجاع booking_id للـ JavaScript لكي يتم تخزينه
    return response()->json([
        'success' => true,
        'message' => 'Booking processed successfully',
        'data' => $validatedData,
        'booking_id' => $booking_id,
        'payment_status' => 'completed'
    ], 200);
}


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking->update($request->only( 'status'));

        return redirect()->back()->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }

    public function getBookedDates($propertyId) {
        $bookings = Booking::where('property_id', $propertyId)->get(['start_date', 'end_date']);
         // get all booked dates for the property

        $disabledDates = [];

        foreach($bookings as $booking) {
            $start = new DateTime($booking->start_date);
            $end = new DateTime($booking->end_date);
            // Adjust the end date to include the final day
            $end->modify('+1 day');

            $range = new DatePeriod($start, new DateInterval('P1D'), $end);
            // dd($range);
            foreach($range as $date) {
                $disabledDates[] = $date->format('Y-m-d');
            }
        }
        // return dd($disabledDates);
        return response()->json($disabledDates);

    }
}
