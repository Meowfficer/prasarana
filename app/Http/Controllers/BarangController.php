<?php

namespace App\Http\Controllers;
use DB;
use App\Barang;
use App\BarangMasuk;
use App\stok_barang;
use App\BarangKeluar;
use App\PinjamBarang;
use App\Supplier;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Exports\BarangMasukExport;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();
        return view('barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Barang;
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'jenis' => 'required'
        ],[
            'nama.required' => 'Nama Barang Tidak Boleh Kosong!',
            'kategori.required' => 'Kategori Barang Tidak Boleh Kosong!',
            'jenis.required' => 'Jenis Barang Tidak Boleh Kosong!'
        ]);

        //Pembuatan Kode Barang
        $rand = mt_rand(0, 100);
        $a = strtoupper($request->kategori);
        $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
        $cap = str_replace($vowels, "", $a);
        $kode_barang_all = substr($cap, 0, 3) . $rand;

        //Pembuatan Kode Barang
        // $rand = mt_rand(0, 100);
        // $cap = strtoupper($request->nama);
        // $kode_barang_all = substr($cap, 0, 2) . $rand;

        $data->nama_barang = $request->nama;
        $data->jenis_barang = $request->jenis;
        $data->kategori_barang = $request->kategori;
        $data->jml_barang = 0;
        $data->kode_barang = $kode_barang_all;
        $data->save();

        return redirect('barang')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Barang::find($id);
        return view('barang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Barang::find($id);

        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'jenis' => 'required'
        ],[
            'nama.required' => 'Nama Barang Tidak Boleh Kosong!',
            'kategori.required' => 'Kategori Barang Tidak Boleh Kosong!',
            'jenis.required' => 'Jenis Barang Tidak Boleh Kosong!'
        ]);
        
        if ($request->nama == $data->nama_barang && $request->jenis == $data->jenis_barang && $request->kategori == $data->nama_kategori) {
            return redirect()->back()->with('warning', 'Tidak Ada Perubahan Data Yang Terjadi!');
        } else {
            //Pembuatan Kode Barang
           $rand = mt_rand(0, 100);
           $a = strtoupper($request->kategori);
           $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
           $cap = str_replace($vowels, "", $a);
           $kode_barang_all = substr($cap, 0, 3) . $rand;

           $data->nama_barang = $request->nama;
           $data->jenis_barang = $request->jenis;
           $data->kategori_barang = $request->kategori;
           $data->kode_barang = $kode_barang_all;

           $data->save();
           return redirect('barang')->with('info', 'Data Berhasil Diubah!');
       }


   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Barang::find($id);
        Barang::destroy($id);

        return redirect()->back()->with('danger', 'Data Telah Terhapus!');
    }

