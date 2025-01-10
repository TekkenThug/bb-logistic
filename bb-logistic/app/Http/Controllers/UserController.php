<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Get current authenticated user
     */
    public function me(): UserResource
    {
        return new UserResource(Auth::user());
    }

    /**
     * Create user
     */
    public function create(UserService $service, CreateUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $newUser = $service->createNewUser($validated);

        return response()->json([
            'first_name' => $newUser['first_name'],
            'last_name' => $newUser['last_name'],
            'email' => $newUser['email']
        ]);
    }
}
