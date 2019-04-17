<?php

use Faker\Generator as Faker;

$factory->define(
    App\Legend::class,
    function (Faker $faker) {
        return [
            'name' => strtoupper($faker->asciify('***')),
            'display_name' => $faker->bothify('Legend # ???'),
            'description' => $faker->sentence($nbWords = 3),
            'working_day' => $faker->numberBetween($min = 0, $max = 1),
        ];
    }
);
