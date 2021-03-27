@extends('layouts.layout')
@section('title', 'Peminjam Barang')
@section('my-css')
<style>
	.fw-bolder {
		font-weight: 700;
	}

	.form-popup {
		display: none
	}

	.form-popup.active {
		display: block
	}
</style>    
@endsection
@section('container')
<!-- basic table -->
<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Kembalikan Barang</h4>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Seri Barang</th>
								<th class="text-primary">Nama Barang</th>
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
								<td>{{$data->seri_barang}}</td>
								<td>{{$data->nama_barang}}</td>
								<td>{{$data->nama_peminjam}}</td>
								<td>{{$data->deskripsi}}</td>
								<td><h3><span class="btn btn-warning text-white">Dipinjam</span></h3></td>
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
											<form action="{{url('kembalikan-barang/'.$data->id)}}" method="post">
												@csrf
												<h5>Apa Anda Ingin Mengembalikan Barang?</h5>
												{{-- <div class="form-group">
													<input type="checkbox" id="checkbox-{{$data->id}}">
												</div> --}}
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch{{$data->id}}">
													<label class="custom-control-label text-dark" for="customSwitch{{$data->id}}">Ada Barang Yang Rusak?</label>
												</div>
												<div id="delivery-{{$data->id}}" style="display:none;">
													<div class="form-group mt-3">
														<input type="number" min="1" max="{{$data->jml_barang}}" class="form-control" name="rusak" placeholder="Masukkan Jumlah Barang Yang Rusak...">
														<label class="form-text text-dark">Maks : {{$data->jml_barang}}</label>
													</div>
												</div>
											</div>
											<div class="modal-footer outer">
												<button type="submit" class="btn btn-danger" onclick="this.disabled=true;this.form.submit();">Kembalikan</button>
											</form>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Pinjam Barang-->
							<!--End of Modal Section-->
							<script>
								document.getElementById('customSwitch{{$data->id}}').onclick = function() {
									console.log(this);
									if(this.checked) {
										document.getElementById('delivery-{{$data->id}}').style['display'] = 'block';
									} else {
										document.getElementById('delivery-{{$data->id}}').style['display'] = 'none';
									}
								};
							</script>
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
@section('my-js')


@endsection