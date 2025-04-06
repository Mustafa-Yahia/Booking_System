<?php

namespace App\Http\Controllers;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Review;
use App\Models\Property;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;


class PropertyController extends Controller
{


    public function dashboard()
{
    if (Auth::check() && Auth::user()->role == "lessor") {
        $userId = Auth::id();


        $myPropertiesCount = Property::where('user_id', $userId)->count();


        $myBookingsCount = Booking::whereHas('property', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();


        $myTotalRevenue = Booking::whereHas('property', function($query) {
            $query->where('user_id', Auth::user()->id);
        })->sum('total');


        $myBookingsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyBookings = Booking::whereHas('property', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->whereMonth('created_at', $i)->count();
            $myBookingsData[] = $monthlyBookings;
        }


        $myRevenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue = Booking::whereHas('property', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->whereMonth('created_at', $i)->get()->sum(function ($booking) {
                return $booking->property->price_per_day * $booking->duration;
            });
            $myRevenueData[] = $monthlyRevenue;
        }

        return view('lessor.dashboard', compact(
            'myPropertiesCount',
            'myBookingsCount',
            'myTotalRevenue',
            'myBookingsData',
            'myRevenueData'
        ));
    }

    return redirect()->route('home')->with('error', 'You do not have access to this page.');
}

public function index(Request $request)
{
    if(Auth::check()&& Auth::user()->role=="lessor"){
        $query = Property::where('user_id', Auth::id());

        if ($request->has('search') && $request->input('search') != '') {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status', $request->input('status'));
        }

        $properties = $query->get();
        return view('lessor.properties.index', compact('properties'));
        }
        $properties = Property::all();
        return view('index', compact('properties'));
    }

    //}



    public function realState(Request $request)
    {
        $query = Property::query();

        if ($request->has('name') && $request->input('name') != '') {
            $query->where('title', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('price') && $request->input('price') != '') {
            $query->where('price_per_day', '<=', $request->input('price'));
        }

        $properties = $query->get();

        return view('renter.real-state', compact('properties'));
    }


    public function create()
    {
        return view('lessor.properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'type' => 'required|string|max:255',
            'guest_limit' => 'required|integer|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price_per_day' => $request->price_per_day,
            'status' => 'available',
            'type' => $request->type,
            'guest_limit' => $request->guest_limit,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('lessor.properties.index')->with('success', 'Property added successfully!');
    }

    public function show(Property $property)
{

    if(Auth::check() && Auth::user()->role == "lessor") {

        $property = Property::with(['images', 'reviews.user'])->findOrFail($property->id);
        return view('lessor.properties.show', compact('property'));
    }
    $reviews = Review::where('property_id', $property->id)
    ->orderByDesc('created_at')
    ->paginate(6);    $images = Property::find($property->id)->images;
    $property = Property::find($property->id);
    return view('properties.show', compact('property', 'images', 'reviews'));
}



public function edit(Property $property)
{
    $property->load('images');
    return view('lessor.properties.edit', compact('property'));
}


    public function update(  Request $request, Property $property)
    {

        Log::info('Update function triggered');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'type' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price_per_day' => $request->price_per_day,
            'type' => $request->type,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('lessor.properties.edit', $property->id)->with('success', 'Property updated successfully!');
        }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('lessor.properties.index')->with('success', 'Property deleted successfully!');
    }


    public function toggleFavorite(Request $request, $id)
    {
        try {
            if (!auth()->check()) {
                return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
            }

            $user = auth()->user();
            $property = Property::find($id);

            if (!$property) {
                \Log::error("Property not found: $id");
                return response()->json(['error' => 'العقار غير موجود'], 404);
            }

            if ($user->favorites()->where('property_id', $id)->exists()) {
                $user->favorites()->detach($id);
                $isFavorite = false;
            } else {
                $user->favorites()->attach($id);
                $isFavorite = true;
            }

            return response()->json(['is_favorite' => $isFavorite]);

        } catch (\Exception $e) {
            \Log::error('Favorite Error: ' . $e->getMessage());
            return response()->json(['error' => 'حدث خطأ أثناء العملية'], 500);
        }
    }

public function showFavorites()
{
    $user = auth()->user();
    // جلب العقارات المفضلة للمستخدم
    $properties = $user->favorites;

    return view('renter.favorites', compact('properties'));
}




}
