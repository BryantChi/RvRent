<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIconToAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rv_attachment_infos', function (Blueprint $table) {
            //
            $table->string('attachment_icon')->default('')->nullable()->comment('圖示')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rv_attachment_infos', function (Blueprint $table) {
            //
        });
    }
}
