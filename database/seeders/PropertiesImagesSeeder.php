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

        PropertyImage::insert([
            ['property_id' => 2, 'image_path' => 'images/properties/21.avif'],
            ['property_id' => 2, 'image_path' => 'images/properties/22.avif'],
            ['property_id' => 2, 'image_path' => 'images/properties/23.avif'],
        ]);
        PropertyImage::insert([
            ['property_id' => 3, 'image_path' => 'images/properties/31.avif'],
            ['property_id' => 3, 'image_path' => 'images/properties/33.avif'],
            ['property_id' => 3, 'image_path' => 'images/properties/34.avif'],
        ]);
        PropertyImage::insert([
            ['property_id' => 4, 'image_path' => 'images/properties/41.avif'],
            ['property_id' => 4, 'image_path' => 'images/properties/43.avif'],
            ['property_id' => 4, 'image_path' => 'images/properties/44.jpg'],
        ]);
        PropertyImage::insert([
            ['property_id' => 5, 'image_path' => 'images/properties/51.jpeg'],
            ['property_id' => 5, 'image_path' => 'images/properties/52.jpeg'],
            ['property_id' => 5, 'image_path' => 'images/properties/53.jpeg'],
        ]);
    }
}
