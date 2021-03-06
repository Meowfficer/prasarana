<?php

namespace App\Http\Controllers;

use App\BarangKeluar;
use App\Barang;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('barang_keluars')
        ->join('barangs', 'barangs.kode_barang', '=', 'barang_keluars.kode_barang')
        ->join('users', 'users.id', '=', 'barang_keluars.id_peminjam')
        ->select('barang_keluars.*', 'barangs.nama_barang', 'users.name AS nama_peminjam', 'users.role')
        ->get();
        return view('barang_keluar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kode = Barang::pluck("nama_barang", "kode_barang");
        return view('barang_keluar.create', compact('data_kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new BarangKeluar;

        if ($request->kode == NULL) {
            return redirect('tambah-barang-keluar')->with('danger', 'Harap Pilih Nama Barang');
        }

        $data_stock = Barang::where('kode_barang', '=', $request->kode)
        ->select('jml_barang')
        ->first();
        $max = $data_stock->jml_barang;
        // dd($max);

        if ($request->jumlah_barang > $max) {
            return redirect('tambah-barang-keluar')->with('danger', 'Batas Maksimal Barang Terlampaui, Batas Maksimal Adalah '.$max);
        }

        $request->validate([
            'kode' => "required",
            'jumlah_barang' => "required|min:1",
            'deskripsi' => "required",
        ],[
            'kode.required' => "Harap Pilih Nama Barang",
            'jumlah_barang.required' => 'Harap Masukkan Jumlah Barang',
            'jumlah_barang.min' => 'Harap Masukkan Jumlah Barang Minimal 1',
            'deskripsi.required' => 'Harap Pilih Deskripsi Barang Keluar'
        ]);


        $tanda_stok = $request->kode;

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $tanda_stok)
        ->first();
        
        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang - $request->jumlah_barang;

        $data->id_peminjam = Auth::id();
        $data->deskripsi = $request->deskripsi;
        $data->kode_barang = $request->kode;
        $data->jml_barang = $request->jumlah_barang;
        $data->save();
        DB::table('barangs')->where('kode_barang', $tanda_stok)->update(['jml_barang' => $stok_baru]);

        return redirect('barang-keluar')->with('success', 'Berhasil Tambah Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function show(barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function edit(barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_masuk_lama = DB::table('barang_keluars')
        ->where('id', $id)
        ->first();

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $data_masuk_lama->kode_barang)
        ->first();

        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang + $data_masuk_lama->jml_barang;
        DB::table('barangs')->where('kode_barang', $data_masuk_lama->kode_barang)->update(['jml_barang' => $stok_baru]);
        BarangKeluar::destroy($id);

        return redirect('barang-keluar')->with('success', 'Barang Berhasil Ditambahkan!');
    }
}
