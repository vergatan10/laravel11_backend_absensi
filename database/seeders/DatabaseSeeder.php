<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Verga Admin',
            'email' => 'verga@fic16.com',
            'password' => Hash::make('12345678'),
        ]);

        // data dummy company
        Company::create([
            'name' => 'PT. FIC16',
            'email' => 'fic16@vergatandika.com',
            'address' => 'Jl. Moh Toha RT5/RW3, Karawaci, Tgr',
            'latitude' => '-7.747033',
            'longitude' => '110.35598',
            'radius_km' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00'
        ]);

        $this->call([
            AttendanceSeeder::class,
        ]);
    }
}
