<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddIndexesToRentSellHomeDetailsForHouseCondo extends Migration
{
    public function up()
    {
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            // ตรวจสอบว่ามี index อยู่หรือไม่ก่อนเพิ่มใหม่
            if (!$this->hasIndex('rent_sell_home_details', 'custom_status_home_index')) {
                $table->index('status_home', 'custom_status_home_index');
            }

            if (!$this->hasIndex('rent_sell_home_details', 'custom_code_admin_index')) {
                $table->index('code_admin', 'custom_code_admin_index');
            }

            if (!$this->hasIndex('rent_sell_home_details', 'custom_provinces_index')) {
                $table->index('provinces', 'custom_provinces_index');
            }

            if (!$this->hasIndex('rent_sell_home_details', 'custom_districts_index')) {
                $table->index('districts', 'custom_districts_index');
            }

            if (!$this->hasIndex('rent_sell_home_details', 'custom_amphures_index')) {
                $table->index('amphures', 'custom_amphures_index');
            }
        });

        // เพิ่ม index ในตาราง provinces
        Schema::table('provinces', function (Blueprint $table) {
            if (!$this->hasIndex('provinces', 'custom_provinces_id_index')) {
                $table->index('id', 'custom_provinces_id_index');
            }
        });

        // เพิ่ม index ในตาราง amphures
        Schema::table('amphures', function (Blueprint $table) {
            if (!$this->hasIndex('amphures', 'custom_amphures_id_index')) {
                $table->index('id', 'custom_amphures_id_index');
            }
        });

        // เพิ่ม index ในตาราง districts
        Schema::table('districts', function (Blueprint $table) {
            if (!$this->hasIndex('districts', 'custom_districts_id_index')) {
                $table->index('id', 'custom_districts_id_index');
            }
        });
    }

    // ฟังก์ชันตรวจสอบการมีอยู่ของ index
    protected function hasIndex($table, $indexName)
    {
        $result = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        return !empty($result);
    }

    public function down()
    {
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            if ($this->hasIndex('rent_sell_home_details', 'custom_status_home_index')) {
                $table->dropIndex(['custom_status_home_index']);
            }

            if ($this->hasIndex('rent_sell_home_details', 'custom_code_admin_index')) {
                $table->dropIndex(['custom_code_admin_index']);
            }

            if ($this->hasIndex('rent_sell_home_details', 'custom_provinces_index')) {
                $table->dropIndex(['custom_provinces_index']);
            }

            if ($this->hasIndex('rent_sell_home_details', 'custom_districts_index')) {
                $table->dropIndex(['custom_districts_index']);
            }

            if ($this->hasIndex('rent_sell_home_details', 'custom_amphures_index')) {
                $table->dropIndex(['custom_amphures_index']);
            }
        });

        Schema::table('provinces', function (Blueprint $table) {
            if ($this->hasIndex('provinces', 'custom_provinces_id_index')) {
                $table->dropIndex(['custom_provinces_id_index']);
            }
        });

        Schema::table('amphures', function (Blueprint $table) {
            if ($this->hasIndex('amphures', 'custom_amphures_id_index')) {
                $table->dropIndex(['custom_amphures_id_index']);
            }
        });

        Schema::table('districts', function (Blueprint $table) {
            if ($this->hasIndex('districts', 'custom_districts_id_index')) {
                $table->dropIndex(['custom_districts_id_index']);
            }
        });
    }
}