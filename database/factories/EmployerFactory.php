<?php

use Faker\Generator as Faker;

$factory->define(
    App\Employer::class,
    function (Faker $faker) {
        return [
            'company' => $faker->company,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
);
