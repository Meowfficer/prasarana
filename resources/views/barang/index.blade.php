@extends('layouts.layout')
@section('title', 'Data Barang')
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Data Barang</h4>
				<div class="card-tool mb-3">
					<a href="{{url('/tambah-barang')}}" class="btn btn-success col-lg-2 col-6 text-white">Tambah Data</a>
				</div>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Stok</th>
								<th class="text-primary">Jenis Barang</th>
								<th class="text-primary">Kategori Barang</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->kode_barang}}</td>
								<td>{{$data->nama_barang}}</td>
								<td>
									@if($data->jml_barang == null || $data->jml_barang == 0)
									Stok Habis
									@else
									{{$data->jml_barang}}
									@endif
								</td>
								<td>
									{{$data->jenis_barang}}
									{{-- @if($data->jenis_barang = 1)
									Elektronik
									@else
									Non - Elektronik
									@endif --}}
								</td>
								<td>{{$data->kategori_barang}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										{{-- <i class="fe fe-more-horizontal"></i> --}}
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										@if($data->jml_barang == null || $data->jml_barang == 0)
										<a class="dropdown-item" href="{{url('add-barang-masuk/')}}">Tambah Stok</a>
										@else
										<a class="dropdown-item" href="{{url('stok-barang/'.$data->kode_barang)}}">Lihat Stok</a>
										@endif
										<a class="dropdown-item" href="{{url('barang/edit/'.$data->id)}}">Edit</a>
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#danger-header-modal-{{$data->id}}">Hapus</a>
									</div>
								</td>
							</tr>
							<!--Modal Section-->
							<!-- Modal Hapus -->
							<!-- Danger Header Modal -->
							<div id="danger-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="{{url('barang/'.$data->id)}}" method="post">
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
												<button type="submit" onclick="this.disabled=true;this.form.submit();" class="btn btn-danger">Hapus</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Hapus -->
							<!-- End of Modal Section --> 
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