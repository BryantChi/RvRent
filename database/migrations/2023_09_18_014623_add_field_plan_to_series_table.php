<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPlanToSeriesTable extends Migration
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
            $table->longText('rv_series_package')->after('rv_series_file')->nullable()->comment('系列套餐');
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
            $table->dropColumn('rv_series_package');
        });
    }
}
