<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgsFieldToRecommendedItineraryTable extends Migration
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
            $table->longText('itinerary_front_cover')->nullable()->default('')->after('itinerary_name')->commit('封面圖');
            $table->longText('itinerary_imgs')->nullable()->default('')->after('itinerary_star')->commit('行程圖集');
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
