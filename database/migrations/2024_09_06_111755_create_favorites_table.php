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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->string('id_product')->nullable()->comment('id product');
            $table->text('status_favorites')->nullable()->comment('สถานะ กดหัวใจหรือไม่กด');
            $table->text('status')->nullable()->comment('สถานะ add ใหม่');
            $table->string('user_id')->nullable()->comment('user_id ที่รายงาน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};