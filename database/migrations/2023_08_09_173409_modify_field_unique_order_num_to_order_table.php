<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFieldUniqueOrderNumToOrderTable extends Migration
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
            $table->string('order_num')->unique()->comment('訂單編號')->change();
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
            $table->dropUnique('order_num');
        });
    }
}
