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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kitchen_id')->unsigned();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('managed_by')->unsigned();
            $table->foreign('managed_by')->references('id')->on('admins')->onDelete('cascade');
            $table->String('order_address');
            $table->float('order_total_amount');
            $table->enum('order_status',['confirmed','prepared','on delivery'])->default('confirmed');
            $table->enum('order_payment_status',['paid','unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
