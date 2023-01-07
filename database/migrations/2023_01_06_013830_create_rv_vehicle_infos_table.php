<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRvVehicleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rv_vehicle_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_num')->default('')->comment('車牌號碼');
            $table->string('model_id')->default('')->comment('車型');
            $table->string('vehicle_status')->default('rent_stay')->comment('車輛狀態');
            $table->boolean('rent_status')->default('0')->comment('租賃狀態');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rv_vehicle_infos');
    }
}
