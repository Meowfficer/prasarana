<?php

namespace App\Http\Controllers;

use App\PinjamBarang;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use DB;

class PdfController extends Controller
{
	public function pdf_riwayat(Request $request)
	{
		$request->validate([
			'datetimes' => 'required',
			'jenis' => 'required'
		]);

		$ambil = $request->datetimes;
		$dari = substr($ambil, 0, 9);
		$sampai = substr($ambil, 12, 21);

		$jenis = $request->jenis;

		if ($jenis == 1) {
			$data = DB::table('barang_masuks')
			->join('suppliers', 'suppliers.id' ,'=', 'barang_masuks.id_supplier')
			->join('barangs', 'barangs.kode_barang', '=', 'barang_masuks.kode_barang')
			->join('stok_barangs', 'barang_masuks.seri_barang', '=', 'stok_barangs.seri_barang')
			->select('barang_masuks.*', 'suppliers.nama', 'barangs.nama_barang', 'stok_barangs.status')
			->whereBetween('pinjam_barangs.created_at', [$dari, $sampai])
			->orderBy('id', 'desc')
			->get();
			$dariIND = Carbon::parse($dari)->locale('id_ID')->isoFormat('D MMMM Y');
			$sampaiIND = Carbon::parse($sampai)->locale('id_ID')->isoFormat('D MMMM Y');

			$today = Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y');
			$pdf = PDF::loadview('pdf.barang-masuk', [
				'data' => $data,
				'today' => $today,
				'dariIND' => $dariIND,
				'sampaiIND' => $sampaiIND
			]);
			return $pdf->stream('barang-masuk');
		}elseif($jenis == 2){
			$data = DB::table('pinjam_barangs')
			->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
			->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
			->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
			->where('status', '=', 4)
			->whereBetween('pinjam_barangs.created_at', [$dari, $sampai])
			->orderBy('id', 'desc')
			->get();
			
			$dariIND = Carbon::parse($dari)->locale('id_ID')->isoFormat('D MMMM Y');
			$sampaiIND = Carbon::parse($sampai)->locale('id_ID')->isoFormat('D MMMM Y');

			$today = Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y');
			$pdf = PDF::loadview('pdf.riwayat-peminjam', [
				'data' => $data,
				'today' => $today,
				'dariIND' => $dariIND,
				'sampaiIND' => $sampaiIND
			]);
			return $pdf->stream('riwayat-peminjam');
		}

	}

	public function cetak_bukti($id)
	{
		$data = PinjamBarang::find($id);
		$ambil = $data->kode_barang;
		$asd = Barang::where('kode_barang', '=', $ambil)->get();
		$pdf = PDF::loadview('pdf.bukti', [
			'data' => $data,
			'barang' => $asd
		]);
		return $pdf->stream('bukti');
	}

}