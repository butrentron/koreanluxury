<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone_at',12);
            $table->string('api');
            $table->string('secret');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone_at');
            $table->dropColumn('api');
            $table->dropColumn('secret');
        });
    }
}
