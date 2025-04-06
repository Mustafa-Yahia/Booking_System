<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile() {
        $bookings = Booking::where('user_id', Auth::user()->id)->get();


        return view('user.profile', compact('bookings'));
    }

    public function index() {
        //
    }


    public function edit(string $id, string $ref)
    {
        $user = User::find($id);
        if($ref == 'personal') {
            return view('user.edit', compact('user'));
        }

        return view('user.editPassword', compact('user'));
    }

    public function update(Request $request, string $id)
    {

        $user = User::find($id);

        if($request->has('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $image->storeAs('public/images/user', $imageName);

                $user->update([
                    'image' => 'images/user/' . $imageName,
                ]);
            }

            return redirect()->route('profile');
        }

        if($request->has('name')) {

            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'phone' => 'required|string',
                'address' => 'nullable|string',
            ]);

            $user->update($fields);
            return redirect()->route('profile');
        }

       if($request->has('password')) {

            $fields = $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|confirmed|min:6',
            ]);
            if ($request->password !== $request->password_confirmation) {
                return back()->withErrors(['password' => 'The password confirmation does not match.']);
            }
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $user->update([
                'password' => bcrypt($request->password)
            ]);

            return redirect()->route('profile')->with('success', 'Password updated successfully.');


        }
    }


}
