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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->Text('product_name')->nullable();
            $table->integer('min_purchase_qty')->nullable();
            $table->integer('max_purchase_qty')->nullable();
            $table->json('product_images')->nullable();
            $table->Text('regular_price')->nullable();
            $table->Text('sku')->nullable();
            $table->Text('stock_status')->nullable()->comment("0 = out of stock, 1 = in stock");
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();
            $table->integer('discount')->nullable();
            $table->Text('discount_type')->nullable()->comment('1 = flate, 2 = percent');
            $table->Text('product_description')->nullable(); 
            $table->Text('meta_title')->nullable();
            $table->Text('meta_description')->nullable();
            $table->Text('slug')->nullable();
            $table->Integer('product_status')->comment('0 = draft, 1 = publish');
            $table->unsignedBigInteger('brand')->nullable();
            $table->unsignedBigInteger('main_category')->nullable();
            $table->unsignedBigInteger('sub_category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
