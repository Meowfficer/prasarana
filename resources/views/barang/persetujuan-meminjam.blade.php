@extends('layouts.layout')
@section('title', 'Persetujuan Peminjam Barang')
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
				<h4 class="card-title">Persetujuan Peminjam Barang</h4>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Jumlah Barang Yang Dipinjam</th>
								<th class="text-primary">Nama Peminjam</th>
								<th class="text-primary">Alasan Peminjam</th>
								<th class="text-primary">Status</th>
								<th class="text-primary">Waktu Dipinjam</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->kode_barang}}</td>
								<td>{{$data->nama_barang}}</td>
								<td>{{$data->jml_barang}}</td>
								<td>{{$data->nama_peminjam}}</td>
								<td>{{$data->deskripsi}}</td>
								<td><h3><span class="btn btn-warning">Menunggu Persetujuan</span></h3></td>
								<td>{{$data->created_at}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										{{-- <i class="fe fe-more-horizontal"></i> --}}
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#modal-pinjam-{{$data->id}}">Setujui Peminjam</a>
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#modal-tolak-{{$data->id}}">Tolak</a>
									</div>
								</td>
							</tr>
							<!--Modal Section-->
							<!--Modal Pinjam Barang -->
							<!-- Modal -->
							<div id="modal-pinjam-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-success">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Setujui Peminjam</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('setujui-pinjam/'.$data->id)}}" method="post">
												@csrf
												<p>Apakah Anda Ingin Meminjamkan {{$data->nama_barang}} Kepada {{$data->nama_peminjam}}?</p>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
												<button type="submit" class="btn btn-success text-white">Pinjamkan</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Pinjam Barang-->
							<div id="modal-tolak-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-danger">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Tolak Peminjam</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('tolak-peminjam/'.$data->id)}}" method="post">
												@csrf
												<p>Apakah Anda Yakin Ingin Menolak?</p>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
												<button type="submit" class="btn btn-danger text-white">Tolak</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Section-->
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