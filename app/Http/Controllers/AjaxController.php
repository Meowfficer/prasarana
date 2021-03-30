<?php

namespace App\Http\Controllers;

use DB;
use App\stok_barang;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function hitung_peminjam()
    {
    	return DB::table('pinjam_barangs')->where('status', 1)->count();
    }

    public function hitung_pengembalian()
    {
    	return DB::table('pinjam_barangs')->where('status', 3)->count();
    }

    public function hitung_total()
    {
    	$a = DB::table('pinjam_barangs')->where('status', 1)->count();
    	$b = DB::table('pinjam_barangs')->where('status', 3)->count();
    	$c = $a + $b;
    	return $c;
    }

    public function seri(Request $request)
    {

        $data = $request->kode_barang;

        $seri = stok_barang::where('kode_barang',$data)
        ->where('status', 1)
        ->get();

        return response()->json([
            'seri' => $seri
        ]);
    }
}
