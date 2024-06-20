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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->text('remarks')->after('quantity')->nullable();
            $table->string('delivery_method')->after('price')->nullable();
            $table->string('payment_method')->after('size')->default('Online Payment');
            $table->decimal('total_price', 10, 2)->after('price')->nullable();            
            $table->decimal('shipping_fee', 10, 2)->after('price')->nullable();
            $table->unsignedBigInteger('quote_id')->after('product_id')->nullable();

            $table->foreign('quote_id')->references('id')->on('quotations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('payment_method'); 
            $table->dropColumn('delivery_method');
            $table->dropColumn('remarks');
            $table->dropColumn('quote_id');
            $table->dropColumn('total_price');
            $table->dropColumn('shipping_fee');
        });
    }
};
