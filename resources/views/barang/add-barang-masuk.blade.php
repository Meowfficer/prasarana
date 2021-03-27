@extends('layouts.layout')
@section('title', 'Tambah Data Barang')
@section('container')
<div class="row">
	<div class="col-lg-6 mx-auto">
		<div class="card shadow mb-4">
			<div class="card-body">
				<h4 class="card-title">Tambah Barang Masuk</h4>
				<form action="{{url('/barang-masuk')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="">Nama Barang</label>
						<select name="kode" class="form-control @error('kode') is-invalid @enderror">
							<option value="" selected disabled>--- Pilih Nama Barang ---</option>
							@foreach ($data_kode as $kode_barang => $ns)
							<option value="{{ $kode_barang }}">{{ $ns }}</option>
							@endforeach
						</select>
						@error('kode')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					@if($data_kode->count() == null || $data_kode->count() == 0)
					<div class="form-group">
						<label for="">Tidak Ada Barang?</label>
						<a href="{{url('/barang')}}">Tambah Data Barang</a>
					</div>
					@endif
					<div class="form-group">
						<label for="">Jumlah Barang</label>
						<input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah" placeholder="Masukkan Jumlah Barang..." min="1" name="jumlah_barang">
						@error('jumlah_barang')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					<div class="form-group">
						<label for="">Nama Supplier</label>
						<select name="supplier" class="form-control @error('supplier') is-invalid @enderror">
							<option value="" selected disabled>--- Pilih Nama Supplier ---</option>
							@foreach ($data as $id => $ns)
							<option value="{{ $id }}">{{ $ns }}</option>
							@endforeach
						</select>
						@error('supplier')<div class="invalid-feedback">{{$message}}</div>@enderror
					</div>
					@if($data->count() == null || $data->count() == 0)
					<div class="form-group">
						<label for="">Tidak Ada Supplier?</label>
						<a href="{{url('/supplier')}}">Tambah Data Supplier</a>
					</div>
					@endif
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-info" onclick="this.disabled=true;this.form.submit();">Tambah</button>
					<a href="{{url('/barang-masuk')}}" class="btn btn-secondary">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection