<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
      // 所有用户 ID 数组，如：[1,2,3,4]
      $user_ids = User::all()->pluck('id')->toArray();

      // 获取 Faker 实例
      $faker = app(Faker\Generator::class);

      $topics = factory(Category::class)
                        ->times(5)
                        ->make()
                        ->each(function ($category, $index)
                            use ($user_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $category->user_id = $faker->randomElement($user_ids);

        });

        // 将数据集合转换为数组，并插入到数据库中
        Category::insert($topics->toArray());

    }
}
