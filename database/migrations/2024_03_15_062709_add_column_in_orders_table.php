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
            $table->Text('billing_name')->after('cancel_reason')->nullable();
            $table->Text('shipping_name')->after('billing_name')->nullable();
            $table->Text('billing_email')->after('shipping_name')->nullable();
            $table->Text('shipping_email')->after('billing_email')->nullable();
            $table->Text('delivery_type')->after('shipping_email')->nullable();
            $table->Text('payment_method')->after('delivery_type')->nullable();
            $table->Text('tax')->after('payment_method')->nullable();
            $table->Text('payment_status')->after('tax')->nullable();
            $table->Text('order_status')->after('payment_status')->nullable();
            $table->Text('status')->after('order_status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
