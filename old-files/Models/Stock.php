<?php

namespace App\Models;

use App\Services\BarcodeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $fillable = ['client_id', 'name', 'color', 'size', 'vendor_code', 'count', 'barcode'];

    public function getProducts($id = null) {
        return BarcodeService::getBarcode($this->where('client_id', $id)->get());
    }

    public function createProduct($data) {
        return $this->create([
            'client_id' => (int) $data->ownerId,
            'name' => $data->name,
            'color' => $data->color,
            'vendor_code' => $data->vendorCode,
            'size' => $data->size,
            'count' => $data->count,
            'barcode' => $data->barcode
        ]);
    }

    public function updateProduct($data) {
        return $this->find($data->id)->update([
            'name' => $data->name,
            'color' => $data->color,
            'vendor_code' => $data->vendor_code,
            'size' => $data->size,
            'count' => $data->count,
            'barcode' => $data->barcode
        ]);
    }

    public function deleteProduct($productId) {
        return $this->where('id', $productId)->delete();
    }
}
