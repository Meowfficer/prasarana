@extends('layouts.layout')
@section('title', 'Edit Data Barang')
@section('container')
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-body">
				<form action="{{url('/barang-masuk/'.$data->id)}}" method="post">
					@method('put')
					@csrf
					<div class="form-group">
						<label for="">Nama Barang</label>
						<select name="kode" class="form-control" readonly>
							<option value="{{$data->kode_barang}}" selected>{{$data->nama_barang}}</option>
						</select>
					</div>
					{{-- <div class="form-group">
						<label for="">Jumlah Barang</label>
						<input type="number" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Barang..." name="jumlah" min="1" value="{{$data->jumlah_masuk}}">
					</div> --}}
					<div class="form-group">
						<label for="">Nama Supplier</label>
						<select name="supplier" class="form-control">
							<option value="{{$data->id_supplier}}" selected>{{$data->nama}}</option>
							@foreach ($data_supplier as $id => $ns)
							<option value="{{ $id }}">{{ $ns }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-info" onclick="this.disabled=true;this.form.submit();">Edit</button>
					<a href="{{url('/barang-masuk')}}" class="btn btn-secondary">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection