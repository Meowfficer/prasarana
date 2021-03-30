@extends('layouts.layout')
@section('title', 'Data Barang Keluar')
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Data Barang Keluar</h4>
				<div class="card-tool mb-3">
					<a href="{{url('/tambah-barang-keluar')}}" class="btn btn-success text-white">Tambah Data</a>
				</div>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Seri Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Tanggal Keluar</th>
								<th class="text-primary">Deskripsi</th>
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
								<td>{{\Carbon\Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
								<td>{{$data->deskripsi}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										{{-- <i class="fe fe-more-horizontal"></i> --}}
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                                        	<form action="{{url('barang-keluar/'.$data->id)}}" method="post">
                                        		@method('delete')
                                        		@csrf
                                            <div class="modal-header modal-colored-header bg-warning">
                                                <h4 class="modal-title text-white" id="danger-header-modalLabel">Konfirmasi</h4>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="mt-0">Apakah Kau Yakin Ingin Menghapus Data?
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Hapus</button>
                                            </div>
                                        </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
								<!--End of Modal Hapus -->
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