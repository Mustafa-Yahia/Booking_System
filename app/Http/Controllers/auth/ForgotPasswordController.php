<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // عرض صفحة طلب إعادة تعيين كلمة المرور
    public function showLinkRequestForm()
    {
        return view('auth.forgetpassword');
    }

    // إرسال رابط إعادة تعيين كلمة المرور
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Reset link sent to your email.')
            : back()->withErrors(['email' => __($status)]);
    }
}
