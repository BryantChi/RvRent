<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentWitnessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_witness_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('標題');
            $table->string('witness_front_cover')->nullable()->comment('封面');
            $table->string('content')->default('')->comment('內容');
            $table->longText('path')->nullable()->comment('圖片');
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
        Schema::dropIfExists('rent_witness_infos');
    }
}
