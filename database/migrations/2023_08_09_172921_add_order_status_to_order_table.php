<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderStatusToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_order_infos', function (Blueprint $table) {
            //
            $table->string('order_status')->after('order_num')->comment('訂單狀態');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_order_infos', function (Blueprint $table) {
            //
            $table->dropColumn('order_status');
        });
    }
}
