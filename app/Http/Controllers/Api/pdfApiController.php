<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pdfApiController extends Controller
{
    public function pdfsewa($month, $year){
        $laporan = DB::select("SELECT m.TIPE_MOBIL, m.NAMA_MOBIL, COUNT(t.ID_MOBIL) AS JUMLAH_PEMINJAMAN, SUM(t.JUMLAH_PEMBAYARAN) AS PENDAPATAN FROM transaksi t JOIN mobil m ON(t.ID_MOBIL=m.ID_MOBIL) WHERE (SELECT MONTH(t.TGL_TRANSAKSI))=$month AND (SELECT YEAR(t.TGL_TRANSAKSI))=$year GROUP BY m.TIPE_MOBIL, m.NAMA_MOBIL");

        if(count($laporan) > 0){

            return response([

                'message' => 'Berhasil dicetak!',

                'data'    => $laporan

            ], 200);

        }

        return response([

            'message' => 'Tidak berhasil dicetak!',

            'data'    => $laporan

        ], 400);
    }

    public function pdfpendapatan($month, $year){
        $laporan = DB::select("SELECT c.NAMA_CUSTOMER, m.NAMA_MOBIL, if(t.TRANSAKSI_FORM LIKE 'TRN%01-','Peminjaman Mobil + Driver','Peminjaman Mobil') AS JENIS_TRANSAKSI,COUNT(t.ID_CUSTOMER) AS JUMLAH_TRANSAKSI, SUM(t.JUMLAH_PEMBAYARAN) AS PENDAPATAN FROM transaksi t JOIN customer c ON(t.ID_CUSTOMER=c.ID_CUSTOMER) JOIN mobil m ON(t.ID_MOBIL=m.ID_MOBIL) WHERE (SELECT MONTH(t.TGL_TRANSAKSI))=$month AND (SELECT YEAR(t.TGL_TRANSAKSI))=$year GROUP BY c.NAMA_CUSTOMER, m.NAMA_MOBIL, t.TRANSAKSI_FORM LIMIT 5");

        if(count($laporan) > 0){

            return response([

                'message' => 'Berhasil dicetak!',

                'data'    => $laporan

            ], 200);

        }

        return response([

            'message' => 'Tidak berhasil dicetak!',

            'data'    => $laporan

        ], 400);
    }

    public function pdfdriver($month, $year){
        $laporan = DB::select("SELECT CONCAT(d.DRIVER_FORM,d.ID_DRIVER) AS DRIVER_ID, d.NAMA_DRIVER, COUNT(t.ID_DRIVER) AS JUMLAH_TRANSAKSI FROM driver d JOIN transaksi t ON(d.ID_DRIVER=t.ID_DRIVER) WHERE (SELECT MONTH(t.TGL_TRANSAKSI))=$month AND (SELECT YEAR(t.TGL_TRANSAKSI))=$year GROUP BY d.ID_DRIVER, d.NAMA_DRIVER, d.DRIVER_FORM LIMIT 5");

        if(count($laporan) > 0){

            return response([

                'message' => 'Berhasil dicetak!',

                'data'    => $laporan

            ], 200);

        }

        return response([

            'message' => 'Tidak berhasil dicetak!',

            'data'    => $laporan

        ], 400);
    }

    public function pdfcustomer($month, $year){
        $laporan = DB::select("SELECT c.NAMA_CUSTOMER, COUNT(t.ID_CUSTOMER) AS JUMLAH_TRANSAKSI FROM customer c JOIN transaksi t ON(c.ID_CUSTOMER=t.ID_CUSTOMER) WHERE (SELECT MONTH(t.TGL_TRANSAKSI))=$month AND (SELECT YEAR(t.TGL_TRANSAKSI))=$year GROUP BY c.NAMA_CUSTOMER LIMIT 5");

        if(count($laporan) > 0){

            return response([

                'message' => 'Berhasil dicetak!',

                'data'    => $laporan

            ], 200);

        }

        return response([

            'message' => 'Tidak berhasil dicetak!',

            'data'    => $laporan

        ], 400);
    }

    public function pdfperforma($month, $year){
        $laporan = DB::select("SELECT CONCAT(d.DRIVER_FORM,d.ID_DRIVER) AS DRIVER_ID, d.NAMA_DRIVER, COUNT(t.ID_DRIVER) AS JUMLAH_TRANSAKSI, d.RERATA_RATING_DRIVER FROM driver d JOIN transaksi t ON(d.ID_DRIVER=t.ID_DRIVER) WHERE (SELECT MONTH(t.TGL_TRANSAKSI))=$month AND (SELECT YEAR(t.TGL_TRANSAKSI))=$year GROUP BY d.ID_DRIVER, d.NAMA_DRIVER, d.DRIVER_FORM, d.RERATA_RATING_DRIVER LIMIT 5");

        if(count($laporan) > 0){

            return response([

                'message' => 'Berhasil dicetak!',

                'data'    => $laporan

            ], 200);

        }

        return response([

            'message' => 'Tidak berhasil dicetak!',

            'data'    => $laporan

        ], 400);
    }
}
