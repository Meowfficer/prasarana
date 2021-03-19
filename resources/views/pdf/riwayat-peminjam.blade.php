<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Laporan Peminjam Barang</title>
  <style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      margin: 0 auto; 
      color: #001028;
      background: #FFFFFF; 
      font-family: Arial, sans-serif; 
      font-size: 12px; 
      font-family: Arial;
    }

    header {
      padding: 10px 0;
      margin-bottom: 30px;
    }

    #logo {
      text-align: center;
      margin-bottom: 10px;
    }

    #logo img {
      width: 90px;
    }

    h1 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: #F5F5F5;;
    }

    #project {
      float: left;
    }

    #project span {
      color: #5D6975;
      /*text-align: right;*/
      width: 52px;
      margin-right: 10px;
      /*display: inline-block;*/
      font-size: 0.8em;
    }

    #company {
      float: right;
      color: #5D6975;
      text-align: right;
    }

    #project div,
    #company div {
      white-space: nowrap;        
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;        
      font-weight: normal;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      padding: 20px;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table td.grand {
      border-top: 1px solid #5D6975;;
    }

    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
  </style>
</head>
<body>
  <header class="clearfix">
    <h1>Laporan Peminjaman Barang</h1>
    {{-- <div id="company">
      <div>Company Name</div>
      <div>455 Foggy Heights,<br /> AZ 85004, US</div>
      <div>(602) 519-0450</div>
      <div><a href="mailto:company@example.com">company@example.com</a></div>
    </div> --}}
    <div id="project">
      <div><span>Pembuat Laporan :</span> {{Auth::user()->name}}</div>
      <div><span>Rentan Waktu :</span> {{$dariIND}} ~ {{$sampaiIND}}</div>
      <div><span>Tanggal Dibuat :</span> {{$today}}</div>
    </div>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Kode Barang</th>
          <th>Seri Barang</th>
          <th>Nama Barang</th>
          <th>Nama Peminjam</th>
          <th>Alasan Meminjam</th>
          <th>Tanggal Meminjam</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $data)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$data->kode_barang}}</td>
          <td>{{$data->seri_barang}}</td>
          <td>{{$data->nama_barang}}</td>
          <td>{{$data->nama_peminjam}}</td>
          <td>{{$data->deskripsi}}</td>
          <td>{{\Carbon\Carbon::parse($data->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div id="notices">
      <div>Informasi:</div>
      <div class="notice">Data di atas merupakan data peminjaman barang berdasarkan barang yang sudah dikembalikan oleh peminjam barang Tersebut.</div>
    </div>
  </main>
  {{-- <footer>
    Invoice was created on a computer and is valid without the signature and seal.
  </footer> --}}
</body>
</html>