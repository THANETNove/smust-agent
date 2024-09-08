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
        Schema::create('assets_customers_wants', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->comment('user_id');
            $table->string('sale_rent')->nullable()->comment('ขาย/เช่า');
            $table->string('property_type')->nullable()->comment('ประเภททรัพย์');
            $table->string('price_start')->nullable()->comment('ราคา เริ่มต้น');
            $table->string('price_end')->nullable()->comment('ราคา สิ้นสุด');
            $table->string('provinces')->nullable()->comment('จังหวัด');
            $table->string('districts')->nullable()->comment('อำเภอเขต');
            $table->string('amphures')->nullable()->comment('เเขวง');
            $table->string('station')->nullable()->comment('รหัสรถไฟ');
            $table->string('station_name')->nullable()->comment('ชื่อรถไฟ');
            $table->text('options')->nullable()->comment('ลักษณะพิเศษ');
            $table->text('message_customer')->nullable()->comment('ข้อความจากลูกค้า');
            $table->string('status')->nullable()->comment('0 ปิด ,1=เปิด');
            $table->string('webName')->nullable()->comment('webName');
            $table->string('webPhone')->nullable()->comment('webPhone');
            $table->string('webLine')->nullable()->comment('webLine');
            $table->string('webFacebook')->nullable()->comment('webFacebook');
            $table->string('notifications')->nullable()->comment('เเจ้งเตื่อน');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_customers_wants');
    }
};