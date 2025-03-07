<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|---------------------------------------------------------------------------
| Application Routes
|---------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Rutas protegidas por autenticación
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    // Listar todos los contactos
    $router->get('contacts', 'ContactController@index');
    
    // Crear un nuevo contacto
    $router->post('contacts', 'ContactController@store');
    
    // Mostrar un contacto por su ID
    $router->get('contacts/{id}', 'ContactController@show');
    
    // Actualizar un contacto por su ID
    $router->put('contacts/{id}', 'ContactController@update');
    
    // Eliminar un contacto por su ID
    $router->delete('contacts/{id}', 'ContactController@destroy');
});

// Rutas para el registro y login de usuario
$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');

// Rutas protegidas por autenticación para el perfil y logout
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('profile', 'AuthController@profile');
    $router->post('logout', 'AuthController@logout');
});
