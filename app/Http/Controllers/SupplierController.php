<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\BarangMasuk;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $cek = BarangMasuk::all();
    	$data = Supplier::all();
    	return view('user.supplier', compact('data', 'cek'));
    }

    public function create()
    {
    	return view('user.add-supplier');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'nama' => 'required',
    		'alamat' => 'required',
    		'no_telp' => 'required',
    		'kota' => 'required'
    	],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!',
            'no_telp.required' => 'No Telepon Tidak Boleh Kosong!',
            'kota.required' => 'Kota Tidak Boleh Kosong!',
        ]
    );

    	$data = new Supplier;

    	$data->nama = $request->nama;
    	$data->alamat = $request->alamat;
    	$data->no_telp = $request->no_telp;
    	$data->kota = $request->kota;

    	$data->save();

    	return redirect('supplier')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
    	$data = Supplier::find($id);
    	return view('user.edit-supplier', compact('data'));
    }

    public function update(Request $request, $id)
    {
    	$request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'kota' => 'required'
        ],[
            'nama.required' => 'Nama Tidak Boleh Kosong!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!',
            'no_telp.required' => 'No Telepon Tidak Boleh Kosong!',
            'kota.required' => 'Kota Tidak Boleh Kosong!',
        ]
    );

    	$data = Supplier::find($id);

    	$data->nama = $request->nama;
    	$data->alamat = $request->alamat;
    	$data->no_telp = $request->no_telp;
    	$data->kota = $request->kota;

    	$data->save();

    	return redirect('supplier')->with('info', 'Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
    	Supplier::destroy($id);
    	return redirect('supplier')->with('danger', 'Data Telah Terhapus!');
    }
}
