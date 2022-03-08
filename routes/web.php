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













$router->group(['prefix' => 'api'], function () use ($router) {

    //user
    $router->group(['prefix' => 'users'], function () use ($router) {

        $router->post('/login', "UserController@LoginUser");
        $router->post('/register', "UserController@CreateUser");

        $router->group(['middleware'=>'auth'], function () use ($router){
            $router->group(['middleware'=>'checkAdmin'], function () use ($router){
                $router->get('/','UserController@GetAllUsers');
            });
            $router->group(['middleware'=>'checkOwner'], function () use ($router){
                $router->put('/{userId}','UserController@UpdateUser');
                $router->delete('/{userId}', "UserController@DeleteUser");
            });

        });

    });

    $router->get('/course_lessons', 'CourseController@GetLessons');

    $router->post('/course_users',['middleware'=>'auth','uses'=> 'UserController@EnrollUserOnCourse']);

    $router->put('/course_lesson_users/{lessonId}',['middleware'=>'auth','uses'=> 'LessonController@EndLesson']);

    //courses
    $router->group(['prefix' => 'courses'], function () use ($router) {
        $router->get('/', "CourseController@GetAllCourses");
        $router->group(['middleware'=>'checkAdmin'], function () use ($router){
            $router->post('/', "CourseController@CreateCourse");
        });

    });

});
