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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->Text('quantity')->nullable(); 
            $table->date('delivery_date')->nullable();
            $table->Text('option_id')->nullable();
            $table->Text('option_value_id')->nullable();
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->Text('month')->nullable();
            $table->Text('price')->nullable();
            $table->Text('status')->nullable();
            $table->timestamps();
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
