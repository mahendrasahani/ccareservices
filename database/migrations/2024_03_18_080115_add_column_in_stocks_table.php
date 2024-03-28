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
        Schema::table('stocks', function (Blueprint $table) {
            $table->Text('vendor_id')->after('price_12')->nullable();
            $table->Text('date_of_purchase')->after('vendor_id')->nullable();
            $table->Text('purchase_amount')->after('date_of_purchase')->nullable();
            $table->Text('invoice_no')->after('purchase_amount')->nullable();
            $table->Text('stock_staus')->after('invoice_no')->nullable()->comment('0 = In Stock, 1 = Out of Stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            //
        });
    }
};
