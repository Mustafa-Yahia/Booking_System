<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'user_id' => 3,
            'property_id' => 1,
            'start_date' => '2025-03-01',
            'end_date' => '2025-03-04',
            'status' => 'pending',
            'total' => 300
        ]);
        Booking::create([
            'user_id' => 3,
            'property_id' => 1,
            'start_date' => '2025-03-06',
            'end_date' => '2025-03-08',
            'status' => 'pending',
            'total' => 150
        ]);
        Booking::create([
            'user_id' => 2,
            'property_id' => 1,
            'start_date' => '2025-03-11',
            'end_date' => '2025-03-13',
            'status' => 'pending',
            'total' => 240
        ]);
    }
}
