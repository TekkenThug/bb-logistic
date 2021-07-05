<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (auth()->user()->hasRole() === 'client')
            return [
                'name' => $this->name,
                'color' => $this->color,
                'size' => $this->size,
                'vendor_code' => $this->vendor_code,
                'count' => $this->count,
            ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'size' => $this->size,
            'vendor_code' => $this->vendor_code,
            'barcode' => $this->barcode,
//            'barcodeImg' => $this->barcodeImagePath,
            'count' => $this->count,
        ];
    }
}
