<?php

namespace Database\Seeders;

use App\Models\Kitchen_review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kitchen_reviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kitchen_review::factory()->count(10)->create();
    }
}
