<?php

namespace Database\Seeders;

use App\Models\Kitchen_food_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kitchen_food_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kitchen_food_item::factory(10)->create();
    }
}
