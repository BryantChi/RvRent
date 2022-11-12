<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobToPageSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_setting_infos', function (Blueprint $table) {
            //
            $table->longText('page_banner_img_mob')->nullable()->after('page_banner_img')->comment('頁面banner-手機版');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_setting_infos', function (Blueprint $table) {
            //
        });
    }
}
