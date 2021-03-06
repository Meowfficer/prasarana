@extends('layouts.layout')
@section('title', 'Ubah Akun')
@section('container')
<div class="row">
	<div class="col-lg-6 mx-auto">
		<div class="card shadow">
			<form action="{{url('/account/'.$data->id)}}" method="post">
				@method('put')
				@csrf
				<div class="card-body">
					<h4 class="card-title">Ubah Akun</h4>
					<div class="form-group row">
						<label class="col-md-2">Nama</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" value="{{$data->name}}">
										@error('nama')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2">Username</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username" value="{{$data->username}}">
										@error('username')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="form-group row">
						<label class="col-md-2">Password</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
										@error('password')<div class="invalid-feedback">Harap Masukkan Password</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div> --}}
				</div>
				<div class="card-footer">
					<a href="{{url('/account')}}" class="btn btn-secondary">Kembali</a>
					<button type="submit" class="btn btn-success text-white">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection