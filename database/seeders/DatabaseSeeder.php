<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'wahyudwiprstka@gmail.com',
            'password' => Hash::make('superadmin'),
            'identity_number' => '5101031010020002',
            'role' => '["superadmin","admin"]',
            'is_superadmin' => true
        ]);
    }
}
