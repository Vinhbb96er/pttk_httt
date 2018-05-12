<?php

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

$factory->define(App\Models\Position::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'name' => implode('', $faker->unique()->words(2)),
    ];
});

$factory->define(App\Models\Faculty::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'name' => implode('', $faker->unique()->words(rand(1, 2))),
    ];
});

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'position_id' => App\Models\Position::all()->random()->id,
        'faculty_id' => App\Models\Faculty::all()->random()->id,
        'name' => $faker->name,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => (bool) rand(0, 1),
        'address' => $faker->address,
        'phone' => $faker->randomNumber,
        'email' => $faker->unique()->safeEmail,
        'image' => $faker->image($dir = '/tmp', $width = 200, $height = 200),
        'role' => rand(1, 3),
        'account' => $faker->unique()->userName,
        'password' => 'secret',
        'status' => rand(0, 1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Patient::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'name' => $faker->name,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => (bool) rand(0, 1),
        'address' => $faker->address,
        'phone' => $faker->randomNumber,
        'kind' => rand(1, 2),
        'image' => $faker->image($dir = '/tmp', $width = 200, $height = 200),
        'reception_date' => $faker->date(),
        'insurance_number' => $faker->swiftBicNumber,
        'expiration_date' => $faker->date(),
    ];
});

$factory->define(App\Models\Registration::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'patient_id' => App\Models\Patient::all()->random()->id,
        'faculty_id' => App\Models\Faculty::all()->random()->id,
        'create_date' => $faker->date(),
    ];
});

$factory->define(App\Models\MedicalRecord::class, function (Faker $faker) {
    return [
        'id' => uniqid(),
        'patient_id' => App\Models\Patient::all()->random()->id,
        'faculty_id' => App\Models\Faculty::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
        'create_date' => $faker->date(),
        'patient_status' => $faker->paragraph(1),
        'bed_number' => $faker->swiftBicNumber,
        'status' => rand(1, 3),
        'note' => $faker->paragraph(2),
    ];
});
