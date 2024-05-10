<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  {{-- Bootstrap Assets CSS --}}
  <link rel="stylesheet" href="{{ url('assets/bootstrap5/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <style>
    .row {
      display: flex;
      align-items: center; 
      justify-content: space-between; 
      margin-top: 5vh;
    }
    .logo {
      margin-top: 0;
      text-align: end; 
    }
    .content {
      margin-top: 0;
    }
  </style>

</head>
<body>

  <div class="row">
    <div class="col-6 logo text-end">
      <img src="{{ url('/assets/images/logo-kelurahan.png') }}" width="50%" alt="">
      <h3>Kelurahan 9 Ilir Kota Palembang</h3>
    </div>
    <div class="col-6 content">
      @yield('content')
    </div>
  </div>

  <script src="{{ url('assets/bootstrap5/js/bootstrap.min.js') }}"></script>
</body>
</html>
