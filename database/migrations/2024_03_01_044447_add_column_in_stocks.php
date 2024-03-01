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
            $table->Text('price_1')->after('price')->nullable();
            $table->Text('price_2')->after('price_1')->nullable();
            $table->Text('price_3')->after('price_2')->nullable();
            $table->Text('price_4')->after('price_3')->nullable();
            $table->Text('price_5')->after('price_4')->nullable();
            $table->Text('price_6')->after('price_5')->nullable();
            $table->Text('price_7')->after('price_6')->nullable();
            $table->Text('price_8')->after('price_7')->nullable();
            $table->Text('price_9')->after('price_8')->nullable();
            $table->Text('price_10')->after('price_9')->nullable();
            $table->Text('price_11')->after('price_10')->nullable();
            $table->Text('price_12')->after('price_11')->nullable(); 
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
