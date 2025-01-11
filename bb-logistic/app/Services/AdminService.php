<?php

namespace App\Services;

use App\Models\Role;

class AdminService
{
    public function getClientList()
    {
        return Role::where('name', 'client')->first()->users()->get();
    }
}