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
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->unsignedBigInteger('attribute_value_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->Text('order_number')->nullable(); 
            $table->date('date_of_purchase')->nullable(); 
            $table->Text('customer_name')->nullable(); 
            $table->Text('customer_email')->nullable(); 
            $table->Text('customer_phone')->nullable(); 
            $table->Text('product_name')->nullable(); 
            $table->Text('attribute_name')->nullable(); 
            $table->Text('attribute_value_name')->nullable(); 
            $table->Text('quantity')->nullable(); 
            $table->Text('return_reson')->nullable(); 
            $table->Text('comment')->nullable(); 
            $table->tinyInteger('return_action')->nullable(); // return action if 0 dont add in stock if 1 increase in stock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_returns');
    }
};
