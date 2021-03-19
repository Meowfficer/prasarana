<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/img/box.png')}}">

  <title>@yield('title')</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="{{asset('public/css/simplebar.css')}}">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="{{asset('public/css/feather.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/select2.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/dropzone.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/uppy.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/jquery.steps.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/jquery.timepicker.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/quill.snow.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/dataTables.bootstrap4.css')}}">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="{{asset('public/css/daterangepicker.css')}}">
  <!-- App CSS -->
  <link rel="stylesheet" href="{{asset('public/css/app-light.css')}}" id="lightTheme">
  <link rel="stylesheet" href="{{asset('public/css/app-dark.css')}}" id="darkTheme" disabled>
  @yield('my-css')
  <link href="{{asset('public/css/animate.min.css')}}" rel="stylesheet">
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    [data-notify="progressbar"] {
      margin-bottom: 0px;
      position: absolute;
      bottom: 0px;
      left: 0px;
      width: 100%;
      height: 5px;
    }

    .btn-rounded {
      border-radius: 50px;
    }

    @media (max-width: 991.98px){
      .horizontal .navbar-slide {
        overflow-y: hidden;
        top: auto;
        height: 100%;
      }
    }
  </style>
</head>
<body class="horizontal light  ">
  <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
      <div class="container-fluid">
        <a class="navbar-brand mx-lg-1 mr-0" href="{{url('/')}}">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87  " />
              <polygon class="st0" points="96,69 33,69 42,51 105,51   " />
              <polygon class="st0" points="78,33 15,33 24,15 87,15  " />
            </g>
          </svg>
        </a>
        <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <div class="navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
          <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
          </a>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/')}}">
                <span class="ml-lg-2">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/pinjam-barang')}}">
                <span class="ml-lg-2">Pinjam Barang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/kembalikan-barang')}}">
                <span class="ml-lg-2">Kembalikan Barang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/history-peminjam-barang')}}">
                <span class="ml-lg-2">Riwayat Peminjam Barang</span>
              </a>
            </li>
            @if(Auth::user()->role == 1)
            <li class="nav-item dropdown">
              <a href="#" id="ui-elementsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-lg-2">Data Barang</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="ui-elementsDropdown">
                <a class="nav-link pl-lg-2" href="{{url('/barang')}}"><span class="ml-1">Data Barang</span></a>
                <a class="nav-link pl-lg-2" href="{{url('/barang-masuk')}}"><span class="ml-1">Barang Masuk</span></a>
                <a class="nav-link pl-lg-2" href="{{url('/barang-keluar')}}"><span class="ml-1">Barang Keluar</span></a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" id="formsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-lg-2">Data Peminjam Barang</span>
                <span class="badge badge-pill badge-danger" id="count"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="formsDropdown">
                <a class="nav-link pl-lg-2" href="{{url('persetujuan-peminjam')}}"><span class="ml-1">Persetujuan Peminjam Barang</span> <span class="badge badge-pill badge-danger" id="count2"></span></a>
                <a class="nav-link pl-lg-2" href="{{url('peminjam-barang')}}"><span class="ml-1">Peminjam Barang</span></a>
                <a class="nav-link pl-lg-2" href="{{url('persetujuan-pengembalian')}}"><span class="ml-1">Persetujuan Pengembalian Barang</span> <span class="badge badge-pill badge-danger" id="count3"></span></a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" id="tablesDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-lg-2">Data User</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="tablesDropdown">
                <a class="nav-link pl-lg-2" href="{{url('/supplier')}}"><span class="ml-1">Data Supplier</span></a>
                <a class="nav-link pl-lg-2" href="{{url('/account')}}"><span class="ml-1">Data Akun User</span></a>
              </div>
            </li>
            @endif
          </ul>
        </div>
        <div class="form-inline ml-md-auto d-none d-lg-flex text-muted">
          <div class="mr-sm-2 pl-4"></div>
        </div>
        <ul class="navbar-nav d-flex flex-row">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="javascript:;" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item dropdown ml-lg-0">
            <a class="nav-link dropdown-toggle text-muted my-2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class=" fe fe-settings fe-16"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('/user/edit/')}}">Pengaturan Akun</a>
                <a class="nav-link pl-3" href="{{url('/change-password')}}">Ganti Password</a>
                <a class="nav-link pl-3" href="{{url('/logout')}}">Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="main-content">
      <div class="container-fluid">
        @yield('container')
      </div>
    </main> <!-- main -->
  </div> <!-- .wrapper -->
  <script src="{{asset('public/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/js/popper.min.js')}}"></script>
  <script src="{{asset('public/js/moment.min.js')}}"></script>
  <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/js/simplebar.min.js')}}"></script>
  <script src="{{asset('public/js/daterangepicker.js')}}"></script>
  <script src="{{asset('public/js/jquery.stickOnScroll.js')}}"></script>
  <script src="{{asset('public/js/tinycolor-min.js')}}"></script>
  <script src="{{asset('public/js/config.js')}}"></script>
  <script src="{{asset('public/js/d3.min.js')}}"></script>
  <script src="{{asset('public/js/topojson.min.js')}}"></script>
  <script src="{{asset('public/js/datamaps.all.min.js')}}"></script>
  <script src="{{asset('public/js/datamaps-zoomto.js')}}"></script>
  <script src="{{asset('public/js/datamaps.custom.js')}}"></script>
  <script src="{{asset('public/js/Chart.min.js')}}"></script>
  <script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
  </script>
  <script src="{{asset('public/js/gauge.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('public/js/apexcharts.min.js')}}"></script>
  {{-- <script src="{{asset('public/js/apexcharts.custom.js')}}"></script> --}}
  <script src="{{asset('public/js/jquery.mask.min.js')}}"></script>
  <script src="{{asset('public/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.steps.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.timepicker.js')}}"></script>
  <script src="{{asset('public/js/dropzone.min.js')}}"></script>
  <script src="{{asset('public/js/uppy.min.js')}}"></script>
  <script src="{{asset('public/js/quill.min.js')}}"></script>
  <script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>
  @yield('my-js')
  <script>
    $('#dataTable').DataTable(
    {
      autoWidth: true,
      "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
      ]
    });
  </script>
  <script src="{{asset('public/js/apps.js')}}"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script type="text/javascript">
    /** date range picker */
    if ($('.datetimes').length)
    {
      $('.datetimes').daterangepicker(
      {
        timePicker: false,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: 
        {
          format: 'YYYY-M-DD'
        }
      });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end)
    {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker(
    {
      startDate: start,
      endDate: end,
      locale: 'id_ID',
      ranges:
      {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);
    cb(start, end);
  </script>
  <script>
  //Looping Popup Form
  var old_count = 0;
  var i = 0;
  $.ajax({
    type: "GET",
    url: "{{ url('/count-data-bread') }}"
  })
  .done(function( data ) {
   if (data > old_count) { if (i == 0){old_count = data;} 
   else{
    $.notify({
      message: 'Test'
    },{
      element: 'body',
      position: null,
      type: "info",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: true,
      placement: {
        from: "top",
        align: "right"
      },
      delay: 5000,
      timer: 1000
    });        
    old_count = data;}
  } i=1;
  setTimeout(getCount, 1000);
});
</script>
<script>
  function getCount() {

    $.ajax({
      type: "GET",
      url: "{{ url('/count-data') }}"
    })
    .done(function( data ) {
      if(data > 0){
        $('#count2').html(data);
      }
      $('#count4').html(data);
      setTimeout(getCount, 1000);
    });

    $.ajax({
      type: "GET",
      url: "{{ url('/count-data-kembali') }}"
    })
    .done(function( data ) {
      if(data > 0){
        $('#count3').html(data);
      }
      setTimeout(getCount, 1000);
    });

    $.ajax({
      type: "GET",
      url: "{{ url('/count-data-total') }}"
    })
    .done(function( data ) {
      if(data > 0){
        $('#count').html(data);
      }
      setTimeout(getCount, 1000);
    });
  }
  getCount();
</script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag()
  {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-56159088-1');
</script>
<script src="{{asset('public/js/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap-notify.js')}}"></script>
@if(session('success'))
<script>
  $.notify({
    message: '{{ \Illuminate\Support\Facades\Session::get('success') }}'
  },{
    element: 'body',
    position: null,
    type: "success",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@elseif(session('danger'))
<script>
  $.notify({
    message: '{{ \Illuminate\Support\Facades\Session::get('danger') }}'
  },{
    element: 'body',
    position: null,
    type: "danger",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@elseif(session('info'))
<script>
  $.notify({
    message: '{{ \Illuminate\Support\Facades\Session::get('info') }}'
  },{
    element: 'body',
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@elseif(session('warning'))
<script>
  $.notify({
    message: '{{ \Illuminate\Support\Facades\Session::get('warning') }}'
  },{
    element: 'body',
    position: null,
    type: "warning",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@endif
@error('jumlah')
<script>
  $.notify({
    message: '{{ $message }}'
  },{
    element: 'body',
    position: null,
    type: "warning",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@enderror
@error('nama_peminjam')
<script>
  $.notify({
    message: '{{ $message }}'
  },{
    element: 'body',
    position: null,
    type: "warning",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: true,
    placement: {
      from: "top",
      align: "right"
    },
    delay: 5000,
    timer: 1000
  });
</script>
@enderror
</body>
</html>