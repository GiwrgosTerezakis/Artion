<?php

use App\Models\Api;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;


$factory->define(Api::class, function (Faker $faker) {
    return [
        'title' => $this->faker->title,
        'text' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
        'author' => $this->faker->name,
        'views' => $this->faker->boolean,
        'date_posted' => $faker->dateTimeBetween('-3 years', 'now'),
    ];
});


