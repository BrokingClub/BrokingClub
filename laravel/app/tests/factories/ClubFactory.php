<?php
$factory('Club', [
    'name' => $faker->company(),
    'teaser' => $faker->sentence(5),
    'description' => $faker->paragraph(50),
    'slug' =>  str_random(3),
    'owner_id' => 1,
    'created_at' => $faker->dateTime(),
    'updated_at' => $faker->dateTime()
]);