<?php

use App\Models\Doctor;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;


        $factory->define(Doctor::class, function (Faker $faker) {
            return [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'phone' => $this->faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null,
            ];
        });


