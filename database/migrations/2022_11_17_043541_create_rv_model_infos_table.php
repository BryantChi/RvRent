<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRvModelInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rv_model_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rv_name')->default('')->comment('名稱');
            $table->string('rv_front_cover')->nullable()->comment('露營車封面照');
            $table->string('rv_series_id')->default('')->comment('露營車系列');
            $table->string('rv_rent_setting')->nullable()->comment('租金設定');
            $table->longText('rv_discription')->nullable()->comment('露營車介紹');
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
        Schema::dropIfExists('rv_model_infos');
    }
}
