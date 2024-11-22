<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    


    public function run(): void
    {
        $this->call([
            AdminSeeder::class
        ]);    }
}
