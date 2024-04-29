{{-- Ini merupakan main master menu --}}

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    {{-- Bootstrap Assets CSS --}}
    <link rel="stylesheet" href="{{ url('assets/bootstrap5/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  </head>
  <body>
    <style>
        body{
            position: relative;
        }
        a:hover{
            background-color: rgb(1, 82, 145);
        }
        .navbar-brand{
            margin-left: 20px;
            font-size: 25px;
            font-weight: 600;
        }
        .clr{
            background-color: #245fb8;
            box-shadow: 10px 10px 20px 5px rgb(194, 194, 194);
        }
        .head{
            color: #ffffff;
        }
        .head:hover{
            /* background-color: rgb(1, 82, 145); */
            color: #ffffff;
        }
        .content-wrap {
            min-height: 100%;
            padding-bottom: 50px; /* Sesuaikan dengan tinggi footer */
        }
        footer {
            background-color: #888687;
            color: #ffffff;
            height: 50px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
        }
    </style>
    <div class="d-flex">
        <div class="clr max-height-vh-100 min-vh-100 col-2">
            <nav class="nav flex-column">
                <div class="container mt-3">
                    <a class="head navbar-brand mt-3"> 
                        <img src="" height="40">
                         Kelurahan ABC
                    </a>
                    <h3 class="head m-3"></h3>
                    {{-- <a class="navbar-brand text-light">{{auth()->user()->level}}</a> --}}
                    <h3 class="head m-3"></h3> 
                </div>
                <a href="{{url('/dashboard')}}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Dashboard</a>
                <a href="{{url('#')}}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Menu1</a>
                <a href="{{url('#')}}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Menu2</a>
                <a href="{{url('#')}}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Menu3</a>
                <a href="{{url('#')}}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Menu4</a>

                
                
            </nav> 
        </div>

        <div class="col">
            <nav class="navbar navbar-dark bg-primary navbar-expand-lg border-left-1">
                <div class="container-fluid">
                    <a class="navbar-brand">
                        {{-- Hai, {{auth()->user()->nama}}  --}}
                        Hai
                    </a>  
                    <a href="{{url('/logout')}}" class="text-light" style="text-decoration: none;">Logout <i class="bi bi-box-arrow-right text-light m-1"></i></a>
                </div>
            </nav>

            <div class="m-1 p-3">
                @yield('contentmenu')


                <div class="mb-5"></div>
            </div> 
            <footer class="text-center p-3">
                &copy; 2024 Kelurahan 9 Ilir - Pendataan UMKM Apps All rights reserved.
            </footer>
        </div>
        
    </div>
    
    <script src="{{ url('assets/bootstrap5/js/bootstrap.min.js') }}"></script>
  </body>
</html>