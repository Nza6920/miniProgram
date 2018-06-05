<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeixinSessionKeyToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('openid')->nullable()->unique()->comment('微信openid');
            $table->string('weixin_session_key')->nullable()->comment('微信session_key');
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('openid');
           $table->dropColumn('weixin_session_key');
        });
    }
}
