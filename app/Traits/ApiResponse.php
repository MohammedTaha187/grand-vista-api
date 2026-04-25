<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Unified success response.
     */
    protected function successResponse(
        mixed  $data    = null,
        string $message = 'Operation successful',
        int    $code    = 200,
        array  $meta    = []
    ): JsonResponse {
        $payload = [
            'success' => true,
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ];

        if (! empty($meta)) {
            $payload['meta'] = $meta;
        }

        return response()->json($payload, $code);
    }

    /**
     * Unified No Content response (204).
     * Strictly no body allowed for 204.
     */
    protected function noContentResponse(): Response
    {
        return response()->noContent();
    }

    /**
     * Unified error response with stable error codes.
     */
    protected function errorResponse(
        string $message,
        int    $code      = 400,
        mixed  $errors    = null,
        string $errorCode = 'INTERNAL_ERROR'
    ): JsonResponse {
        return response()->json([
            'success'    => false,
            'status'     => 'error',
            'error_code' => $errorCode,
            'message'    => $message,
            'errors'     => $errors,
        ], $code);
    }

    /**
     * Common error helpers for reliability.
     */
    protected function unauthorizedResponse(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($message, 401, null, 'UNAUTHORIZED');
    }

    protected function forbiddenResponse(string $message = 'Forbidden'): JsonResponse
    {
        return $this->errorResponse($message, 403, null, 'FORBIDDEN');
    }

    protected function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, 404, null, 'NOT_FOUND');
    }

    protected function validationErrorResponse(mixed $errors, string $message = 'Validation failed'): JsonResponse
    {
        return $this->errorResponse($message, 422, $errors, 'VALIDATION_ERROR');
    }
}
