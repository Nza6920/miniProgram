<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserData extends Migration
{
    public function up()
    {
        $users = [
          [
            'name' => 'admin',
            'avatar' => 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'openid' => '1234123412341234123',
            'weixin_session_key' => '123412412412124',
          ],
          [
            'name' => 'admin2',
            'avatar' => 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'openid' => '1234123341234123',
            'weixin_session_key' => '123412412412124',
          ],
          [
            'name' => 'admin3',
            'avatar' => 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'openid' => '123412341234134123',
            'weixin_session_key' => '123412412412124',
          ],
          [
            'name' => 'admin4',
            'avatar' => 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'openid' => '12341234123412341',
            'weixin_session_key' => '123412412412124',
          ],
        ];

        DB::table('users')->insert($users);
    }

    public function down()
    {
        DB::table('categories')->truncate();
    }
}
