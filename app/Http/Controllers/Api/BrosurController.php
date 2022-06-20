<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brosur;
use Illuminate\Support\Facades\DB;

class BrosurController extends Controller
{
    public function index(){
        $brosurs = DB::select("SELECT NAMA_MOBIL, JENIS_TRANSMISI_MOBIL, FASILITAS_MOBIL, HARGA_SEWA FROM mobil WHERE STATUS_MOBIL='Tersedia' ");

        if(count($brosurs) > 0){

            return response([

                'message' => 'Brosur berhasil ditampilkan!',

                'data'    => $brosurs

            ], 200);

        }

        return response([

            'message' => 'Brosur tidak berhasil ditampilkan!',

            'data'    => $brosurs

        ], 400);
    }
}
