<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->text('front')->comment('卡片正面');
            $table->text('behind')->comment('卡片反面');
            $table->integer('user_id')->unsigned()->index()->comment('关联的用户id');
            $table->integer('category_id')->unsigned()->index()->comment('关联的分类id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
