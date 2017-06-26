<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('flickr');
            $table->string('google');
            $table->string('dribbble');
            $table->string('title');
            $table->string('description');
            $table->string('keyword');
            $table->string('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
