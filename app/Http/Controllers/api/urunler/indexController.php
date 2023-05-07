<?php

namespace App\Http\Controllers\api\urunler;

use App\Http\Controllers\Controller;
use App\Models\UrunlerModel;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        $urunler = UrunlerModel::where(array(
            "urn_durum" => 1
        ))->get();

        $json_data = [];

        if (!empty($urunler)){
            $json_data = [
                "success" => 1,
                "message" => "Ürünler Listesi Getirildi",
                "data" => $urunler
            ];

            $status = 200;
        }else{
            $json_data = [
                "success" => 0,
                "message" =>"Ürünler Bulunamadı"
            ];
            $status = 404;
        }

        return response()->json($json_data,$status);
    }
}
