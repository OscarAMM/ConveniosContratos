<?php

use Faker\Generator as Faker;

$factory->define(App\Institute::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
        'acronym' =>$faker->text(5),
        'country'=>$faker->text(10),
    ];
});
$factory->define(App\Dependence::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
        'acronym' =>$faker->text(5),
        'country'=>$faker->text(10),
    ];
});
