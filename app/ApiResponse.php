<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function validationErrorResponse($errors, $message = 'Validation failed.')
    {
        return $this->errorResponse($message, 422, $errors);
    }

    protected function notFoundResponse($message = 'Resource not found.')
    {
        return $this->errorResponse($message, 404);
    }

    protected function unauthorizedResponse($message = 'Unauthorized.')
    {
        return $this->errorResponse($message, 401);
    }

    protected function forbiddenResponse($message = 'Forbidden.')
    {
        return $this->errorResponse($message, 403);
    }

    protected function serverErrorResponse($message = 'Internal server error.')
    {
        return $this->errorResponse($message, 500);
    }
}