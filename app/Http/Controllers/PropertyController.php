<?php

namespace App\Http\Controllers;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Property;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class PropertyController extends Controller
{
    public function dashboard()
    {
        $properties = Property::all();
        return view('lessor.dashboard', compact('properties'));
    }

    public function index()
    {
        if(Auth::check()&& Auth::user()->role=="lessor"){
        $properties = Property::all();
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $property = Property::create([
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price_per_day' => $request->price_per_day,
            'status' => 'available',
            'type' => $request->type,
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
    $property->load('images');
    return view('lessor.properties.show', compact('property'));
}

public function edit(Property $property)
{
    $property->load('images');
    return view('lessor.properties.edit', compact('property'));
}


    public function update(Request $request, Property $property)
    {
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



}
