<?php

namespace Database\Seeders;

use App\Models\Food_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Food_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food_item::factory(10)->create();    
    }
}
