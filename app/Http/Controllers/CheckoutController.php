<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCreditCardForm()
    {
        return view('credit-card');
    }

    public function index()
    {
        $user = Auth::user();

        $bookings = Booking::with('property')
            ->where('user_id', $user->id)
            ->whereDoesntHave('payment')
            ->get();

        $totalAmount = $bookings->sum(function ($booking) {
            return $booking->property->price_per_day * $booking->days_count;
        });

        return view('checkout', compact('bookings', 'totalAmount'));
    }

    public function processPayment(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please log in to make a payment.'], 401);
        }

        $user = Auth::user();

        $request->validate([
            'cardNumber' => 'required|digits:16',
            'expiry' => 'required|regex:/^(0[1-9]|1[0-2])\/\d{2}$/',
            'cvv' => 'required|digits:3',
            'payment_method' => 'required|string',
        ]);

        $bookings = Booking::where('user_id', $user->id)
            ->whereDoesntHave('payment')
            ->get();

        if ($bookings->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No unpaid bookings found.'], 400);
        }

        $totalAmount = $bookings->sum(fn($booking) => $booking->property->price_per_day * $booking->days_count);

        foreach ($bookings as $booking) {
            Payment::create([
                'user_id' => $user->id,
                'booking_id' => $booking->id,
                'amount' => $booking->property->price_per_day * $booking->days_count,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Payment successful!']);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['success' => true, 'message' => 'Booking deleted successfully.']);
    }
}
