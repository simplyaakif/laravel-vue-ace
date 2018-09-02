<?php

use Faker\Generator as Faker;

$factory->define(App\Batches::class, function (Faker $faker) {
    return [
        'batch_name'=>$faker->unique()->word,
        'batch_starttime'=>$faker->time,
        'batch_endtime'=>$faker->time,
        'batch_comments'=>$faker->text($maxNbChars = 200),
    ];
});
