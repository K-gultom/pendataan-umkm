@extends('layout.main-nav')

@section('title')
    UMKM Saya
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Profile Saya</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profle Saya </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Profile</strong> saya
                            </div>

                            @if (@isset($getProfile->alamat))
                                
                            @else
                            <div class="w-100 text-end">
                                <a href="{{url('/umkm/lengkapi')}}" class="btn btn-primary"> 
                                    Lengkapi Data <i class="bi bi-person"></i> 
                                </a> 
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="card-body">
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

                        <div class="row">
                            <div class="col">
                                @if (@isset($getProfile->alamat))
                                    <a href="{{url('/umkm/update')}}" class="btn btn-primary btn-sm mb-3">
                                        Ubah Data <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{url('/umkm/update/ktp')}}" class="btn btn-success btn-sm mb-3">
                                        Ubah Foto KTP <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{url('/umkm/update/kk')}}" class="btn btn-warning btn-sm mb-3">
                                        Ubah Foto KK <i class="bi bi-pencil"></i>
                                    </a>
                                @else
                                    
                                @endif
                    
                                <table class="table">
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $getProfile->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Username/email</td>
                                        <td>{{ $getProfile->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        @if (@isset($getProfile->alamat))
                                            <td>{{ $getProfile->alamat }}</td>
                                        @else
                                            <td><p class="bg-warning rounded-3 text-center p-1 w-75">Mohon Lengkapi Data Anda</p></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        @if (@isset($getProfile->telp))
                                            <td>{{ $getProfile->telp }}</td>
                                        @else
                                            <td><p class="bg-warning rounded-3 text-center p-1 w-75">Mohon Lengkapi Data Anda</p></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        @if (isset($getProfile->jenis_kelamin))
                                            @if ($getProfile->jenis_kelamin === 'L')
                                                <td>Laki-Laki</td>
                                            @elseif ($getProfile->jenis_kelamin === 'P')
                                                <td>Perempuan</td>
                                            @else
                                                <td>Mohon Lengkapi Data Anda</td>
                                            @endif
                                        @else
                                            <td><p class="bg-warning rounded-3 text-center p-1 w-75">Mohon Lengkapi Data Anda</p></td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                            
                        <div class="col">
                            <div class="row">
                                @if (isset($getProfile->foto_ktp))
                                    <div class="col">
                                        <div class="mb-4">
                                            <label class="form-label bg-primary p-1 rounded-4 w-25 text-center text-light" for="foto_ktp">Foto KTP</label> <br>
                                            <a href="{{ url('/assets/images/ktp/'.$getProfile->foto_ktp) }}" target="_blank">
                                                <img src="{{ url('/assets/images/ktp/'.$getProfile->foto_ktp) }}" class="img-fluid" alt="Foto_KTP" style="width: 50%;">
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <label class="form-label" for="foto_ktp">Foto KTP</label> <br>
                                    <p class="bg-warning rounded-3 text-center p-1 col-6">Mohon Lengkapi Data Anda</p>
                                @endif
                                
                            </div>
    
                            <div class="row">
                                @if (isset($getProfile->foto_kk))
                                    <div class="col">
                                        <div class="mb-2">
                                            <label class="form-label bg-primary p-1 rounded-4 w-25 text-center text-light" for="foto_kk">Foto KK</label> <br>
                                            <a href="{{ url('/assets/images/kk/'.$getProfile->foto_kk) }}" target="_blank">
                                                <img src="{{ url('/assets/images/kk/'.$getProfile->foto_kk) }}" class="img-fluid" alt="Foto_KK" style="width: 70%;">
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <label class="form-label" for="foto_ktp">Foto KK</label> <br>
                                    <p class="bg-warning rounded-3 text-center p-1 col-6">Mohon Lengkapi Data Anda</p>
                                @endif
                                
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection