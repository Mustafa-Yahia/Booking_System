<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Database\Eloquent\SoftDeletes;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();
        return view('index', compact('properties'));

    }



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
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }



}
