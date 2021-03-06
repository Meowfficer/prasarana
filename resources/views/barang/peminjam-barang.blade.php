@extends('layouts.layout')
@section('title', 'Peminjam Barang')
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
				<h4 class="card-title">Peminjam Barang</h4>
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
								<td><h3><span class="btn btn-warning">Dipinjam</span></h3></td>
								<td>{{$data->created_at}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded" type="button" data-toggle="modal" data-target="#modal-pinjam-{{$data->id}}">
                                        {{-- <i class="fas fa-hand-holding fa-2x"></i> --}}Kembalikan
									</button>
								</td>
							</tr>
							<!--Modal Section-->
								<!--Modal Pinjam Barang -->
								 <!-- Modal -->
								 <div id="modal-pinjam-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								 aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								 <div class="modal-dialog modal-dialog-centered">
									 <div class="modal-content">
										 <div class="modal-header modal-colored-header bg-danger">
											 <h4 class="modal-title text-white" id="multiple-oneModalLabel">Pengembalian Barang</h4>
											 <button type="button" class="close text-white" data-dismiss="modal"
												 aria-hidden="true">×</button>
										 </div>
										 <div class="modal-body">
                                            <form action="{{url('peminjam-barang/'.$data->id)}}" method="post">
                                                @csrf
                                                <p>Apa Barang Sudah Dikembalikan?, Anda Ingin Mengkomfirmasi Pengembalian Barang?</p>
										 </div>
										 <div class="modal-footer outer">
											 <button type="submit" class="btn btn-danger">Kembalikan</button>
                                         </form>
										 </div>
									 </div><!-- /.modal-content -->
								 </div><!-- /.modal-dialog -->
							 </div><!-- /.modal -->
							 <!--End of Modal Pinjam Barang-->
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