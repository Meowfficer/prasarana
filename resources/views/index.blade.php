@extends('layouts.layout')
@section('title', 'Dashboard')
@section('container')
<div class="row justify-content-center">
	<div class="col-12">
		<div class="row align-items-center mb-4">
			<div class="col-6">
				<h3 class="page-title m-0">{{$greetings}} {{Auth::user()->name}}!</h3>
			</div>
			@if(Auth::user()->role == 1)
			<div class="col-6 text-right">
				<button class="btn btn-success text-white" data-toggle="modal" data-target="#modal-print"><i class="fas fa-file-pdf"></i> Generate Laporan</button>
			</div>
			@endif
		</div>
		<div class="mb-2 align-items-center">
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="row mt-1 align-items-center">
						<div class="col-12 col-lg-4 text-left pl-4">
							@if(Auth::user()->role == 1)
							<h3>Data Barang Dipinjam Berdasarkan Seluruh User</h3>
							@else
							<h3>Dara Barang Dipinjam Bedasarkan {{Auth::user()->name}}</h3>
							@endif
						</div>
						@if(Auth::user()->role == 1)
						<div class="col-6 col-lg-2 text-center py-4">
							<p class="mb-1 small text-muted">Barang Yang Terdata</p>
							<span class="h3">{{$barang_terdata}}</span>
						</div>
						<div class="col-6 col-lg-2 text-center py-4 mb-2">
							<p class="mb-1 small text-muted">Barang Yang Tersedia</p>
							<span class="h3">{{$barang_tersedia}}</span>
						</div>
						<div class="col-6 col-lg-2 text-center py-4">
							<p class="mb-1 small text-muted">Barang Yang Dipinjam</p>
							<span class="h3">{{$barang_dipinjam}}</span>
						</div>
						<div class="col-6 col-lg-2 text-center py-4">
							<p class="mb-1 small text-muted">Menunggu Persetujuan Meminjam</p>
							<span class="h3" id="count4">0</span>
						</div>
						@endif
					</div>
					<div class="map-box">
						<form action="" class="col-6 col-md-3 col-lg-3 ml-auto mb-3">
							<select name="tahun-charts" onchange="this.form.submit()" class="form-control">
								@php
								$tahun_array = [];
								@endphp
								@if(count($get_tahun) > 0)
								@foreach($get_tahun as $ts)
								@php
								$pisah = explode('-',$ts->created_at);
								$tahun_get = $pisah[0];
								@endphp
								@if(!in_array($tahun_get,$tahun_array))
								<option value="{{date('Y', strtotime($ts->created_at))}}" 
									<?php if ($charts == date('Y', strtotime($ts->created_at))) {
										echo "selected";
									}else {
										echo "";
									}
									?> >
									{{date("Y", strtotime($ts->created_at))}}
								</option>
								@endif
								@php
								$tahun_array[] = $tahun_get;
								@endphp
								@endforeach
								@endif

								@if (count($cek_chart) == 0)
								<option value="{{ date('Y') }}"
								@if ($charts == date('Y') || $charts == '')
								selected
								@endif>
								{{ date('Y') }}
							</option>
							@endif
						</select>
					</form>
					{{-- <div id="areaChart"></div> --}}
					<canvas id="chart--line" class="mx-auto"></canvas>
				</div>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
		@if(Auth::user()->role == 1)
		<div class="card shadow">
			<div class="card-body">
				<h4 class="card-title">Persetujuan Peminjam Barang</h4>
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
								<td><h3><span class="btn btn-warning">Menunggu Persetujuan</span></h3></td>
								<td>{{$data->created_at}}</td>
								<td>
									<button class="btn btn-outline-secondary btn-rounded w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="Dropright" aria-expanded="true">
										{{-- <i class="fe fe-more-horizontal"></i> --}}
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#modal-pinjam-{{$data->id}}">Setujui Peminjam</a>
										<a class="dropdown-item" href="#" data-toggle="modal"
										data-target="#modal-tolak-{{$data->id}}">Tolak</a>
									</div>
								</td>
							</tr>
							<!--Modal Section-->
							<!--Modal Pinjam Barang -->
							<!-- Modal -->
							<div id="modal-pinjam-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-success">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Setujui Peminjam</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('setujui-pinjam/'.$data->id)}}" method="post">
												@csrf
												<p>Apakah Anda Ingin Meminjamkan {{$data->nama_barang}} Kepada {{$data->nama_peminjam}}?</p>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
												<button type="submit" class="btn btn-success text-white">Pinjamkan</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Pinjam Barang-->
							<div id="modal-tolak-{{$data->id}}" class="modal fade" tabindex="-1" role="dialog"aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header modal-colored-header bg-danger">
											<h4 class="modal-title text-white" id="multiple-oneModalLabel">Tolak Peminjam</h4>
											<button type="button" class="close text-white" data-dismiss="modal"
											aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{url('tolak-peminjam/'.$data->id)}}" method="post">
												@csrf
												<p>Apakah Anda Yakin Ingin Menolak?</p>
											</div>
											<div class="modal-footer outer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
												<button type="submit" class="btn btn-danger text-white">Tolak</button>
											</div>
										</form>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!--End of Modal Section-->
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
	</div>
</div> <!-- .col-12 -->
</div>

<!-- Modal Generate PDF -->
<div class="modal fade" id="modal-print" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{url('/pdf-riwayat')}}" method="post" target="_blank">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="date-input1">Masukkan Alokasi Tanggal</label>
						<input type="text" name="datetimes" class="form-control datetimes" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Buat Laporan!</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End of Modal Generate PDF -->
@endsection
@section('my-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
	new Chart(document.getElementById("chart--line"), {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
			datasets: [
			{
				label: "Total Barang Dipinjam",
				backgroundColor: "#4371bc",
				data: [@foreach($total_peminjam as $data) {{ $data }},@endforeach],
			}
			]
		},
		options: {
			responsive: true,
			legend: {
				display: false
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
                      stepSize: 100 // this worked as expected
                  }
              }],
              xAxes: [{
              	ticks: {
              		maxTicksLimit: 30
              	}
              }]
          },
      }
  });
</script>

@endsection