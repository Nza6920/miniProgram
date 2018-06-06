<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('avatar')->nullable()->comment('头像');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
