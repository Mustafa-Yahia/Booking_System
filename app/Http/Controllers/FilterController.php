<?php
namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Governorate;
use App\Models\Area;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterProperties(Request $request)
    {
        // جلب المحافظات والمناطق
        $governorates = Governorate::all();
        $areas = Area::all();

        // استعلامات الفلاتر
        $properties = Property::query();

        // فلتر الموقع
        if ($request->has('location') && $request->input('location') != '') {
            $properties->where('location', $request->input('location'));
        }

        // فلتر النوع
        if ($request->has('type') && $request->input('type') != '') {
            $properties->where('type', $request->input('type'));
        }

        // فلتر السعر
        if ($request->has('price') && $request->input('price') != '') {
            $properties->where('price_per_day', '<=', $request->input('price'));
        }

        // فلتر الاسم
        if ($request->has('name') && $request->input('name') != '') {
            $properties->where('title', 'like', '%' . $request->input('name') . '%');
        }

        // تنفيذ الاستعلام
        $properties = $properties->get();

        // إرجاع الـ view مع البيانات المطلوبة
        return view('properties.index', compact('properties', 'governorates', 'areas'));
    }
}
