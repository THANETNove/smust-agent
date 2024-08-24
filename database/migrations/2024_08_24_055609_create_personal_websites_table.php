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
        Schema::create('personal_websites', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->comment('user_id');
            $table->text('imageHade')->nullable()->comment('ภาพหัว');
            $table->text('provinces')->nullable()->comment('provinces');
            $table->text('history_work')->nullable()->comment('ประวัติ หรือผลงานโดยย่อ');
            $table->text('image_1')->nullable()->comment('ภาพ 1');
            $table->string('name_1')->nullable()->comment('ชื่อที่ 1');
            $table->text('details_1')->nullable()->comment('รายละเอียดที่ 1');
            $table->text('image_2')->nullable()->comment('ภาพ 2');
            $table->string('name_2')->nullable()->comment('ชื่อที่ 2');
            $table->text('details_2')->nullable()->comment('รายละเอียดที่ 2');
            $table->text('image_3')->nullable()->comment('ภาพ 3');
            $table->string('name_3')->nullable()->comment('ชื่อที่ 3');
            $table->text('details_3')->nullable()->comment('รายละเอียดที่ 3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_websites');
    }
};
