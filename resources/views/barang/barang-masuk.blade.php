@extends('layouts.layout')
@section('title', 'Barang Masuk')
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Data Barang Masuk</h4>
				<div class="card-tool mb-3 row mx-1">
					<a href="{{url('/add-barang-masuk')}}" class="btn btn-success col-2 text-white">Tambah Data Barang Masuk</a>
					<a href="{{url('/peminjam-barang/export_excel')}}" class="btn btn-success col-1 ml-auto text-white">Laporan</a>
				</div>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Jumlah Barang</th>
								<th class="text-primary">Tanggal Masuk</th>
								<th class="text-primary">Nama Supplier</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->kode_barang}}</td>
								<td>{{$data->nama_barang}}</td>
								<td>{{$data->jumlah_masuk}}</td>
								<td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
								<td>{{$data->nama}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="{{url('barang-masuk/edit/'.$data->id)}}">Edit</a>
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#danger-header-modal-{{$data->id}}">Hapus</a>
									</div>
								</td>
							</tr>
							<!-- Danger Header Modal -->
							<div id="danger-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="{{url('barang-masuk/'.$data->id)}}" method="post">
											@method('delete')
											@csrf
											<div class="modal-header modal-colored-header bg-danger">
												<h4 class="modal-title text-white" id="danger-header-modalLabel">Peringatan!</h4>
												<button type="button" class="close text-white" data-dismiss="modal"
												aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<h5 class="mt-0">Anda Yakin Ingin Menghapus Data Ini?</h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light"
												data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-danger">Hapus</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
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