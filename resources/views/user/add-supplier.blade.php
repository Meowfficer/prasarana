@extends('layouts.layout')
@section('title', 'Tambah Supplier')
@section('container')
<div class="row">
	<div class="col-lg-6 mx-auto">
		<div class="card shadow">
			<form action="{{url('/supplier')}}" method="post">
				@csrf
				<div class="card-body">
					<h4 class="card-title">Tambah Supplier</h4>
					<div class="form-group row">
						<label class="col-md-2">Nama</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
										@error('nama')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2">Alamat</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<textarea name="alamat" id="" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat"></textarea>
										@error('alamat')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2">No Telepon</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Masukkan No Telepon">
										@error('no_telp')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2">Asal Kota</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror" placeholder="Masukkan Asal Kota">
										@error('kota')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="{{url('/supplier')}}" class="btn btn-secondary">Kembali</a>
					<button type="submit" class="btn btn-success text-white" onclick="this.disabled=true;this.form.submit();">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection