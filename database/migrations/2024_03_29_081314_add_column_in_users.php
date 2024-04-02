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
            $table->Text('status')->nullable()->after('user_type')->comment('delivery Boy: 1 = Active, 0 = Banned');
            $table->tinyInteger('user_type')->nullable()->comment('0 = Super Admin, 1 = Admin, 2 = Customer, 3 = Delivery Boy')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('user_type')->nullable()->comment('0 = Super Admin, 1 = Admin, 2 = Normal User')->change();
        });
    }
};
