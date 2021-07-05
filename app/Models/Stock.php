<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $fillable = ['client_id', 'name', 'color', 'size', 'vendor_code', 'count'];

    public function getProducts($id = null) {
        return $this->where('client_id', $id)->get();
    }

    public function createProduct($data) {
        return $this->create([
            'client_id' => (int) $data->ownerId,
            'name' => $data->name,
            'color' => $data->color,
            'vendor_code' => $data->vendorCode,
            'size' => $data->size,
            'count' => $data->count,
        ]);
    }

    public function deleteProduct($productId) {
        return $this->where('id', $productId)->delete();
    }
}
