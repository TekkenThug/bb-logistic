<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'delivery_pay', 'delivery_type', 'delivery_time', 'delivery_address', 'delivery_date', 'delivery_fio', 'delivery_phones', 'delivery_comment',
        'delivery_cost'
    ];
}
