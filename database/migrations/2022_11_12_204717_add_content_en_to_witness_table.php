<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentEnToWitnessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_witness_infos', function (Blueprint $table) {
            //
            $table->longText('content')->default('')->nullable()->comment('內容')->change();
            $table->longText('content_en')->default('')->after('content')->comment('內容(EN)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_witness_infos', function (Blueprint $table) {
            //
        });
    }
}
