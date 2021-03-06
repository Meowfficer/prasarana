<?php

namespace App\Exports;

use App\BarangMasuk;
use App\PinjamBarang;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class BarangMasukExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return BarangMasuk::all();
    	return DB::table('pinjam_barangs')
    	->join('barangs', 'barangs.kode_barang', '=', 'pinjam_barangs.kode_barang')
        ->join('users', 'users.id', '=', 'pinjam_barangs.id_peminjam')
    	->select('users.name', 'barangs.kode_barang', 'barangs.nama_barang', 'pinjam_barangs.jml_barang', 'pinjam_barangs.created_at', 'pinjam_barangs.updated_at')
    	->where('pinjam_barangs.status', 2)
    	->get();
    }

    public function headings(): array
    {
    	return [
    		'Nama Peminjam',
    		'Kode Barang',
    		'Nama Barang',
    		'Jumlah Barang',
    		'Waktu Dipinjam', 
    		'Waktu Dikembalikan'
    	];
    }

    public function registerEvents(): array
    {
    	return [
    		AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
