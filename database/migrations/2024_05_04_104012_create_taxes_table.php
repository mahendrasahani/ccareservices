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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->Text('tax_name')->nullable();
            $table->integer('tax_rate')->nullable();
            $table->Text('tax_type')->nullable(); // percent or fixex amount
            $table->tinyInteger('status')->default(1); // 0 for inactive 1 for active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
