<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userDetails(Request $request): JsonResponse
    {
        $user = $this->userService->listUser($request->all());
        return response()->json([
            'message' => 'The user was successfully fetched.',
            'data' => UserResource::collection($user)
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function userById(int $id): JsonResponse
    {
        $user = $this->userService->showUser($id);
        return response()->json([
            'message' => 'The user was successfully fetched.',
            'data' => new UserResource($user)
        ]);
    }
}
