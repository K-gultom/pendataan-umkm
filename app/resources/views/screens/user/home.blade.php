@extends('layout.main-nav')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Dashboard</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="row mt-2 mb-3">

            <div class="col-12">
                @if(session('message'))
                    <div id="flash-message" class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('flash-message').style.display = 'none';
                        }, {{ session('timeout', 5000) }});
                    </script>
                @endif
                <div class="card mb-4">
                    <div class="card-body abc">
                        <h4>Panduan!!!</h4>
                        <ol>
                            <li>Silahkan Lengkapi Data Diri Terlebih Dahulu Pada Menu Profile</li>
                            <li>Tambah Data UMKM Anda Pada Menu UMKM Saya</li>
                        </ol>
                        <ul>
                            <li>Pastikan kelengkapan data UMKM Anda sudah sesuai</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Status dari RT</h3>
                        <p class="card-text">Disetujui/Tidak Disetujui</p>
                        <a href="{{ url('/umkm/data') }}" class="btn btn-more-info">More info <i class="fas fa-arrow-circle-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="bg-success rounded-3 p-2 text-light">Disetujui</h6>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shop w-75 custom-icon-size"></i>
                            <h4 class="mx-2">{{ $disetujui }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="bg-danger rounded-3 p-2 text-light">Tidak Disetujui</h6>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shop w-100 custom-icon-size"></i>
                            <h4 class="mx-2">{{ $tidakDisetujui }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="bg-warning rounded-3 p-2 text-light">Sedang ditinjau</h6>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shop w-100 custom-icon-size"></i>
                            <h4 class="mx-2">{{ $sedangDitinjau }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .abc{
            
            background-color: #FFE600;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #F0EBEB;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-body {
            padding: 20px;
            text-align: start;
        }
        .card-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1.5rem;
            color: #6c757d;
        }
        .btn-more-info {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
        }
        .btn-more-info:hover {
            background-color: #0056b3;
        }
        .custom-icon-size {
            font-size: 30px; /* Adjust the size as needed */
        }
    </style>
@endsection