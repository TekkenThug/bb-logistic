<?php


namespace App\Services;


use Milon\Barcode\DNS1D;

class BarcodeService
{
    public static function getBarcode($arr)
    {
        foreach ($arr as $elem) {
            $elem->barcodeImagePath = DNS1D::getBarcodePNGPath('4445645656', 'PHARMA2T',3,33,array(255,255,0));
        }

        return $arr;
    }
}
