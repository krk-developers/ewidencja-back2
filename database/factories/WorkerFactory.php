<?php

use Faker\Generator as Faker;

$factory->define(
    App\Worker::class,
    function (Faker $faker) {
        return [
            'lastname' => $faker->lastName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
);
