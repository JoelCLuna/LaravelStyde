<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::defaultStringLength(191);
            Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); //integer unsigned - Autoincrement
            $table->string('name'); //varchar
            $table->string('email')->unique(); //varchar-unique
            $table->string('password'); //varchar
            $table->rememberToken(); //
            $table->timestamps();
        });
    }
 /**
  * Reverse the migrations.
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}