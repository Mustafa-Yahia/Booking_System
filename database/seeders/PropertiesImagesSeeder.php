<?php

namespace Database\Seeders;

use App\Models\PropertyImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyImage::create([
            'property_id' => 1,
            'image_path' => 'images/properties/1.avif'
        ]);
        PropertyImage::create([
            'property_id' => 1,
            'image_path' => 'images/properties/2.avif'
        ]);
        PropertyImage::create([
            'property_id' => 1,
            'image_path' => 'images/properties/3.avif'
        ]);
    }
}
