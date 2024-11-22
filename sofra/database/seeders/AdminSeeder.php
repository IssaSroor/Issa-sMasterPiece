<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->count(10)->create();

        Admin::create([
            'admin_name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'admin_role' => 'super_admin',
        ]);    }
}
