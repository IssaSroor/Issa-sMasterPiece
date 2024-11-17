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
        Schema::create('kitchen_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kitchen_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('review_text');  
            $table->integer('review_rating');  
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
        Schema::dropIfExists('kitchen_reviews');
    }
};
