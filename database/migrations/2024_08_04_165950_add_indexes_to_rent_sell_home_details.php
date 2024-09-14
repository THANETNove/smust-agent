<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToRentSellHomeDetails extends Migration
{
    public function up()
    {
        // เพิ่ม index ในตาราง rent_sell_home_details
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            // เปลี่ยนชื่อ index ให้ไม่ซ้ำกับที่มีอยู่แล้ว
            $table->index('status_home', 'custom_status_home_index');
            $table->index('code_admin', 'custom_code_admin_index');
            $table->index('provinces', 'custom_provinces_index');
            $table->index('districts', 'custom_districts_index');
            $table->index('amphures', 'custom_amphures_index');
        });

        // เพิ่ม index ในตาราง provinces
        Schema::table('provinces', function (Blueprint $table) {
            $table->index('id', 'custom_provinces_id_index');
        });

        // เพิ่ม index ในตาราง amphures
        Schema::table('amphures', function (Blueprint $table) {
            $table->index('id', 'custom_amphures_id_index');
        });

        // เพิ่ม index ในตาราง districts
        Schema::table('districts', function (Blueprint $table) {
            $table->index('id', 'custom_districts_id_index');
        });
    }

    public function down()
    {
        // ลบ index ในตาราง rent_sell_home_details
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            $table->dropIndex(['custom_status_home_index']);
            $table->dropIndex(['custom_code_admin_index']);
            $table->dropIndex(['custom_provinces_index']);
            $table->dropIndex(['custom_districts_index']);
            $table->dropIndex(['custom_amphures_index']);
        });

        // ลบ index ในตาราง provinces
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropIndex(['custom_provinces_id_index']);
        });

        // ลบ index ในตาราง amphures
        Schema::table('amphures', function (Blueprint $table) {
            $table->dropIndex(['custom_amphures_id_index']);
        });

        // ลบ index ในตาราง districts
        Schema::table('districts', function (Blueprint $table) {
            $table->dropIndex(['custom_districts_id_index']);
        });
    }
}