<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;  

class PaymentController extends Controller
{
    
    public function index()
    {
        $user = Auth::user(); 
        $cartItems = Payment::with(['booking.property', 'user'])
        ->where('user_id', auth()->id())  
        ->get();
    
        $totalPrice = $cartItems->sum('amount');

        return view('payment.paymentt', compact('cartItems', 'totalPrice', 'user'));
    }

    
    public function remove($id)
    {
        $cartItem = Payment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $cartItem->delete();

        return redirect()->route('payment.index')->with('success', 'Payment was successfully deleted.');    }

   
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'     => 'required|exists:bookings,id',
            'amount'         => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:50',
            'status'         => 'required|in:pending,completed,failed',
        ]);

        Payment::create([
            'user_id'        => Auth::id(),
            'booking_id'     => $request->booking_id,
            'amount'         => $request->amount,
            'payment_method' => $request->payment_method,
            'status'         => $request->status,
        ]);

        return redirect()->route('Payment.index')->with('success', 'The active payment has been added.');    }
}
