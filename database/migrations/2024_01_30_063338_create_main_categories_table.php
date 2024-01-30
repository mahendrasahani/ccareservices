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
        Schema::create('main_categories', function (Blueprint $table) {
            $table->id();
            $table->Text('name')->nullable();
            $table->Integer('ordering_number')->nullable();
            $table->Text('thumbnail')->nullable();
            $table->Text('meta_title')->nullable();
            $table->Text('meta_description')->nullable();
            $table->Text('meta_image')->nullable();
            $table->Text('filtering_attribute')->nullable();
            $table->TinyInteger('status')->nullable()->comment('0 = disabled, 1 = enabled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_categories');
    }
};
