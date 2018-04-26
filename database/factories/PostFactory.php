<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'title' => $faker->text(80),
        'user_id' => factory(User::class)->create()->id
    ];
});
