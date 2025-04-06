<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'user_id' => 2,
            'title' => 'Cozy Apartment',
            'description' => 'A peaceful retreat in the mountains.',
            'location' => 'amman',
            'type' => 'studio',
            'price_per_day' => 120,
            'status' => 'available'
        ]);
        Property::create([
            'user_id' => 3,
            'title' => 'Beachfront Villa',
            'description' => 'A luxurious villa with an ocean view.',
            'location' => 'amman',
            'type' => 'Apartment',
            'price_per_day' => 300,
            'status' => 'available'
        ]);
        Property::create([
            'user_id' => 4,
            'title' => 'Mountain Cabin',
            'description' => 'A peaceful retreat in the mountains.',
            'location' => 'salt',
            'price_per_day' => 150,
            'type' => 'other',
            'status' => 'available'
        ]);
        Property::create([
            'user_id' => 2,
            'title' => 'Luxury Apartment Downtown',
            'description' => 'A modern apartment with a great city view.',
            'location' => 'Amman',
            'price_per_day' => 200,
            'type' => 'Apartment',
            'status' => 'available'
        ]);
        Property::create([
            'user_id' => 4,
            'title' => 'Cozy Family House',
            'description' => 'A spacious house perfect for families.',
            'location' => 'Irbid',
            'price_per_day' => 180,
            'type' => 'House',
            'status' => 'available'
        ]);

    }
}
