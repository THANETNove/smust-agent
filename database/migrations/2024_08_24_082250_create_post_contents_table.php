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
        Schema::create('post_contents', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->comment('user_id');
            $table->string('name')->nullable()->comment('ชื่อ');
            $table->text('image')->nullable()->comment('ภาพ');
            $table->text('details_post')->nullable()->comment('รายละเอียด');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_contents');
    }
};
