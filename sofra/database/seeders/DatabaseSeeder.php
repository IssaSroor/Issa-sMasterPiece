<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    


    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            KitchenSeeder::class,
            UserSeeder::class,
            Kitchen_categorySeeder::class,
            Food_itemSeeder::class,
            Kitchen_food_itemSeeder::class,
            MessageSeeder::class,
            OrderSeeder::class,
            Order_itemSeeder::class,
            QuestionSeeder::class,
            Kitchen_reviewSeeder::class,

        ]);    }
}
