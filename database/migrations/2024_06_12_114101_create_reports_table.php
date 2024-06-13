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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('product_id')->nullable();
            // $table->unsignedBigInteger('order_id')->nullable();
            // $table->string('report_type');
            // $table->text('details')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
