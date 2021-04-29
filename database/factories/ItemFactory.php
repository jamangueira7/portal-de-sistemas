<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Helpers\Helper;
use App\model\Item;
use Faker\Generator as Faker;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(Item::class, function (Faker $faker) {

    $title = $faker->title;
    return [
        'title' => $title,
        'url' => $faker->url,
        'slug' => Helper::slugify($title),
    ];
});
