<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFeildToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('customer_id')->unique()->after('id')->comment('會員編號');
            $table->string('name')->comment('會員姓名')->change();
            $table->string('nick_name')->nullable()->after('name')->comment('暱稱');
            $table->string('email')->comment('信箱')->change();
            $table->string('country')->default('台灣')->after('password')->comment('國別');
            $table->string('phone')->default('')->after('country')->comment('電話');
            $table->string('line_id')->nullable()->after('phone')->comment('LineID');
            $table->char('gender')->default('N')->after('line_id')->comment('性別');
            $table->date('birthday')->after('gender')->after('gender')->comment('生日');
            $table->string('driving_licence_number')->unique()->default('')->after('birthday')->comment('駕照號碼');
            $table->string('driving_licence_type')->default('')->after('driving_licence_number')->comment('駕照種類');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     //
        // });
        Schema::dropIfExists('customer_infos');
    }
}
