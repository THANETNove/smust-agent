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
            $table->string('sell')->nullable()->comment('ขาย');
            $table->string('rent')->nullable()->comment('เช่า');
            $table->string('name_have')->nullable()->comment('โฉนดมีภาระหนี้หรือไม่');
            $table->string('start_date')->nullable()->comment('เริ่มให้เช่าได้ตั้งแต่');
            $table->string('road')->nullable()->comment('ถนน');
            $table->string('alley')->nullable()->comment('ซอย');
            $table->string('number_parking')->nullable()->comment('จำนวนที่จอดรถ');
            $table->string('rent_baht_month')->nullable()->comment('ค่าเช่า* (บาท/เดือน)');
            $table->string('month_advance_rent')->nullable()->comment('ค่าเช่าล่วงหน้า 1 เดือน');
            $table->string('electricalAppliance')->nullable()->comment('สิ่งอำนวยความสะดวก');
            $table->string('facilities')->nullable()->comment('เครื่องใช้ไฟฟ้า');
            $table->string('furniture')->nullable()->comment('เฟอร์นิเจอร์');
            $table->string('shopping_center')->nullable()->comment('สถานที่สำคัญใกล้เคียง');
            $table->string('school')->nullable()->comment('สถานศึกษา');
            $table->string('meters_store')->nullable()->comment('ร้านสะดวกซื้อที่ใกล้ที่สุด');
            $table->string('url_video')->nullable()->comment('ลิงค์ video ');
            $table->string('announcement_name')->nullable()->comment('ชื่อประกาศ* ');
            $table->string('files')->nullable()->comment('files');
            $table->string('user_name')->nullable()->comment('ชื่อ');
            $table->string('user_surname')->nullable()->comment('นาสกุล');
            $table->string('user_phone')->nullable()->comment('เบอร์โทร');
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