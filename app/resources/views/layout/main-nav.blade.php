<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap Assets CSS -->
    <link rel="stylesheet" href="{{ url('assets/bootstrap5/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- Bootstrap ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            position: relative;
        }
        a:hover {
            background-color: #001C45;
        }
        .navbar {
            background-color: #1B54A9;
        }
        .navbar-brand {
            margin-left: 20px;
            font-size: 25px;
            font-weight: 600;
        }
        .clr {
            background-color: #003788;
            box-shadow: 10px 10px 20px 5px rgb(194, 194, 194);
        }
        .head {
            color: #ffffff;
        }
        .head:hover {
            color: #ffffff;
        }
        .content-wrap {
            min-height: 100%;
            padding-bottom: 50px;
        }
        footer {
            background-color: #616161;
            color: #fff;
            height: 50px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
<div class="d-flex">
    <div class="clr max-height-vh-100 min-vh-100 col-2">
        <nav class="nav flex-column">
            <div class="container mt-3">
                <a class="head navbar-brand mt-3" href="#"> 
                    <img src="{{ url('/assets/images/logo-kelurahan.png') }}" height="40">
                    Kelurahan 9 Ilir
                </a>
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
        <nav class="navbar navbar-dark navbar-expand-lg border-left-1">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button id="toggleMenuBtn" class="btn btn-light me-2"><i class="fas fa-bars"></i></button>
                    <a class="navbar-brand" href="#">
                        Hai {{Auth()->user()->name}}
                    </a>  
                </div>
                <a href="{{url('/logout')}}" class="text-light" style="text-decoration: none;">Logout <i class="bi bi-box-arrow-right text-light ms-auto"></i></a>
            </div>
            
        </nav>

        <div class="mx-2 p-1">
            @yield('content')
            <div class="mb-5"></div>
        </div> 
        <footer class="text-center p-3">
            &copy; 2024 Kelurahan 9 Ilir - Pendataan UMKM Apps All rights reserved.
        </footer>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('assets/bootstrap5/js/bootstrap.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleMenuBtn = document.getElementById('toggleMenuBtn');
        const sidebar = document.querySelector('.clr');

        toggleMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('d-none');
        });
    });
</script>
</body>
</html>
