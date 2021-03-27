@extends('layouts.layout')
@section('title', 'Persetujuan Pengembalian Barang')
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
				<h4 class="card-title">Persetujuan Pengembalian Barang</h4>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Nama Peminjam</th>
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
								<td>{{$data->nama_peminjam}}</td>
								<td><h3><span class="btn btn-warning text-white">Menunggu Persetujuan</span></h3></td>
								<td>{{\Carbon\Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100" type="button" data-toggle="modal"
										data-target="#modal-pinjam-{{$data->id}}">
										Konfirmasi
									</button>
									
								</td>
							</tr>
							<!--Modal Section-->
							<!--Modal Pinjam Barang -->
							<!-- Modal -->
							<div id="modal-pinjam-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-success">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Setujui Pengembalian</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('persetujuan-pengembalian/'.$data->id)}}" method="post">
												@csrf
												<p>Apakah {{$data->nama_peminjam}} Sudah Mengembalikan {{$data->nama_barang}}?</p>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
												<button type="submit" class="btn btn-success text-white" onclick="this.disabled=true;this.form.submit();">Konfirmasi</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Pinjam Barang-->
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