<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('firm_id')->unique()->comment('廠商編號');
            $table->string('firm_name')->default('')->comment('廠商名稱');
            $table->string('firm_vat_number')->default('')->comment('統一編號');
            $table->string('firm_phone')->default('')->comment('電話');
            $table->string('firm_fax')->default('')->comment('傳真');
            $table->string('firm_email')->nullable()->comment('信箱');
            $table->string('firm_line_id')->nullable()->comment('LineID');
            $table->boolean('firm_verify')->default('0')->nullable()->comment('驗證');
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
        Schema::dropIfExists('firm_infos');
    }
}
