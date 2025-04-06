<?php


    namespace App\Http\Controllers;

    use App\Models\Notification;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Payment;
    use Illuminate\Http\Request;

    class PaymentController extends Controller
    {
        public function index()
        {
            return view('payment.credit-card');
        }

        public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'amount' => 'required|numeric',
        'status' => 'required|string',
        'booking_id' => 'required|exists:bookings,id', // تأكد من أن الحجز موجود
    ]);

    $payment = Payment::create([
        'user_id' => $request->user_id,
        'amount' => $request->amount,
        'status' => $request->status,
        'booking_id' => $request->booking_id, // تأكد من تمرير booking_id هنا
    ]);

    return response()->json(['success' => true, 'message' => 'Payment recorded successfully']);
}

    }
