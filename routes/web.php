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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['middleware' => 'client.credentials', 'prefix' => 'v1'], function () use ($router) {
        /**
         * Users routes
         */
        $router->get('/users/exists', 'UserController@exists');
        $router->post('/users', 'UserController@store');
    });

    $router->group(['middleware' => 'auth', 'prefix' => 'v1'], function () use ($router) {
        $router->get('/authors', ['uses' => 'AuthorController@index']);
        $router->get('/authors/{id}', ['uses' => 'AuthorController@get']);
        $router->post('/authors', ['uses' => 'AuthorController@post']);
        $router->put('/authors/{id}', ['uses' => 'AuthorController@put']);
        $router->patch('/authors/{id}', ['uses' => 'AuthorController@patch']);
        $router->delete('/authors/{id}', ['uses' => 'AuthorController@delete']);

        $router->get('/books', ['uses' => 'AuthorController@index']);
        $router->get('/books/{id}', ['uses' => 'AuthorController@get']);
        $router->post('/books', ['uses' => 'AuthorController@post']);
        $router->put('/books/{id}', ['uses' => 'AuthorController@put']);
        $router->patch('/books/{id}', ['uses' => 'AuthorController@patch']);
        $router->delete('/books/{id}', ['uses' => 'AuthorController@delete']);
    });
});
