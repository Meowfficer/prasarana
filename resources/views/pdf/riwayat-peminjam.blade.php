<!DOCTYPE html>
<html>
<head>
  <title>Laporan Peminjaman Barang</title>
  <style>
    body{
      font-family: arial, sans-serif;
    }

    .judul{
      /*margin-top: 50px;*/
      background: #f5f5f5;
      text-align: center;
    }

    .text-right{
      text-align: right;
    }

    .text-left{
      text-align: left;
    }

    p{
      margin-top: 0px;
      margin-bottom: 0px;
    }

    .grid-container {
      display: grid;
      grid-template-columns: auto auto auto;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin-top: 10px;
      margin-bottom: 50px;
    }

    td, th {
      /*border: 1px solid #dddddd;*/
      text-align: left;
      padding: 8px;
    }  

    tr:nth-child(even) {
      background-color: #f5f5f5;
    }

  </style>
</head>
<body>
  <h1 class="judul">Laporan Peminjaman Barang</h1>
  <h2 style="margin: 0px;">Pembuat Laporan : {{Auth::user()->name}}</h2>
  <h2 style="margin: 0px;">Rentan Waktu : {{$dariIND}} ~ {{$sampaiIND}}</h2>
  <p style="font-size: 15px; width: 100%; margin-top: 30px">Note : Data Berikut Diambil Berdasarkan Barang Yang Sudah Dikembalikan</p>
  <table>
    <tr>
      <th>#</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Nama Peminjam</th>
      <th>Alasan Peminjam</th>
    </tr>
    @foreach($data as $data)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$data->kode_barang}}</td>
      <td>{{$data->nama_barang}}</td>
      <td>{{$data->jml_barang}}</td>
      <td>{{$data->nama_peminjam}}</td>
      <td>{{$data->deskripsi}}</td>
    </tr>
    @endforeach
  </table>
  <p class="text-right">{{$today}}</p>
</body>
</html>