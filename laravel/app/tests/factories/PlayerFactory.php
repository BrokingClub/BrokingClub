<?php
$factory('Player', [
    'user_id' => User::orderBy(DB::raw('RAND()'))->first()->id,
    'balance' => rand(10000,50000),
    'firstname' => $faker->firstName(),
    'lastname' => $faker->lastName(),
    'created_at' => $faker->dateTime(),
    'updated_at' => $faker->dateTime()
]);