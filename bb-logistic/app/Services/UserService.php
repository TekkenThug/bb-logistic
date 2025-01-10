<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createNewUser(array $data)
    {
        $payload = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'], ['rounds' => 12]),
            'role_id' => Role::where('name', $data['role'])->first()['id']
        ];

        if ($data['role'] == 'client')
        {
            $payload['address_id'] = Address::create(['address' => $data['address']])['id'];
        }

        if ($data['role'] == 'courier')
        {
            $payload['phone_number'] = $data['phone_number'];
        }

        $user = User::create($payload);

        return $user;
    }
}