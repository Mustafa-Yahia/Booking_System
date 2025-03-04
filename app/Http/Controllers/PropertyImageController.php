<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function destroy(Property $property, PropertyImage $image)
    {
        if ($image->property_id !== $property->id) {
            return back()->with('error', 'Invalid image for this property');
        }

        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}
