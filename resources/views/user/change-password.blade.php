@extends('layouts.layout')
@section('title', 'Ganti Password')
@section('container')
<div class="row">
	<div class="col-lg-8 mx-auto">
		<div class="card shadow">
			<form action="{{url('/change-password')}}" method="post">
				@csrf
				<div class="card-body">
					<h4 class="card-title">Ganti Password</h4>
					<div class="form-group row">
						<label class="col-md-2">Password Lama</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Masukkan Password Lama" value="{{old('old_password')}}">
										@error('old_password')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2">Password Baru</label>
						<div class="col-md-10">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Baru" value="{{old('password')}}">
										@error('password')<div class="invalid-feedback">{{$message}}</div>@enderror
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="{{url('/account')}}" class="btn btn-secondary">Kembali</a>
					<button type="submit" class="btn btn-success text-white">Ubah Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection