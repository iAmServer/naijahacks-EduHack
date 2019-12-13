<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Admission;
use App\CommunityEngagement;
use App\Course;
use App\CourseOffered;
use App\Expert;
use App\SavedSearch;
use App\School;
use App\SubCourse;
use App\TestOption;
use App\TestQuestion;
use App\TestResult;
use App\Training;
use App\Video;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
    ];
});

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->word(2),
        'user_id' => $faker->numberBetween(1, 3),
        'keyword' => $faker->word,
        'description' => $faker->paragraph(10),
        'work' => $faker->paragraph(10),
        'salary' => $faker->numberBetween(50000, 250000),
    ];
});

$factory->define(SubCourse::class, function (Faker $faker) {
    return [
        'course_id' => $faker->numberBetween(1, 3),
        'name' => $faker->word(2),
        'keyword' => $faker->word,
        'description' => $faker->paragraph(10),
        'work' => $faker->paragraph(10),
        'salary' => $faker->numberBetween(50000, 250000),
    ];
});

$factory->define(Department::class, function (Faker $faker) {
    return [
        'school_id' => $faker->numberBetween(1, 10),
        'full_name' => $faker->sentence(4),
        'short_name' => $faker->unique()->word,
        'user_id' => $faker->numberBetween(1, 10),
        'logo' => 3,
    ];
});

$factory->define(Course::class, function (Faker $faker) {
    $department = App\Department::find($faker->numberBetween(1, 20));
    return [
        'school_id' => $department->school_id,
        'department_id' => $department->id,
        'user_id' => $faker->numberBetween(1, 10),
        'code' => $faker->word,
        'title' => $faker->sentence(5),
        'tags' => $faker->sentence(5),
        'description' => $faker->text(500),
        'logo' => 4,
    ];
});

$factory->define(CourseContent::class, function (Faker $faker) {
    return [
        'course_id' => $faker->numberBetween(1, 40),
        'article' => '
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>',
        'video' =>  '
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>',
        'book' =>  '
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>
                    History of electronics <a href="http://google.com/electronics">http://google.com/electronics</a> <br/>',
    ];
});

$factory->define(CourseMaterial::class, function (Faker $faker) {
    $course = App\Course::find($faker->numberBetween(1, 40));
    return [
        'course_id' => $course->id,
        'school_id' => $course->school_id,
        'department_id' => $course->department_id,
        'user_id' => $faker->numberBetween(1, 10),
        'token' => Str::random(10),
        'name' => $faker->sentence(5),
        'file_path' => 'material.pdf',
        'file_type' => 'pdf',
        'file_size' => '135KB',
        'cover_image' => 1,
    ];
});

$factory->define(Library::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'course_material_id' => $faker->numberBetween(1, 120),
    ];
});

$factory->define(Download::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'course_material_id' => $faker->numberBetween(1, 120),
    ];
});

$factory->define(Preview::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'ip_address' => '::1',
        'course_material_id' => $faker->numberBetween(1, 120),
    ];
});

$factory->define(Image::class, function (Faker $faker) {
    return [
        'file_path' => 'cover.png',
        'imageable_id' => 1,
        'imageable_type' => $faker->unique()->randomElement(['App\User', 'App\School', 'App\Department', 'App\Course', 'App\CourseMaterial']),
    ];
});

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Admin', 'Subscriber']),
    ];
});
