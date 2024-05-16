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
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body text-start">
                            <div class="d-flex">
                                <p class="card-text text-start w-100">UMKM Disetujui</p>
                                <h3 class="card-title">{{ $approvedCount }}</h3>
                            </div>
                            <a href="#" class="btn btn-more-info" data-bs-toggle="modal" data-bs-target="#umkmDisetujui">
                                More info <i class="fas fa-arrow-circle-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body text-start">
                            <div class="d-flex">
                                <p class="card-text text-start w-100">UMKM Tidak Disetujui</p>
                                <h3 class="card-title">{{ $disapprovedCount }}</h3>
                            </div>
                            <a href="#" class="btn btn-more-info"  data-bs-toggle="modal" data-bs-target="#umkmTidakdisetujui">
                                More info <i class="fas fa-arrow-circle-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body text-start">
                            <div class="d-flex">
                                <p class="card-text text-start w-100">Jumlah UMKM Terdaftar</p>
                                <h3 class="card-title">{{ $approvedCount }}</h3>
                            </div>
                            <a href="#" class="btn btn-more-info" data-bs-toggle="modal" data-bs-target="#JumlahSeluruhUMKM">
                                More info <i class="fas fa-arrow-circle-right ms-2"></i>
                            </a>
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
    </style>

    {{-- UMKM YANG DISETUJUI --}}
    <div class="section1">
        <div class="modal fade" id="umkmDisetujui" tabindex="-1" aria-labelledby="umkmDisetujuiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="umkmDisetujuiLabel">Jumlah UMKM Disetujui</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Jumlah UMKM Yang Disetujui di wilah RT Anda Adalah <strong>{{ $approvedCount }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- UMKM YANG TIDAK DISETJUI --}}
    <div class="section2">
        <div class="modal fade" id="umkmTidakdisetujui" tabindex="-1" aria-labelledby="umkmTidakdisetujuiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="umkmTidakdisetujuiLabel">Jumlah UMKM Tidak Disetujui</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Jumlah UMKM Yang Disetujui di wilah RT Anda Adalah <strong>{{ $disapprovedCount }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JUMLAH KESELURUHAN UMKM --}}
    <div class="section3">
        <div class="modal fade" id="JumlahSeluruhUMKM" tabindex="-1" aria-labelledby="JumlahSeluruhUMKMLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="JumlahSeluruhUMKMLabel">Jumlah Seluruh UMKM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Jumlah Seluruh Yang Terdaftar UMKM <strong>{{ $approvedCount }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection