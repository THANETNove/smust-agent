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
        Schema::create('words_smust_users', function (Blueprint $table) {
            $table->id();
            $table->text('words_head')->nullable()->comment('หัวข้อ');
            $table->text('words_image')->nullable()->comment('ภาพ');
            $table->text('words_details')->nullable()->comment('รายละเอียด');
            $table->text('words_name')->nullable()->comment('โดย..');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words_smust_users');
    }
};