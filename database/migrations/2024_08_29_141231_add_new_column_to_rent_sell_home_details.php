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
            $table->string('cross')->nullable()->comment('ข้ามการกรอกข้อมูลใหม่')->after('thereVarious');
            $table->string('sell')->nullable()->comment('ขาย')->after('cross');
            $table->string('rent')->nullable()->comment('เช่า')->after('sell');
            $table->string('name_have')->nullable()->comment('โฉนดมีภาระหนี้หรือไม่')->after('rent');
            $table->string('start_date')->nullable()->comment('เริ่มให้เช่าได้ตั้งแต่')->after('name_have');
            $table->string('road')->nullable()->comment('ถนน')->after('start_date');
            $table->string('alley')->nullable()->comment('ซอย')->after('road');
            $table->string('number_parking')->nullable()->comment('จำนวนที่จอดรถ')->after('alley');
            $table->string('rent_baht_month')->nullable()->comment('ค่าเช่า* (บาท/เดือน)')->after('number_parking');
            $table->string('month_advance_rent')->nullable()->comment('ค่าเช่าล่วงหน้า 1 เดือน')->after('rent_baht_month');
            $table->string('electricalAppliance')->nullable()->comment('เครื่องใช้ไฟฟ้า')->after('month_advance_rent');
            $table->string('facilities')->nullable()->comment('สิ่งอำนวยความสะดวก')->after('electricalAppliance');
            $table->string('furniture')->nullable()->comment('เฟอร์นิเจอร์')->after('facilities');
            $table->text('shopping_center')->nullable()->comment('ศูนย์การค้า')->after('furniture');
            $table->text('school')->nullable()->comment('สถานศึกษา')->after('shopping_center');
            $table->text('meters_store')->nullable()->comment('ร้านสะดวกซื้อที่ใกล้ที่สุด')->after('school');
            $table->text('url_video')->nullable()->comment('ลิงค์ video')->after('meters_store');
            $table->string('announcement_name')->nullable()->comment('ชื่อประกาศ*')->after('url_video');
            $table->text('files')->nullable()->comment('ไฟล์')->after('announcement_name');
            $table->string('user_name')->nullable()->comment('ชื่อ')->after('files');
            $table->string('user_surname')->nullable()->comment('นามสกุล')->after('user_name');
            $table->string('user_phone')->nullable()->comment('เบอร์โทร')->after('user_surname');
            $table->string('user_id')->nullable()->comment('id user')->after('user_phone');
            $table->string('reservation_amount_baht')->nullable()->comment('จำนวนเงินจอง* (บาท) ขาย')->after('user_id');
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