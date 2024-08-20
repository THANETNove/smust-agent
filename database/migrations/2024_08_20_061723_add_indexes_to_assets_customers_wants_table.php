<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToAssetsCustomersWantsTable extends Migration
{
    public function up()
    {
        Schema::table('assets_customers_wants', function (Blueprint $table) {
            // เพิ่ม index ในคอลัมน์ที่ใช้บ่อยในการค้นหา
            $table->index('status');
            $table->index('provinces');
            $table->index('districts');
            $table->index('amphures');
            $table->index('station_name');
            $table->index('sale_rent');
            $table->index('options'); // เพิ่มดัชนีให้กับคอลัมน์ options
        });
    }

    public function down()
    {
        Schema::table('assets_customers_wants', function (Blueprint $table) {
            // ลบ index เมื่อทำการ rollback
            $table->dropIndex(['status']);
            $table->dropIndex(['provinces']);
            $table->dropIndex(['districts']);
            $table->dropIndex(['amphures']);
            $table->dropIndex(['station_name']);
            $table->dropIndex(['sale_rent']);
            $table->dropIndex(['options']); // ลบดัชนีสำหรับคอลัมน์ options
        });
    }
}