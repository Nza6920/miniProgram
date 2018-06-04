<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('分类名称');
            $table->string('introduction')->nullable()->comment('分组描述');
            $table->integer('user_id')->unsigned()->index()->comment('关联的用户id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
