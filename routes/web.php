<?php

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

$router->get('/', function () use ($router) {
    return "hi";
    #return $router->app->version();
});

$router->group();

$router->get('/users', "UserController@index");
$router->get('/users/make', "UserController@store");
$router->get('/users/{id}', "UserController@show");
$router->get('/users/edit/{id}', "UserController@update");
$router->get('/users/delete/{id}', "UserController@delete");


$router->get('/projects', "ProjectController@index");
$router->get('/proposals', "ProposalController@index");
