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
        Schema::table('vendors', function (Blueprint $table) {
            $table->Text('name')->nullable()->change();
            $table->Text('profile_image')->nullable()->change();
            $table->Text('business_name')->nullable()->change();
            $table->Text('email')->nullable()->change();
            $table->Text('phone')->nullable()->change();
            $table->Text('address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
};
