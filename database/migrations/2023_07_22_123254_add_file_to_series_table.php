<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToSeriesTable extends Migration
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
            $table->longText('rv_series_file')->after('rv_series_name')->nullable()->comment('契約書');
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
            $table->dropColumn('rv_series_file');
        });
    }
}
