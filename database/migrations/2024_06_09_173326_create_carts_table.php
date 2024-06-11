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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            // $table->unsignedBigInteger('quotation_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('size')->nullable();
            $table->string('color')->nullable(); // Fixed typo from $table->color() to $table->string('color');
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            
            // $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
