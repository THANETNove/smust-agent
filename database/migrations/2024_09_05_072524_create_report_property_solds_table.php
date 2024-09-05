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
        Schema::create('report_property_solds', function (Blueprint $table) {
            $table->id();
            $table->string('id_product')->nullable()->comment('id product');
            $table->text('report')->nullable()->comment('รายละเอียดรายงาน');
            $table->string('user_id')->nullable()->comment('user_id ที่รายงาน');
            $table->timestamps();
        });
    }
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_property_solds');
    }
};