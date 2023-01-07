<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockToModelsTable extends Migration
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
            $table->integer('stock')->after('attachment_id')->default(0)->comment('車輛庫存');
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
