<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccessoryInstockToAccessoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessory_infos', function (Blueprint $table) {
            //
            $table->integer('accessory_instock')->after('accessory_quantity')->default(0)->comment('即時庫存(當日)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessory_infos', function (Blueprint $table) {
            //
            $table->dropColumn('accessory_instock');
        });
    }
}
