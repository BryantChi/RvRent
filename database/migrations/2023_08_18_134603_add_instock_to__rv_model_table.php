<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstockToRvModelTable extends Migration
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
            $table->integer('in_stock')->after('stock')->default(0)->comment('即時庫存(當日)');
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
            $table->dropColumn('in_stock');
        });
    }
}
