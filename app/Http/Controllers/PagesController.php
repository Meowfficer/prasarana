<?php

namespace App\Http\Controllers;
use App\Barang;
use App\PinjamBarang;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index(Request $request)
	{
		$charts = $request->get('tahun-charts');
		$greetings = "";

		/* This sets the $time variable to the current hour in the 24 hour clock format */
		// $time = date("H");
        $time = Carbon::now('G')->format('H');

        /* Set the $timezone variable to become the current timezone */
		// $timezone = date("UTC");

        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
           $greetings = "Selamat Pagi";
       } else

       /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
       if ($time >= "12" && $time < "17") {
           $greetings = "Selamat Siang";
       } else

       /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
       if ($time >= "17" && $time < "19") {
           $greetings = "Selamat Sore";
       } else

       /* Finally, show good night if the time is greater than or equal to 1900 hours */
       if ($time >= "19") {
           $greetings = "Selamat Malam";
       }

       $get_tahun = DB::table('pinjam_barangs')
       ->latest()
       ->get();

       $cek_chart = DB::table('pinjam_barangs')
       ->whereYear('created_at', date('Y'))
       ->get();


       $total_peminjam = [];

       for ($i=1; $i <= 12; $i++) {
         if (Auth::user()->role == '1') {
            $peminjam = DB::table('pinjam_barangs')
            ->select(DB::raw('sum(pinjam_barangs.jml_barang) as jml_barang, date_format(created_at, "%m") as bulan'))
            ->where(function ($query) use($charts){
                if ($charts != "") {
                    $query->whereYear('pinjam_barangs.created_at', $charts);
                }else{
                    $query->whereYear('pinjam_barangs.created_at', date('Y'));
                }
            })
            ->where('status', '!=', 5)
            ->whereMonth('created_at', $i)
            ->groupBy('bulan')
            ->get();
        }else{
            $peminjam = DB::table('pinjam_barangs')
            ->select(DB::raw('sum(pinjam_barangs.jml_barang) as jml_barang, date_format(created_at, "%m") as bulan'))
            ->where(function ($query) use($charts){
                if ($charts != "") {
                    $query->whereYear('pinjam_barangs.created_at', $charts);
                }else{
                    $query->whereYear('pinjam_barangs.created_at', date('Y'));
                }
            })
            ->where('id_peminjam', Auth::user()->id)
            ->where('status', '!=', 5)
            ->whereMonth('created_at', $i)
            ->groupBy('bulan')
            ->get();
        }
        if (count($peminjam) == 0) {
            $total_peminjam[$i] = 0;
        }else {
            $jum_total = 0;
            foreach ($peminjam as $key => $value) {
                $jum_total += $value->jml_barang;
            }
            $total_peminjam[$i] = $jum_total;
        }
    }

    $barang_terdata = Barang::count();
    $barang_tersedia = DB::table('barangs')
    ->where('jml_barang', '!=', '0')
    ->count();
    $barang_dipinjam = DB::table('pinjam_barangs')
    ->where('status', 2)
    ->sum('jml_barang');
    $persetujuan_dipinjam = DB::table('pinjam_barangs')
    ->where('status', 1)
    ->sum('jml_barang');

    $data = DB::table('pinjam_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
        ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

    return view('index', compact('greetings', 'barang_terdata', 'barang_tersedia', 'barang_dipinjam', 'cek_chart', 'get_tahun', 'charts', 'total_peminjam', 'persetujuan_dipinjam', 'data'));
}

    public function notfound() 
    { 
      return view('errors.404'); 
    }
}
