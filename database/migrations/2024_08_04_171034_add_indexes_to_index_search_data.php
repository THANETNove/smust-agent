<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToIndexSearchData extends Migration
{
    public function up()
    {
        Schema::table('indexSearchData', function (Blueprint $table) {
            // เพิ่ม index บนคอลัมน์ที่คุณต้องการ
            $table->index('status', 'indexSearchData_status_index');
            $table->index('admin_code', 'indexSearchData_admin_code_index');
            $table->index('province_id', 'indexSearchData_province_id_index');
            $table->index('district_id', 'indexSearchData_district_id_index');
            $table->index('amphur_id', 'indexSearchData_amphur_id_index');
        });
    }

    public function down()
    {
        Schema::table('indexSearchData', function (Blueprint $table) {
            // ลบ index หากมีการ rollback
            $table->dropIndex('indexSearchData_status_index');
            $table->dropIndex('indexSearchData_admin_code_index');
            $table->dropIndex('indexSearchData_province_id_index');
            $table->dropIndex('indexSearchData_district_id_index');
            $table->dropIndex('indexSearchData_amphur_id_index');
        });
    }
}
