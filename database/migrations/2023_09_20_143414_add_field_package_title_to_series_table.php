<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPackageTitleToSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rv_series_infos', function (Blueprint $table) {
            //
            $table->text('rv_series_package_copywriting')->after('rv_series_file')->nullable()->comment('額外哩程套餐文案');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rv_series_infos', function (Blueprint $table) {
            //
            $table->dropColumn('rv_series_package_copywriting');
        });
    }
}
