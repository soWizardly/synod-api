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
    return $router->app->version();
});

$router->post('login', 'SessionController@login');
$router->post('logout', 'SessionController@logout');

#$router->group(["middleware" => "auth"], function () use ($router) {

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('', "UserController@index");
        $router->post('/', "UserController@store");
        $router->get('/{id}', "UserController@show");
        $router->put('/{id}', "UserController@update");
        $router->delete('/{id}', "UserController@delete");
    });

    $router->group(['prefix' => 'projects'], function () use ($router) {
        $router->get('', "ProjectController@index");
        $router->post('/', "ProjectController@store");
        $router->get('/{id}', "ProjectController@show");
        $router->put('/{id}', "ProjectController@update");
        $router->delete('/{id}', "ProjectController@delete");
    });

    $router->group(['prefix' => 'proposals'], function () use ($router) {
        $router->get('', "ProposalController@index");
        $router->post('/', "ProposalController@store");
        $router->get('/{id}', "ProposalController@show");
        $router->put('/{id}', "ProposalController@update");
        $router->delete('/{id}', "ProposalController@delete");
    });

#});

