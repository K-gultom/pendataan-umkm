@extends('layout.main-nav')

@section('title')
    Dashboard RT
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Dashboard RT</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        
        <div class="row">
            {{-- @for ($a = 0; $a < 4; $a++) --}}
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="bg-warning rounded-3 p-2 text-light">Sedang ditinjau</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="bi bi-shop custom-icon-size"></i>
                                <h3 class="mx-2">{{ $sedangDitinjau }}</h3>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ url('/rt/ditinjau') }}" class="btn btn_info">Lihat Data <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="bg-success rounded-3 p-2 text-light">Disetujui</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="bi bi-shop custom-icon-size"></i>
                                <h4 class="mx-2">{{ $disetujui }}</h4>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ url('/rt/disetujui') }}" class="btn btn_info">Lihat Data <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="bg-danger rounded-3 p-2 text-light">Tidak Disetujui</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="bi bi-shop custom-icon-size"></i>
                                <h4 class="mx-2">{{ $tidakDisetujui }}</h4>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ url('/rt/tidak/disetujui') }}" class="btn btn_info">Lihat Data <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="bg-info rounded-3 p-2 text-light">UMKM Terdaftar</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <i class="bi bi-shop custom-icon-size"></i>
                                <h4 class="mx-2">{{ $disetujui }}</h4>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ url('/rt/disetujui') }}" class="btn btn_info">Lihat Data <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endfor --}}
        </div>
    </div>

    <style>
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
            text-align: center;
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
        .btn_info{
            background-color: #003788;
            color: #fff;
            border-radius: 5px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
        }
        .btn_info:hover {
            background-color: #DC6B19;
            color: #000000;
        }
        .custom-icon-size {
            font-size: 30px; /* Adjust the size as needed */
        }
    </style>

@endsection