<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        try {
            // Obtener el token JWT de la cabecera Authorization
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json(['error' => 'Token no proporcionado'], 401);
            }

            // Eliminar "Bearer " del token
            $jwt = str_replace('Bearer ', '', $token);

            // En lugar de autenticar (que consulta la DB), obtenemos el payload del token
            $payload = JWTAuth::setToken($jwt)->getPayload();

            // Añadir el payload (los datos del token) al request
            $request->attributes->add(['user' => $payload->toArray()]);

            return $next($request);

        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error de autenticación'], 500);
        }
    }
}
