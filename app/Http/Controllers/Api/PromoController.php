<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function index(){
        $promos = DB::select("SELECT * FROM promo WHERE STATUS_PROMO='Aktif' ");

        if(!is_null($promos)){

            return response([

                'message' => 'Promo berhasil ditampilkan!',

                'data'    => $promos

            ], 200);

        }

        return response([

            'message' => 'Promo tidak berhasil ditampilkan!',

            'data'    => $promos

        ], 400);
    }
}
