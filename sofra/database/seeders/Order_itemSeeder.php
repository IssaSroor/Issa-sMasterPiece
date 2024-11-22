<?php

namespace Database\Seeders;

use App\Models\Order_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Order_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_item::factory(10)->create();
    }
}
