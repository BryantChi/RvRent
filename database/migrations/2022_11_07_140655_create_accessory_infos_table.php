<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('accessory_id')->unique()->comment('配件編號');
            $table->string('accessory_name')->default('')->comment('配件名稱');
            $table->text('accessory_specification')->nullable()->comment('規格');
            $table->date('accessory_buy_date')->comment('購買日期');
            $table->integer('accessory_quantity')->default('0')->nullable()->comment('數量');
            $table->double('accessory_unit_price')->default('0.00')->nullable()->comment('進價單價');
            $table->double('accessory_gross_price')->default('0.00')->nullable()->comment('總價');
            $table->double('accessory_rent_price')->default('0.00')->nullable()->comment('租金');
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
        Schema::dropIfExists('accessory_infos');
    }
}
