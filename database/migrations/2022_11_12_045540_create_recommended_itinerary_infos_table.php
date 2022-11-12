<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendedItineraryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommended_itinerary_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itinerary_name')->default('')->comment('行程名稱');
            $table->longText('itinerary_content')->nullable()->comment('行程內容');
            $table->longText('itinerary_content_en')->nullable()->comment('行程內容(EN)');
            $table->integer('itinerary_star')->default('0')->nullable()->comment('行程星等');
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
        Schema::dropIfExists('recommended_itinerary_infos');
    }
}
