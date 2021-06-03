<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'delivery_pay', 'delivery_type', 'delivery_time', 'delivery_address', 'delivery_date', 'delivery_fio', 'delivery_phones', 'delivery_comment',
        'delivery_cost', 'status', 'courier_id'
    ];

    public function goods() {
        return $this->hasMany(Good::class);
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function courier() {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function getOrder($id) {
        if (auth()->user()->roles->name === 'client')
            return $this->where(['id' => $id, 'client_id', auth()->id()]);
        else if (auth()->user()->roles->name === 'admin')
            return $this->find($id);
    }
}
