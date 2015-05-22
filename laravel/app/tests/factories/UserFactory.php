<?php
$factory('User', [
    'id' => 1,
    'username' => $faker->firstName(),
    'email' => $faker->companyEmail(),
    'password' => "notsecure",
    'role' => 'user',
    'confirmed' => 1,
    'created_at' => $faker->dateTime(),
    'updated_at' => $faker->dateTime()
]);