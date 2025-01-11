<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Services\AdminService;
use App\Http\Resources\Clients\ClientResource;

class ClientController extends Controller
{
    public function get(AdminService $service)
    {
        return ClientResource::collection($service->getClientList());
    }
}
