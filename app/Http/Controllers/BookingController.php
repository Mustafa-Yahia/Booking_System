<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $booking->update($request->only('total_price', 'status'));

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
}
