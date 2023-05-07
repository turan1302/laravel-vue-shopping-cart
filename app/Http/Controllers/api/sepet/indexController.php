<?php

namespace App\Http\Controllers\api\sepet;

use App\Http\Controllers\Controller;
use App\Models\SepetModel;
use App\Models\UrunlerModel;
use Illuminate\Http\Request;

class indexController extends Controller
{
    // SEPET SAYFASI KODLARI
    public function index(){
        $sepet = SepetModel::leftJoin("urunler","urunler.urn_id","=","sepet.spt_urun")->orderByDesc("sepet.spt_id")->get();

        if (!empty($sepet)){
            $json_data = [
                "success" => 1,
                "message" => "Sepet Verileri Getirildi",
                "data" => $sepet
            ];
            $status = 200;
        }else{
            $json_data = [
                "success" => 1,
                "message" => "Sepet Verileri Boş",
                "data" => []
            ];
            $status = 200;
        }

        return response()->json($json_data,$status);
    }

    // SEPETE EKLEME KODU
    public function store(Request $request){
        $data = $request->except("_token");

        $urun_sorgu = UrunlerModel::where(array(
            "urn_id" => $data['urun_id'],
            "urn_durum" => 1
        ))->first();


        $json_data = [];
        $status = 200;

        if ($urun_sorgu){

            $sepet_sorgu = SepetModel::where(array(
                "spt_urun" => $urun_sorgu->urn_id
            ))->first();

            if ($sepet_sorgu){
                $sepete_ekle = SepetModel::where(array(
                    "spt_urun" => $urun_sorgu->urn_id,
                ))->increment("spt_urun_adet",$data['adet']);

                SepetModel::where(array(
                    "spt_urun" => $urun_sorgu->urn_id
                ))->update(array(
                    "spt_tutar" => $urun_sorgu->urn_fiyat * ($sepet_sorgu->spt_urun_adet + $data['adet'])
                ));

            }else{
                $sepete_ekle = SepetModel::create(array(
                    "spt_urun" => $urun_sorgu->urn_id,
                    "spt_urun_adet" => $data['adet'],
                    "spt_urun_fiyat" => $urun_sorgu->urn_fiyat,
                    "spt_tutar" => $urun_sorgu->urn_fiyat * $data['adet']
                ));
            }


            if ($sepete_ekle){
                $json_data = [
                    "success" => 1,
                    "message" => "İşlem Başarılı"
                ];
                $status = 200;
            }else{
                $json_data = [
                    "success" => 0,
                    "message" => "İşlem Başarısız"
                ];
                $status = 500;
            }
        }else{
            $json_data = [
                "success" => 0,
                "message" => "Ürün Bulunamadı",
            ];
            $status = 404;
        }

        return response()->json($json_data,$status);
    }

    // NAVBAR KISMI SEPET GETİRME İSLEMİNİ GERCEKLESTİRLEİM
    public function getNavbarSepet(){
        $sepet = SepetModel::leftJoin("urunler","urunler.urn_id","=","sepet.spt_urun")->orderByDesc("sepet.spt_id")->limit(3)->get();

        if (!empty($sepet)){
            $json_data = [
                "success" => 1,
                "message" => "Sepet Verileri Getirildi",
                "data" => $sepet
            ];
            $status = 200;
        }else{
            $json_data = [
                "success" => 1,
                "message" => "Sepet Verileri Boş",
                "data" => []
            ];
            $status = 200;
        }

        return response()->json($json_data,$status);
    }

    // GUNCELLE KISMI
    public function guncelle($sepet_id,Request $request){
        $data = $request->except("_token");

        $guncelle = SepetModel::where(array(
            "spt_id" => $sepet_id
        ))->increment("spt_urun_adet",$data['adet']);
    }

    // SEPET SILME KISMI
    public function delete($sepet_id){
        $sonuc = SepetModel::where(array(
            "spt_id" => $sepet_id
        ))->delete();

        if ($sonuc){
            $json_data = [
                "success" => 1,
                "message" => "İşlem Başarılı"
            ];
            $status = 200;
        }else{
            $json_data = [
                "success" => 0,
                "message" => "İşlem Başarısız"
            ];
            $status = 200;
        }

        return response()->json($json_data,$status);
    }
}
