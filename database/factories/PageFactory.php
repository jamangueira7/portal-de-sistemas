<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\Page;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

use App\Helpers\Helper;

$factory->define(Page::class, function (Faker $faker) {

    $name = $faker->streetName;
    return [
        'description' => $name,
        'slug' => Helper::slugify($name)
    ];
});
