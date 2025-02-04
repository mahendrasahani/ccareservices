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
            $table->dateTime('ordered_date')->nullable()->after('delivery_date');
            $table->dateTime('accepted_date')->nullable()->after('ordered_date');
            $table->dateTime('canceled_date')->nullable()->after('accepted_date');
            $table->dateTime('shipped_date')->nullable()->after('canceled_date');
            $table->dateTime('delivered_date')->nullable()->after('shipped_date');
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
