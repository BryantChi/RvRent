<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFeildSpecTypeToAccessoryTable extends Migration
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
            $table->longText('accessory_specification')->default('[]')->nullable()->comment('規格')->change();
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
            $table->text('accessory_specification')->nullable()->comment('規格')->change();
        });
    }
}
