<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Users\UserResource;

class UserController extends Controller
{
    /**
     * Get current authenticated user
     */
    public function me(): UserResource
    {
        return new UserResource(Auth::user());
    }
}
