@extends('layouts.layout')
@section('title', 'Riwayat Peminjam')
@section('my-css')
<style>
        .fw-bolder {
            font-weight: 700;
        }
</style>    
@endsection
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Riwayat Peminjam</h4>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Seri Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Nama Peminjam</th>
								<th class="text-primary">Status</th>
								<th class="text-primary">Waktu Diperbarui</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->kode_barang}}</td>
								<td>{{$data->seri_barang}}</td>
								<td>{{$data->nama_barang}}</td>
								<td>{{$data->nama_peminjam}}</td>
								<td>
									@if($data->status == 1)
									<h3><span class="btn btn-secondary text-white">Menunggu Konfirmasi Peminjamaan</span></h3>
									@elseif($data->status == 2)
									<h3><span class="btn btn-warning text-white">Dipinjam</span></h3>
									@elseif($data->status == 3)
									<h3><span class="btn btn-secondary text-white">Menunggu Konfirmasi Pengembalian</span></h3>
									@elseif($data->status == 4)
									<h3><span class="btn btn-success text-white">Dikembalikan</span></h3>
									@elseif($data->status == 5)
									<h3><span class="btn btn-danger text-white">Ditolak</span></h3>
									@endif
								</td>
								<td>{{$data->updated_at}}</td>
								<td>
									@if($data->status != 5)
									<a href="{{url('/cetak-bukti/'.$data->id)}}" class="btn btn-success text-white">Cetak Bukti</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- order table -->
@endsection