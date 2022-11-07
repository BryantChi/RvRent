<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('customer_id')->unique()->comment('會員編號');
            $table->string('customer_name')->default('')->comment('會員姓名');
            $table->string('customer_nick_name')->nullable()->comment('暱稱');
            $table->string('customer_phone')->default('')->comment('電話');
            $table->char('customer_gender')->default('N')->comment('性別');
            $table->string('customer_driving_licence_number')->unique()->default('')->comment('駕照號碼');
            $table->string('customer_driving_licence_type')->default('')->comment('駕照種類');
            $table->date('customer_birthday')->comment('生日');
            $table->string('customer_mail')->nullable()->comment('信箱');
            $table->string('customer_line_id')->nullable()->comment('LineID');
            $table->string('customer_country')->default('台灣')->comment('國別');
            $table->string('customer_verify')->default('false')->nullable()->comment('驗證');
            $table->string('customer_token')->default('')->comment('Token');
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
        Schema::dropIfExists('customer_infos');
    }
}
