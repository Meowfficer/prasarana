@extends('layouts.layout')
@section('title', 'Tambah Data Barang')
@section('container')
<div class="row">
	<div class="col-lg-6 mx-auto">
		<div class="card shadow mb-4">
			<div class="card-body">
				<h4 class="card-title">Tambah Barang</h4>
				<form action="{{url('/barang')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="">Nama Barang</label>
						<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Barang..." name="nama">
						@error('nama')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					<div class="form-group">
						<label for="">Jenis Barang</label>
						{{-- <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
							<option value="" selected disabled>-- Pilih Jenis Barang --</option>
							<option value="1">Elektronik</option>
							<option value="2">Non - Elektronik</option>
						</select> --}}
						<input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" placeholder="Masukkan Jenis Barang..." name="jenis">
						@error('jenis')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					<div class="form-group">
						<label for="">Kategori Barang</label>
						<input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" placeholder="Masukkan Kategori Barang..." name="kategori">
						@error('kategori')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-info" onclick="this.disabled=true;this.form.submit();">Tambah</button>
					<a href="{{url('/barang')}}" class="btn btn-secondary">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection