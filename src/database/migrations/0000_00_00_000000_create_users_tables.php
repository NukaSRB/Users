<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 64);
            $table->string('email')->index();
            $table->string('first_name')->index()->nullable();
            $table->string('last_name')->index()->nullable();
            $table->string('display_name')->index()->nullable();
            $table->string('timezone')->default('Europe/London');
            $table->string('location')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('status_id')->default(2);
            $table->string('remember_token', 100)->nullable();
            $table->boolean('super_flag')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_statuses');
        Schema::drop('users');
    }
}
