@extends('layouts.layout')
@section('title', 'Data Akun')
@section('container')
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title text-wh">Data Akun</h4>
				<div class="card-tool mb-3">
					<a href="{{url('/add-account')}}" class="btn btn-success text-white">Tambah Akun</a>
				</div>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Nama</th>
								<th class="text-primary">Username</th>
								<th class="text-primary">Role</th>
								<th class="text-primary">Status Akun</th>
								<th class="text-primary">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $data)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$data->name}}</td>
								<td>{{$data->username}}</td>
								<td>
									@if($data->role == '1')
									<h3><span class="btn btn-primary">Admin</span></h3>
									@else
									<h3><span class="btn btn-secondary">User</span></h3>
									@endif
								</td>
								<td>
									@if($data->status_akun == 0)
									<h3><span class="btn btn-danger text-white">Non-Aktif</span></h3>
									@elseif($data->status_akun == 1)
									<h3><span class="btn btn-success text-white">Aktif</span></h3>
									@endif
								</td>
								<td>
									{{-- <a href="{{url('account/edit/'.$data->id)}}" class="btn btn-secondary"><i class="fe fe-edit"></i></a> --}}
									{{-- <a href="#" class="btn btn-danger" data-toggle="modal"
									data-target="#danger-header-modal-{{$data->id}}"><i class="fe fe-trash-2"></i></a> --}}

									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="{{url('account/edit/'.$data->id)}}">Edit</a>
										@if($data->status_akun == 1)
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#banned-header-modal-{{$data->id}}">Non-Aktifkan Akun</a>
										@elseif($data->status_akun == 0)
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#unbanned-header-modal-{{$data->id}}">Aktifkan Akun</a>
										@endif
										@if(\App\PinjamBarang::all()->where('id_peminjam',$data->id)->count() == 0)
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#danger-header-modal-{{$data->id}}">Hapus</a>
										@endif
									</div>
								</td>
							</tr>
							<!-- Danger Header Modal -->
							<div id="danger-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form action="{{url('account/'.$data->id)}}" method="post">
											@method('delete')
											@csrf
											<div class="modal-header modal-colored-header bg-danger">
												<h4 class="modal-title text-white" id="danger-header-modalLabel">Peringatan!</h4>
												<button type="button" class="close text-white" data-dismiss="modal"
												aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<h5 class="mt-0">Anda Yakin Ingin Menghapus Akun Ini?</h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light"
												data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger" onclick="this.disabled=true;this.form.submit();">Hapus</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<!-- Banned Header Modal -->
							<div id="banned-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="{{url('account/ban/'.$data->id)}}" method="post">
											@csrf
											<div class="modal-header modal-colored-header bg-danger">
												<h4 class="modal-title text-white" id="danger-header-modalLabel">Peringatan!</h4>
												<button type="button" class="close text-white" data-dismiss="modal"
												aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<h5 class="mt-0">Anda Yakin Ingin Menonaktifkan Akun Ini?</h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light"
												data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger" onclick="this.disabled=true;this.form.submit();">Proses</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<!-- UnBanned Header Modal -->
							<div id="unbanned-header-modal-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="danger-header-modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="{{url('account/unban/'.$data->id)}}" method="post">
											@csrf
											<div class="modal-header modal-colored-header bg-success">
												<h4 class="modal-title text-white" id="danger-header-modalLabel">Peringatan!</h4>
												<button type="button" class="close text-white" data-dismiss="modal"
												aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<h5 class="mt-0">Anda Yakin Ingin Mengaktifkan Kembali Akun Ini?</h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light"
												data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-success text-white" onclick="this.disabled=true;this.form.submit();">Aktifkan</button>
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