<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentToRvmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rv_model_infos', function (Blueprint $table) {
            //
            $table->longText('attachment_id')->after('rv_rent_setting')->comment('車輛配件');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rv_model_infos', function (Blueprint $table) {
            //
        });
    }
}
