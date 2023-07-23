<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserSubscriptionResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $message
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function callBackResponse(string $message, $data, int $statusCode = 200): JsonResponse
    {
        return response()->json(['message' => $message, 'data' => $data], $statusCode);
    }
}
