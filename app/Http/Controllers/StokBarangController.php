<?php

namespace App\Http\Controllers;

use DB;
use App\stok_barang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode_barang)
    {
        // $data = stok_barang::all();
        $data = DB::table('stok_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'stok_barangs.kode_barang')
        ->select('stok_barangs.*', 'barangs.nama_barang')
        ->where('stok_barangs.kode_barang', $kode_barang)
        ->get();
        return view('stok_barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\stok_barang  $stok_barang
     * @return \Illuminate\Http\Response
     */
    public function show(stok_barang $stok_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\stok_barang  $stok_barang
     * @return \Illuminate\Http\Response
     */
    public function edit(stok_barang $stok_barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\stok_barang  $stok_barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stok_barang $stok_barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\stok_barang  $stok_barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(stok_barang $stok_barang)
    {
        //
    }
}
