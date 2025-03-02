<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use DatePeriod;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $datetime1 = new DateTime($request->checkin);
        $datetime2 = new DateTime($request->checkout);
        $days = $datetime1->diff($datetime2)->format('%a');

        // dd($days * $request->price );
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'guests' => 'required|numeric',
            'property_id' => 'required|exists:properties,id'
        ]);

        Booking::create([
            'user_id' => $request->user_id,
            'property_id' => $request->property_id,
            'start_date' => $request->checkin,
            'end_date' => $request->checkout,
            'status' => 'pending',
            'total' => $request->price * ($days + 1),

        ]);

        return "done";

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
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
