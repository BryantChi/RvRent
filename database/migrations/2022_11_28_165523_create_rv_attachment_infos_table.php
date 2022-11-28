<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRvAttachmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rv_attachment_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attachment_name')->default('')->comment('名稱');
            $table->string('attachment_icon')->default('')->comment('圖示');
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
        Schema::dropIfExists('rv_attachment_infos');
    }
}
