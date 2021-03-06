<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use DB;

class PdfController extends Controller
{
	public function pdf_riwayat(Request $request)
	{
    	// $pdf = PDF::loadview('pdf.invoice_penjualan', [
     //    'data' => $data,
     //    'detail' => $detail,
     //    'nama_pajak' => $nama_pajak,
     //    'persen_pajak' => $persen_pajak,
     //  ]);

		$ambil = $request->datetimes;
		$dari = substr($ambil, 0, 9);
		$sampai = substr($ambil, 12, 21);

		$data = DB::table('pinjam_barangs')
		->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
		->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
		->select('pinjam_barangs.*', 'barangs.nama_barang', 'users.name AS nama_peminjam')
		->where('status', '=', 4)
		// ->where('pinjam_barangs.created_at', '>=', $dari)
		// ->where('pinjam_barangs.created_at', '<=', $sampai)
		->whereBetween('pinjam_barangs.created_at', [$dari, $sampai])
		->orderBy('id', 'desc')
		->get();

		$dariIND = Carbon::parse($dari)->locale('id_ID')->isoFormat('D MMMM Y');
		$sampaiIND = Carbon::parse($sampai)->locale('id_ID')->isoFormat('D MMMM Y');

		$today = Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y');
		// $pdf = PDF::loadview('pdf.riwayat-peminjam', $data);
		$pdf = PDF::loadview('pdf.riwayat-peminjam', [
			'data' => $data,
			'today' => $today,
			'dariIND' => $dariIND,
			'sampaiIND' => $sampaiIND
		]);
		return $pdf->stream('riwayat-peminjam');
	}
}
