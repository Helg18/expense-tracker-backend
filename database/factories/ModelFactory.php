<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'category' => $faker->word,
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
	$flag = rand(0,1);
	$tot = ($flag) ? "withdrawal" : "deposit";
    $created_at = $faker->dateTimeThisDecade($max = 'now', $timezone = date_default_timezone_get());

    return [
		'subject' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'amount' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 200, $max = 2),
		'tot' =>  $tot,
		'category_id' => $faker->numberBetween($min = 1, $max = 5),
        'fecha_creado' => $created_at,
    ];
});
