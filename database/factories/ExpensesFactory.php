<?php

use Faker\Generator as Faker;

$factory->define(App\Expenses::class, function (Faker $faker) {
    return [
        'expense_name' => $faker->word,
        'expense_company' => $faker->word,
        'expense_amount' => rand(5000, 95000),
        'expense_issuedate' => $faker->name,
        'expense_duedate' => $faker->name,

    ];
});