//Bagian Barang Masuk

    public function indexMasuk()
    {
        $data = DB::table('barang_masuks')
        ->join('suppliers', 'suppliers.id' ,'=', 'barang_masuks.id_supplier')
        ->join('barangs', 'barangs.kode_barang', '=', 'barang_masuks.kode_barang')
        ->select('barang_masuks.*', 'suppliers.nama', 'barangs.nama_barang')
        ->orderBy('id', 'desc')
        ->get();
        // $data = BarangMasuk::all();
        return view('barang.barang-masuk', compact('data'));
    }

    public function createMasuk()
    {
        $data = Supplier::pluck("nama", "id");
        $data_kode = Barang::pluck("nama_barang", "kode_barang");
        return view('barang.add-barang-masuk', compact('data', 'data_kode'));
    }

    public function storeMasuk(Request $request)
    {
        // $data_masuk = new BarangMasuk;
        $request->validate([
            'kode' => 'required',
            'jumlah_barang' => 'required|min:1',
            'supplier' => 'required'
        ],[
            'kode.required' => 'Pilihlah Nama Barang!',
            'jumlah_barang.required' => 'Jumlah Barang Tidak Boleh Kosong!',
            'jumlah_barang.min' => 'Jumlah Barang Tidak Boleh Kurang Dari 1!',
            'supplier.required' => 'Pilihlah Nama Supplier!'
        ]);
        $tanda_stok = $request->kode;
        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $tanda_stok)
        ->first();


        for ($i=1; $i <= $request->jumlah_barang ; $i++) { 
            $rand = mt_rand(0, 100);
            //Input Data Barang Masuk
            $data_masuk = new BarangMasuk;

            $data_masuk->kode_barang = $request->kode;
            $data_masuk->seri_barang = $request->kode . '-' . $rand;
            $data_masuk->jumlah_masuk = 1;
            $data_masuk->id_supplier = $request->supplier;
            $data_masuk->save();

            //Input Data Stok Barang
            $stok_barang = new stok_barang;

            $stok_barang->kode_barang = $request->kode;
            $stok_barang->seri_barang = $request->kode . '-' . $rand;
            $stok_barang->status = 1;
            $stok_barang->save();
        }

        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang + $request->jumlah_barang;
        DB::table('barangs')->where('kode_barang', $tanda_stok)->update(['jml_barang' => $stok_baru]);

        return redirect('barang-masuk')->with('success', 'Data Berhasil Ditambahkan!') ;

    }

    public function editMasuk($id)
    {
        // $data = BarangMasuk::find($id);
        $data = DB::table('barang_masuks')
        ->join('suppliers', 'barang_masuks.id_supplier', '=', 'suppliers.id')
        ->join('barangs', 'barangs.kode_barang', '=', 'barang_masuks.kode_barang')
        ->select('barangs.kode_barang', 'barangs.nama_barang', 'suppliers.nama', 'barang_masuks.*')
        ->where('barang_masuks.id', $id)
        ->first();
        // $data_supplier = Supplier::pluck("nama", "id");
        $data_supplier = Supplier::where('id', '!=', $data->id_supplier)->pluck("nama", "id");
        return view('barang.edit-barang-masuk', compact('data', 'data_supplier'));
    }

    public function updateMasuk(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'supplier' => 'required'
        ],[
            'kode.required' => 'Pilihlah Nama Barang!',
            'supplier.required' => 'Pilihlah Nama Supplier!'
        ]);

        $data_masuk = BarangMasuk::find($id);
        // $data_masuk_lama = DB::table('barang_masuks')
        // ->where('id', $id)
        // ->first();
        // $tanda_stok = $request->kode;

        //Pengambilan Jumlah Stok Lama
        // $stok = DB::table('barangs')
        // ->where('kode_barang', $tanda_stok)
        // ->first();

        $data_masuk->kode_barang = $request->kode;
        // $data_masuk->jumlah_masuk = $request->jumlah;
        $data_masuk->id_supplier = $request->supplier;
        $data_masuk->save();

        //Proses Simpan Stok Barang
        // $proses_stok = $stok->jml_barang - $data_masuk_lama->jumlah_masuk; 
        // $stok_baru = $proses_stok + $request->jumlah;
        // DB::table('barangs')->where('kode_barang', $tanda_stok)->update(['jml_barang' => $stok_baru]);

        return redirect('barang-masuk')->with('info', 'Data Berhasil Diubah!');
    }

    public function destroyMasuk($id)
    {
        $data_masuk_lama = DB::table('barang_masuks')
        ->where('id', $id)
        ->first();

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $data_masuk_lama->kode_barang)
        ->first();

        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang - $data_masuk_lama->jumlah_masuk;
        if ($stok_baru < 0) {
            DB::table('barangs')->where('kode_barang', $data_masuk_lama->kode_barang)->update(['jml_barang' => 0]);
        } else {
            DB::table('barangs')->where('kode_barang', $data_masuk_lama->kode_barang)->update(['jml_barang' => $stok_baru]);
        }

        //Hapus Stok Barang
        $stok_barang = stok_barang::where('seri_barang', $data_masuk_lama->seri_barang)->delete();

        BarangMasuk::destroy($id);

        return redirect('barang-masuk')->with('danger', 'Data Telah Terhapus!');
    }


    // public function export_excel()
    // {
    //     return Excel::download(new BarangMasukExport, 'Laporan Peminjam Barang.xlsx');
    // }

    //Pinjam Meminjam

    public function indexPinjam()
    {
        $data = Barang::where('jml_barang', '!=', 0)->get();
        return view('barang.pinjam-barang', compact('data'));
    }

    public function storePinjam(Request $request)
    {
        $data = new PinjamBarang;

        if ($request->kode == NULL) {
            return redirect()->back()->with('danger', 'Kode Barang Tidak Boleh Kosong');
        }

        $cek = DB::table('stok_barangs')->where('seri_barang', $request->seri)->first();

        if ($cek->status == 2) {
            return redirect()->back()->with('danger', 'Barang Sudah Dipinjam Oleh Orang Lain, Harap Refresh Halaman!');
        }

        $data_stock = Barang::where('kode_barang', '=', $request->kode)
        ->select('jml_barang')
        ->first();
        // $max = $data_stock->jml_barang;
        // dd($max);

        // if ($request->jumlah > $max) {
        //     return redirect('pinjam-barang')->with('danger', 'Batas Maksimal Barang Dipinjam Terlampaui');
        // }

        // $request->validate([
        //     'jumlah' => "required",
        // ]);


        $tanda_stok = $request->kode;

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $tanda_stok)
        ->first();
        
        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang - 1;
        DB::table('barangs')->where('kode_barang', $tanda_stok)->update(['jml_barang' => $stok_baru]);

        DB::table('stok_barangs')->where('seri_barang', $request->seri)->update(['status' => 2]);

        $data->id_peminjam = Auth::user()->id;
        $data->deskripsi = $request->deskripsi;
        $data->kode_barang = $request->kode;
        $data->seri_barang = $request->seri;
        $data->jml_barang = 1;
        $data->status = 1;

        $data->save();

        return redirect()->back()->with('success', 'Berhasil Pinjam Barang!');
    }

    public function indexPeminjam()
    {
        $data = DB::table('pinjam_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
        ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        ->where('status', 2)
        ->orderBy('id', 'desc')
        ->get();
        // $data = PinjamBarang::where('status', '=', 1)->get();
        return view('barang.peminjam-barang', compact('data'));
    }

    public function indexKembalikan()
    {
        $data = DB::table('pinjam_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
        ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        ->where('status', 2)
        ->where('id_peminjam', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();
        // $data = PinjamBarang::where('status', '=', 1)->get();
        return view('barang.kembalikan-barang', compact('data'));
    }

    public function SetujuiPeminjam(Request $request, $id)
    {
        DB::table('pinjam_barangs')->where('id', $id)->update(['status' => 2]);

        // return redirect('persetujuan-peminjam')->with('success', 'Peminjam Berhasil Disetujui!');
        return redirect('persetujuan-peminjam')->with('success', 'Peminjam Berhasil Disetujui!');
    }

    public function KembalikanBarang(Request $request, $id)
    {

        if ($request->rusak == null || $request->rusak == 0) {
            DB::table('pinjam_barangs')->where('id', $id)->update(['status' => 3]);
        }else{
            $data_pinjam = PinjamBarang::find($id);


            if ($request->jml_barang > $data_pinjam->jml_barang) {
                return redirect('kembalikan-barang')->with('danger', 'Batas Maksimal Barang Terlampaui');
            }

            $rusak = $request->rusak;
            

            $stok_baru = $data_pinjam->jml_barang - $rusak;

            $data = new BarangKeluar;

            $data->kode_barang = $data_pinjam->kode_barang;
            $data->id_peminjam = Auth::id();
            $data->jml_barang = $request->rusak;
            $data->deskripsi = 'Rusak';
            $data->save();
            DB::table('pinjam_barangs')->where('id', $id)->update(['status' => 3, 'jml_barang' => $stok_baru]);
        }


        return redirect()->back()->with('success', 'Menunggu Persetujuan Pengembalian!');
    }

    public function TolakPeminjam(Request $request, $id)
    {
        $data_masuk_lama = DB::table('pinjam_barangs')
        ->where('id', $id)
        ->first();

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $data_masuk_lama->kode_barang)
        ->first();

        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang + $data_masuk_lama->jml_barang; 
        DB::table('barangs')->where('kode_barang', $data_masuk_lama->kode_barang)->update(['jml_barang' => $stok_baru]);
        DB::table('pinjam_barangs')->where('id', $id)->update(['status' => 5]);
        DB::table('stok_barangs')->where('seri_barang', $data_masuk_lama->seri_barang)->update(['status' => 1]);

        return redirect()->back()->with('warning', 'Peminjam Ditolak!');
    }

    public function BarangKembali(Request $request, $id)
    {
        $data_lama = DB::table('pinjam_barangs')
        ->where('id', $id)
        ->first();

        //Pengambilan Jumlah Stok Lama
        $stok = DB::table('barangs')
        ->where('kode_barang', $data_lama->kode_barang)
        ->first();

        //Proses Simpan Stok Barang
        $stok_baru = $stok->jml_barang + $data_lama->jml_barang; 
        DB::table('barangs')->where('kode_barang', $data_lama->kode_barang)->update(['jml_barang' => $stok_baru]);
        
        DB::table('pinjam_barangs')->where('id', $id)->update(['status' => 4]);
        DB::table('stok_barangs')->where('seri_barang', $data_lama->seri_barang)->update(['status' => 1]);

        return redirect('persetujuan-pengembalian')->with('success', 'Barang Berhasil Dikembalikan!');
    }

    public function RiwayatPeminjam()
    {
        if (Auth::user()->role == 1) {
            $data = DB::table('pinjam_barangs')
            ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
            ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
            ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        // ->where('status', '<', 4)
            ->orderBy('id', 'desc')
            ->get();
        }else{
            $data = DB::table('pinjam_barangs')
            ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
            ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
            ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        // ->where('status', '<', 4)
            ->where('id_peminjam', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        }

        return view('barang.riwayat-peminjam', compact('data'));
    }

    public function indexPersetujuanPengembalian()
    {
        $data = DB::table('pinjam_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
        ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        ->where('status', 3)
        ->orderBy('id', 'desc')
        ->get();
        // $data = PinjamBarang::where('status', '=', 1)->get();
        return view('barang.persetujuan-kembali', compact('data'));
    }

    public function indexPersetujuanPeminjam()
    {
        $data = DB::table('pinjam_barangs')
        ->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
        ->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();
        // $data = PinjamBarang::where('status', '=', 1)->get();
        return view('barang.persetujuan-meminjam', compact('data'));
    }

}
