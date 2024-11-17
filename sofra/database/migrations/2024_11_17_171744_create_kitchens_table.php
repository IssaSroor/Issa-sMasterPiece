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
        Schema::create('kitchens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->String('kitchen_name');
            $table->String('kitchen_short_desc');
            $table->String('kitchen_description');
            $table->String('kitchen_phone');
            $table->String('kitchen_address');
            $table->String('kitchen_working_hours');
            $table->enum('kitchen_status',['opened','closed','busy']);
            $table->integer('kitchen_rating');
            $table->bigInteger('accepted_by')->unsigned();
            $table->foreign('accepted_by')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchens');
    }
};