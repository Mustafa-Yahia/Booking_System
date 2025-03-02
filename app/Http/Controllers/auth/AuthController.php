<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in as administrator!');
            } elseif ($user->role === 'lessor') {
                return redirect()->route('lessor.dashboard')->with('success', 'Welcome Lessor!');
            } else {
                return redirect()->route('index');
            }
        }

        return back()->withErrors(['email' => 'Invalid login details.'])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => ['nullable', 'regex:/^(079|078|077)[0-9]{7}$/'],
            'address' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
        ]);

        // Create the user record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // After registration, redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Logout successfully!');
    }
}
