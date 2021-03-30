@extends('layouts.layout')
@section('title', 'Tambah Data Barang Keluar')
@section('container')
<div class="row">
	<div class="col-lg-6 mx-auto">
		<div class="card shadow mb-4">
			<div class="card-body">
				<h4 class="card-title">Tambah Barang Keluar</h4>
				<form action="{{url('/barang-keluar')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="">Nama Barang</label>
						<select name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode_barang">
							<option value="" selected disabled>--- Pilih Nama Barang ---</option>
							@foreach ($data_kode as $kode_barang => $ns)
							<option value="{{ $kode_barang }}">{{ $ns }}</option>
							@endforeach
						</select>
						@error('kode')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					<div class="form-group">
						<label for="">Seri Barang</label>
						<select name="seri" class="form-control @error('seri') is-invalid @enderror" id="seri">
							<option value="" selected disabled>--- Pilih Seri Barang ---</option>
						</select>
						@error('seri')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					<div class="form-group">
						<label for="">Deskripsi</label>
						<input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">
						@error('deskripsi')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-info" onclick="this.disabled=true;this.form.submit();">Tambah</button>
					<a href="{{url('/barang-keluar')}}" class="btn btn-secondary">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#kode_barang').on('change',function(e) {
			var kode_barang = e.target.value;
			$.ajax({
				url:"{{ url('/seri') }}",
				type:"POST",
				data: {
					"_token": "{{ csrf_token() }}",
					kode_barang: kode_barang
				},
				success:function (data) {
					$('#seri').empty();
					$.each(data.seri,function(index,seri){
						$('#seri').append('<option value="'+seri.seri_barang+'">'+seri.seri_barang+'</option>');
					})
				}
			})
		});
	});
</script>
@endsection