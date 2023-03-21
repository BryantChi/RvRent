<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBedcountToModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rv_model_infos', function (Blueprint $table) {
            //
            $table->integer('bed_count')->default(0)->after('stock')->commit('床位數');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rv_model_infos', function (Blueprint $table) {
            //
        });
    }
}
