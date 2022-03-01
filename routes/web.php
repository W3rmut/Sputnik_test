<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//Users routes






//API

//Courses





$router->post('/api/course_users', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/course_lessons?course_id=1', function () use ($router) {
    return $router->app->version();
});



$router->put('/api/course_lesson_users/1', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    //user
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('/login', "CourseController@GetAllCourses");
        $router->post('/register', "UserController@CreateUser");
        $router->get('/','UserController@GetAllUsers');
        $router->put('/{userId}', "UserController@UpdateUser");
        $router->delete('/{userId}', "UserController@DeleteUser");
    });
    //courses
    $router->group(['prefix' => 'courses'], function () use ($router) {
        $router->get('/', "CourseController@GetAllCourses");
        $router->post('/', "CourseController@CreateCourse");
    });

});
