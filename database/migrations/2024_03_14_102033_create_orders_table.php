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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->Text('order_id')->nullable();
            $table->Text('payment_mode')->nullable();
            $table->bigInteger('delivery_charge')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->bigInteger('total')->nullable();
            $table->date('delivery_date')->nullable();
            $table->Text('shipping_address')->nullable();
            $table->Text('billing_address')->nullable();
            $table->Text('promo_code')->nullable();
            $table->Text('promo_discount')->nullable();
            $table->Text('cancel_reason')->nullable(); 
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
