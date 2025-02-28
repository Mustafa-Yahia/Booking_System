<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
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
        // إعداد الاستعلام لجلب جميع العقارات مع إمكانية الفلترة
        $query = Property::query();

        // إذا كان هناك فلترة حسب الاسم
        if ($request->has('name') && $request->input('name') != '') {
            $query->where('title', 'like', '%' . $request->input('name') . '%');
        }

        // إذا كان هناك فلترة حسب السعر
        if ($request->has('price') && $request->input('price') != '') {
            $query->where('price_per_day', '<=', $request->input('price'));
        }

        // جلب العقارات بناءً على الفلاتر المطبقة
        $properties = $query->get();

        // تمرير البيانات إلى الـ View
        return view('real-state', compact('properties'));
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
    public function show(String $id)
    {
        $images = Property::find($id)->images;
        $property = Property::find($id);
        return view('properties.show', compact('property', 'images'));
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
