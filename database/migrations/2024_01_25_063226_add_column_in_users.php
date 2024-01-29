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
        Schema::table('users', function (Blueprint $table) {
            $table->TinyInteger('user_type')->nullable()->after('email')->comment('0 = Super Admin, 1 = Admin, 2 = Normal User');
            $table->bigInteger('phone')->nullable()->after('password');
            $table->Text('company_name')->nullable()->after('phone');
            $table->Text('address_1')->nullable()->after('company_name');
            $table->Text('address_2')->nullable()->after('address_1');
            $table->Text('country')->nullable()->after('address_2');
            $table->Text('state')->nullable()->after('country');
            $table->Text('city')->nullable()->after('state');
            $table->Text('postal_code')->nullable()->after('city');
            $table->Text('aadhar_front')->nullable()->after('postal_code');
            $table->Text('aadhar_back')->nullable()->after('aadhar_front');
            $table->Text('company_id')->nullable()->after('aadhar_back');
            $table->Text('profile')->nullable()->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
