<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\PropertyImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ======= Users =======
    public function indexUsers(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('role') && !empty($request->role)) {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    // -------------------------------------------------------------------------------------------------------------------------------

    public function createUser()
    {
        return view('admin.users.create');
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'address' => 'required',
            'role' => 'required|in:admin,lessor,renter',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'address' => $request->address,

        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,lessor,renter',
        ]);

        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    // ======= Properties =======
    public function indexProperties(Request $request)
    {
        $query = Property::with('images');

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price_per_day', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price_per_day', 'desc');
            }
        }

        $properties = $query->get();

        return view('admin.properties.index', compact('properties'));
    }

    // -------------------------------------------------------------------------------------------------------------------------------

// public function storeProperty(Request $request)
// {
//     $request->validate([
//         'title' => 'required',
//         'description' => 'required',
//         'location' => 'required',
//         'price_per_day' => 'required|numeric',
//         'status' => 'required',
//         'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
//     ]);

//     $property = Property::create([
//         'user_id' => auth()->id(),
//         'title' => $request->title,
//         'description' => $request->description,
//         'location' => $request->location,
//         'price_per_day' => $request->price_per_day,
//         'status' => $request->status,
//     ]);

//     if($request->hasFile('images')) {
//         foreach($request->file('images') as $image) {
//             $path = $image->store('property_images', 'public');

//             PropertyImage::create([
//                 'property_id' => $property->id,
//                 'image_path' => $path
//             ]);
//         }
//     }

//     return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
// }
    // -------------------------------------------------------------------------------------------------------------------------------

public function destroy($id)
{
    $property = Property::findOrFail($id);

    foreach($property->images as $image) {
        Storage::delete('public/' . $image->image_path);
        $image->delete();
    }

    $property->delete();

    return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
}

    // -------------------------------------------------------------------------------------------------------------------------------

    // ======= Bookings =======
    public function indexBookings(Request $request)
    {
        $query = Booking::with(['property', 'user']);

        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('property', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    // -------------------------------------------------------------------------------------------------------------------------------

    public function showBooking(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
    // -------------------------------------------------------------------------------------------------------------------------------

    // ======= Stats =======
    public function showStats()
    {
        $propertiesCount = Property::count();
        $usersCount = User::count();
        $bookingsCount = Booking::count();
        $totalRevenue = Booking::sum('total');

        $monthlyRevenue = Booking::selectRaw('SUM(total) as revenue, MONTH(start_date) as month')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->get();

        $monthlyBookings = Booking::selectRaw('COUNT(id) as bookings, MONTH(start_date) as month')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->get();

        $revenueData = array_fill(1, 12, 0);
        $bookingsData = array_fill(1, 12, 0);

        foreach ($monthlyRevenue as $revenue) {
            $revenueData[$revenue->month] = $revenue->revenue;
        }

        foreach ($monthlyBookings as $booking) {
            $bookingsData[$booking->month] = $booking->bookings;
        }

        return view('admin.stats', compact('propertiesCount', 'usersCount', 'bookingsCount', 'totalRevenue', 'revenueData', 'bookingsData'));
    }


        // ======= Revie =======
        public function indexRevie($propertyId)
    {
        $property = Property::with('reviews.user')->findOrFail($propertyId);
       $reviews = $property->reviews()->paginate(7);

        return view('admin.properties.reviews', compact('property', 'reviews'));
    }

    public function destroyRevie($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }


}
