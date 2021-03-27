@extends('layouts.layout')
@section('title', 'Supplier')
@section('container')
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Data Supplier</h4>
				<div class="card-tool mb-3">
					<a href="{{url('/add-supplier')}}" class="btn btn-success text-white">Tambah Data Supplier</a>
				</div>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Nama</th>
								<th class="text-primary">Alamat</th>
								<th class="text-primary">No Telp</th>
								<th class="text-primary">Kota</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->nama}}</td>
								<td>{{$data->alamat}}</td>
								<td>{{$data->no_telp}}</td>
								<td>{{$data->kota}}</td>
								<td>
									<a href="{{url('supplier/edit/'.$data->id)}}" class="btn btn-secondary"><i class="fe fe-edit"></i></a>
									@if(\App\BarangMasuk::all()->where('id_supplier',$data->id)->count() == 0)
									<a href="#" class="btn btn-danger" data-toggle="modal"
									data-target="#danger-header-modal-{{$data->id}}"><i class="fe fe-trash-2"></i></a>
									@endif
								</td>
							</tr>
							<!-- Danger Header Modal -->
							<div id="danger-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="{{url('supplier/'.$data->id)}}" method="post">
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
												<button type="submit" class="btn btn-danger" onclick="this.disabled=true;this.form.submit();">Hapus</button>
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