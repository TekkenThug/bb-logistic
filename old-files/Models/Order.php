<?php

namespace App\Models;

use http\Params;
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

    // Получить заказы
    public function getOrders($filter = null, $text = null) {
        $role = auth()->user()->hasRole();
        $id = auth()->id();

        if ($role === 'client') {
            if ($filter)
                return $this->where(['client_id' => $id, 'status' => $filter])->latest()->get();

            return $this->where('client_id', $id)->latest()->get();
        } else if ($role === 'courier') {
            if ($filter === 'open') {
                $orders = $this->where('courier_id', $id)->whereIn('status', ['pending', 'courier'])->get();

                foreach ($orders as $order) {
                    $order['fenceAddress'] = $order->client->delivery_address;
                }

                return $orders;
            }

            return $this->where(['courier_id' => $id, 'status' => 'finished'])->get();
        } else {
            $answer = $this;
            if ($filter || $text) {
                if ($filter)
                    $answer = $answer->where('status', $filter);

                if ($text)
                    $answer = $answer->where('id', 'LIKE', "%{$text}%");

                return $answer->latest()->get();
            } else {
                return $this->latest()->get();
            }
        }
    }

    // Получить один заказ
    public function getOrder($id) {
        if (auth()->user()->roles->name === 'client')
            return $this->where(['id' => $id, 'client_id' => auth()->id()])->first();
        else if (auth()->user()->roles->name === 'admin')
            return $this->find($id);
    }
}
