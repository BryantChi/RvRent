<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_order_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_num')->default('')->comment('訂單編號');
            $table->string('order_user')->default('')->comment('會員編號');
            $table->string('order_rv_model_id')->default('')->comment('車型ID');
            $table->longText('order_rv_amount_info')->comment('車型租金資訊');
            $table->string('order_one_night_rental')->default('')->comment('租金單價');
            $table->string('order_total_rental')->default('')->comment('總租金');
            $table->string('order_night_count')->default('')->comment('天數(晚)');
            $table->string('order_get_date')->default('')->comment('取車日');
            $table->string('order_back_date')->default('')->comment('還車日');
            $table->string('order_bed_count')->default('')->comment('床數');
            $table->string('order_rv_vehicle')->default('')->comment('分配車輛');
            $table->string('order_rv_vehicle_payment')->nullable()->comment('車輛繳費');
            $table->string('order_rv_vehicle_payment_status')->nullable()->comment('車輛繳費狀態');
            $table->longText('order_accessory_info')->nullable()->comment('額外配備租借資訊');
            $table->longText('order_mileage_plan_info')->nullable()->comment('里程加購方案');
            $table->string('order_pay_way')->default('')->comment('付款方式');
            $table->longText('order_remit')->nullable()->comment('匯款資訊');
            $table->longText('order_client_note')->nullable()->comment('備註(客戶)');
            $table->longText('order_company_note')->nullable()->comment('備註');
            $table->longText('order_other_driver_info')->nullable()->comment('其他駕駛資訊');
            $table->longText('order_other_driving_licence')->nullable()->comment('其他駕駛駕照');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_order_infos');
    }
}
