<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\Card::class, function (Faker $faker) {

    $sentence = $faker->sentence();

    return [
        'front' => $faker->text(),
        'behind' => $faker->text(),
    ];
});
