<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToRentSellHomeDetails extends Migration
{
    public function up()
    {
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            $table->index('status_home');
            $table->index('code_admin');
            $table->index('provinces');
            $table->index('districts');
            $table->index('amphures');
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->index('id');
        });

        Schema::table('amphures', function (Blueprint $table) {
            $table->index('id');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->index('id');
        });
    }

    public function down()
    {
        Schema::table('rent_sell_home_details', function (Blueprint $table) {
            $table->dropIndex(['status_home']);
            $table->dropIndex(['code_admin']);
            $table->dropIndex(['provinces']);
            $table->dropIndex(['districts']);
            $table->dropIndex(['amphures']);
        });

        Schema::table('provinces', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });

        Schema::table('amphures', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropIndex(['id']);
        });
    }
}
