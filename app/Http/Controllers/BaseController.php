<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class BaseController extends Controller
{
    protected function successResponse($data, string $message = 'Success', int $status = 200): JsonResponse
    {
        $payload = [
            'status' => 'success',
            'message' => $message,
        ];

        if ($data instanceof AnonymousResourceCollection) {
            $payload = array_merge($payload, $data->response()->getData(true));
        } else {
            $payload['data'] = $data;
        }

        return response()->json($payload, $status);
    }

    protected function errorResponse(string $message = 'Error', int $status = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }
}
