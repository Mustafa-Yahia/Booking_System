<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'lessor',
            'email' => 'lessor@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'lessor',
        ]);
        User::create([
            'name' => 'dave',
            'email' => 'dave@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'lessor',
        ]);
        User::create([
            'name' => 'bill',
            'email' => 'bill@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'lessor',
        ]);

        User::create([
            'name' => 'renter',
            'email' => 'renter@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'renter',
        ]);

        User::create([
            'name' => 'jon',
            'email' => 'jon@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'renter',
        ]);
        User::create([
            'name' => 'bob',
            'email' => 'bob@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'renter',
        ]);
        User::create([
            'name' => 'alice',
            'email' => 'alice@ex.com',
            'password' => bcrypt('qwerty'),
            'role' => 'renter',
        ]);
    }
}
