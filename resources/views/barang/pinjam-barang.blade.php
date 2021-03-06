@extends('layouts.layout')
@section('title', 'Pinjam Barang')
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
				<h4 class="card-title">Barang Yang Tersedia</h4>
				<div class="table-responsive">
					<table id="dataTable" class="table datatables">
						<thead>
							<tr>
								<th class="text-primary">#</th>
								<th class="text-primary">Kode Barang</th>
								<th class="text-primary">Nama Barang</th>
								<th class="text-primary">Stok</th>
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
								<td>
									<button class="btn btn-outline-secondary btn-rounded" type="button" data-toggle="modal" data-target="#modal-pinjam-{{$data->id}}">
										{{-- <i class="fas fa-hand-holding fa-2x"></i> --}}Pinjam
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
										<div class="modal-header modal-colored-header bg-primary">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Pinjam Barang</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('pinjam-barang')}}" id="formPinjam-{{$data->id}}" name="formla" method="post">
												@csrf
												<div class="form-group inner">
													<label for="">Nama Barang</label>
													<input type="hidden" value="{{$data->kode_barang}}" name="kode">
													<input type="text" class="form-control" id="message" value="{{$data->nama_barang}}" readonly name="nama_barang">
												</div>
												<div class="form-group inner">
													<label for="">Jumlah Barang Yang Ingin Dipinjam (Max:{{$data->jml_barang}})</label>
													<input type="number" min="1" id="message2" max="{{$data->jml_barang}}" class="form-control" placeholder="Masukkan Jumlah Barang..." name="jumlah" required>
												</div>
												<div class="form-group inner">
													<label for="">Alasan Meminjam</label>
													<input type="text" class="form-control" id="message3" placeholder="Masukkan Alasan Meminjam..." name="deskripsi" required>
												</div>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-primary" data-target="#multiple-two-{{$data->id}}" data-toggle="modal" data-dismiss="modal">Next</button>
											</form>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->

							<!-- Modal -->
							<div id="multiple-two-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="multiple-twoModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-warning">
											<h4 class="modal-title text-white" id="multiple-twoModalLabel">Konfirmasi Peminjam</h4>
										</div>
										<div class="modal-body">
											<h5 class="mt-0">Harap Konfirmasi Bahwa Data Yang Anda Pinjam Sudah Benar</h5>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-target="#modal-pinjam-{{$data->id}}" data-toggle="modal" data-dismiss="modal">Periksa Kembali</button>
											<button type="submit" class="btn btn-warning" form="formPinjam-{{$data->id}}">Konfirmasi</button>
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
@section('my-js')
{{-- <script>
	$(document).ready(function() {
	var form = document.getElementByName('formla');
	for(i = 0; i < form; i++){
		$('.inner input').keyup(function() {

			var empty = false;
			$('.inner input').each(function() {
				if ($(this).val().length == 0) {
					empty = true;
				}
			});

			if (empty) {
				$('.outer button').attr('disabled', 'disabled');
			} else {
				$('.outer button').attr('disabled', false);
			}
		});
	}
	});
	function showMessage(){
		var message = document.getElementById("message").value;
		var message2 = document.getElementById("message2").value;
		var message3 = document.getElementById("message3").value;

		// var display_message3 = document.getElementById("display_message3");
		// var display_message2 = document.getElementById("display_message2");
		// var display_message = document.getElementById("display_message");
		display_message3.innerHTML= message3;
		display_message2.innerHTML= message2;
		display_message.innerHTML= message;
	}
</script> --}}
{{-- <script>
	$('#modal-pinjam-{{$data->id}}').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})
</script> --}}
@endsection