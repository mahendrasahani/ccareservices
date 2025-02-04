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
        Schema::table('recent_activities', function (Blueprint $table) {
            $table->Text('country')->nullable()->after('user_phone');
            $table->Text('country_code')->nullable()->after('country');
            $table->Text('region')->nullable()->after('country_code');
            $table->Text('city')->nullable()->after('region');
            $table->Text('zip')->nullable()->after('city');
            $table->Text('timezone')->nullable()->after('zip');
            $table->Text('isp')->nullable()->after('timezone')->after('ip_address');
            $table->Text('org')->nullable()->after('isp');
            $table->Text('as')->nullable()->after('org'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recent_activities', function (Blueprint $table) {
            //
        });
    }
};
