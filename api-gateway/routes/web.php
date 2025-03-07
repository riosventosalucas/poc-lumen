<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

$router->group(['prefix' => 'api'], function () use ($router) {
    
    // 🔹 Login: Redirige al backend
    $router->post('login', function (Request $request) {
        $client = new Client();
        $response = $client->post(env('BACKEND_URL') . '/login', [
            'json' => $request->all()
        ]);
        return response()->json(json_decode($response->getBody()), $response->getStatusCode());
    });

    // 🔹 Registro de usuario
    $router->post('register', function (Request $request) {
        $client = new Client();
        $response = $client->post(env('BACKEND_URL') . '/register', [
            'json' => $request->all()
        ]);
        return response()->json(json_decode($response->getBody()), $response->getStatusCode());
    });

    // 🔹 Grupo de rutas protegidas con JWT
    $router->group(['middleware' => 'auth'], function () use ($router) {

        // Obtener perfil del usuario
        $router->get('profile', function (Request $request) {
            $client = new Client();
            $response = $client->get(env('BACKEND_URL') . '/profile', [
                'headers' => [
                    'Authorization' => $request->header('Authorization')
                ]
            ]);
            return response()->json(json_decode($response->getBody()), $response->getStatusCode());
        });

        // Obtener contactos (requiere JWT)
        $router->get('contacts', function (Request $request) {
            $client = new Client();
            $response = $client->get(env('BACKEND_URL') . '/api/contacts', [
                'headers' => [
                    'Authorization' => $request->header('Authorization')
                ]
            ]);
            return response()->json(json_decode($response->getBody()), $response->getStatusCode());
        });

        // Cerrar sesión (invalida el token)
        $router->post('logout', function (Request $request) {
            $client = new Client();
            $response = $client->post(env('BACKEND_URL') . '/logout', [
                'headers' => [
                    'Authorization' => $request->header('Authorization')
                ]
            ]);
            return response()->json(json_decode($response->getBody()), $response->getStatusCode());
        });

    });

});


$router->get('/', function () use ($router) {
    return $router->app->version();
});
