<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyItineraryImgsToItineraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recommended_itinerary_infos', function (Blueprint $table) {
            //
            $table->longText('itinerary_front_cover')->nullable()->default()->commit('封面圖')->change();
            $table->longText('itinerary_imgs')->nullable()->default('[]')->commit('行程圖集')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recommended_itinerary_infos', function (Blueprint $table) {
            //
        });
    }
}
