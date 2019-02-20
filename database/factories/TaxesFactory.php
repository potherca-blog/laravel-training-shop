<?php

use Faker\Generator as Faker;

$factory->define(App\Tax::class, function (Faker $faker) {
    $value = $faker->randomElement([0, 90, 160, 210]);

    return [
        'name' => sprintf('%d%s', $value, '%%'),
        'value' => $value,
    ];
});

$factory->state(App\Tax::class, 'none', [
    'name' => '0%',
    'value' => 0,
]);

$factory->state(App\Tax::class, 'nine-percent', [
    'name' => '9%',
    'value' => 90,
]);

$factory->state(App\Tax::class, 'sixteen-percent', [
    'name' => '16%',
    'value' => 160,
]);

$factory->state(App\Tax::class, 'twenty-one-percent', [
    'name' => '21%',
    'value' => 210,
]);
