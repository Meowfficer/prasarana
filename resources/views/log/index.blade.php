@extends('layouts.layout')
@section('title', 'Log Aktivitas')
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Log Aktivitas</h4>
					<div class="table-responsive">
						<table id="zero_config" class="table table-striped table-bordered no-wrap">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Jumlah Barang</th>
									<th>Keterangan</th>
									<th>Waktu</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $data)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$data->kode_barang_log}}</td>
									<td>{{$data->nama_barang}}</td>
									<td>{{$data->jumlah_log}}</td>
									<td>{{$data->keterangan_log}}</td>
									<td>{{$data->created_at}}</td>
									<td></td>
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