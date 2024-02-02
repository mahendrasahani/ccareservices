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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->Text('name')->nullable();
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->integer('ordering_number')->nullable();
            $table->Text('type')->nullable();
            $table->Text('thumbnail_image')->nullable();
            $table->Text('meta_title')->nullable();
            $table->Text('meta_description')->nullable();
            $table->Text('meta_image')->nullable();
            $table->json('filtering_attribute')->nullable();
            $table->tinyInteger('status')->nullable();         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
