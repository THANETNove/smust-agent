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
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            $table->string('cross')->nullable()->comment('ข้ามการกรอกข้อมูลใหม');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            //
        });
    }
};