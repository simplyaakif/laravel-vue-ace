<?php

use Faker\Generator as Faker;

$factory->define(App\Expenses::class, function (Faker $faker) {
    return [
        'expense_name' => $faker->name,
        'expense_company' => $faker->name,
        'expense_amount' => $faker->name,
        'expense_issuedate' => $faker->name,
        'expense_duedate' => $faker->name,

    ];
});
