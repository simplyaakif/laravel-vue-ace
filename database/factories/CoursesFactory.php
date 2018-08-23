<?php

use Faker\Generator as Faker;

$factory->define(App\Courses::class, function (Faker $faker) {
    return [
        'course_name'=>$faker->unique()->word,
        'course_duration'=>rand(1,6).' month',
        'course_fee'=>rand(5000, 15000),
        'course_comments'=>$faker->realText,

    ];
});
