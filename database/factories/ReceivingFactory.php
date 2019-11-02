<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'body' => $faker->paragraph(1),
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
    ];
});
