<?php

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\User;
use App\Models\Category;

class CardTableSeeder extends Seeder
{

    public function run()
    {
        // 所有用户 ID 数组, 如: [1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类的 ID 叔祖, 如: [1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $topics = factory(Card::class)
                        ->times(20)
                        ->make()
                        ->each(function ($card, $index)
                            use ($user_ids, $category_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $card->user_id = $faker->randomElement($user_ids);

            // 话题分类，同上
            $card->category_id = $faker->randomElement($category_ids);
        });

        // 将数据集合转换为数组，并插入到数据库中
        Card::insert($topics->toArray());
    }
}
