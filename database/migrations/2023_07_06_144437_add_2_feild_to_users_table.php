<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add2FeildToUsersTable extends Migration
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
            $table->longText('profile_photo')->nullable()->after('customer_id')->comment('大頭照');
            $table->boolean('driving_licence_certified')->default(false)->after('driving_licence')->comment('駕照認證');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('profile_photo');
            $table->dropColumn('driving_licence_certified');
        });
    }
}
