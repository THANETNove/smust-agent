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
        Schema::create('website_professionals', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable()->comment('ภาพ');
            $table->text('website_head')->nullable()->comment('ข้อความ');
            $table->text('website_price')->nullable()->comment('ข้อความ');
            $table->text('website_details')->nullable()->comment('ข้อความ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_professionals');
    }
};
