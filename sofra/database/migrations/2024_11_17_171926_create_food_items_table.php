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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kitchen_id')->unsigned();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->String('item_name');
            $table->String('item_image');
            $table->String('item_description');
            $table->float('item_price');
            $table->float('item_discount')->default(0);
            $table->enum('item_availability',['available','Out of stock']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
