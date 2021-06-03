<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'delivery_address', 'phone_number', 'courier_comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function clients() {
        return Role::find(2)->users()->get();
    }

    public function couriers() {
        return Role::find(3)->users()->get();
    }

    public function ordersWhereParts($role) {
        if ($role === 'client') {
            $str = 'client_id';
        } else {
            $str = 'courier_id';
        }

        return Order::where($str, $this->id)->get();
    }

    public function searchByName($name, $role) {
        return $this->where('name', 'LIKE', "%{$name}%")
            ->where('role_id', Role::firstWhere('name', $role)->id)
            ->get();
    }

    public function hasRole() {
        return $this->roles->name;
    }

    public function updateUser($data, $role, $password) {
        if ($role === 'courier') {
            if ($password) {
                return $this->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone'],
                    'password' => bcrypt($data['password'])
                ]);
            } else {
                return $this->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone'],
                ]);
            }
        }

        return false;
    }
}
