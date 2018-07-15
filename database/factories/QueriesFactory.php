<?php

use Faker\Generator as Faker;

$factory->define(App\Queries::class, function (Faker $faker) {
    return [
        'qr_name' => $faker->name,
        'qr_phone' => $faker->phoneNumber             ,
        'qr_email' => $faker->email,
        'qr_address' => $faker->address,
        'qr_learningtype' => 'Campus',
        'qr_course' => 'Spoken English, Graphics Designing, Web Development',
    ];
});
