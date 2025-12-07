<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controlador Base RESTful
 * Todos los controladores heredan de aquí para seguir estándares REST
 */
class RestfulController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Respuesta REST exitosa
     */
    protected function successResponse($data = null, $message = 'Operación exitosa', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Respuesta REST con error
     */
    protected function errorResponse($message = 'Error en la operación', $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    /**
     * Respuesta para recurso no encontrado
     */
    protected function notFoundResponse($message = 'Recurso no encontrado')
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Respuesta para validación fallida
     */
    protected function validationErrorResponse($errors)
    {
        return $this->errorResponse('Validación fallida', 422, $errors);
    }
}
