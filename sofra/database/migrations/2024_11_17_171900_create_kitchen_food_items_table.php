<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kitchen_food_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kitchen_id')->unsigned();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('food_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_food_items');
    }
};
