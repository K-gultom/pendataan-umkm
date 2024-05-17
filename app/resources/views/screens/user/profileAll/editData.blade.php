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
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Profile</strong> saya
                            </div>
                            <div class="w-100 text-end">
                                <a href="{{url('/umkm/profile')}}" class="btn btn-primary"> 
                                    Profile <i class="bi bi-person"></i> 
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{url('/umkm/update')}}" class="btn btn-primary btn-sm mb-3">
                            Ubah Data <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{url('/umkm/update/ktp')}}" class="btn btn-success btn-sm mb-3">
                            Ubah Foto KTP <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{url('/umkm/update/kk')}}" class="btn btn-warning btn-sm mb-3">
                            Ubah Foto KK <i class="bi bi-pencil"></i>
                        </a>
                        <ul>
                            <li>Nama : {{ $getProfile->name }}</li>
                            <li>Username/email : {{ $getProfile->email }}</li>
                            <li>Alamat : {{ $getProfile->alamat }}</li>
                            <li>Telepon : {{ $getProfile->telp }}</li>
                            <li>Jenis Kelamin : {{ $getProfile->jenis_kelamin }}</li>
                        </ul>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label bg-primary p-1 rounded-4 w-25 text-center text-light" for="foto_ktp">Foto KTP</label> <br>
                                    <a href="{{ url('/assets/images/ktp/'.$getProfile->foto_ktp) }}" target="_blank">
                                        <img src="{{ url('/assets/images/ktp/'.$getProfile->foto_ktp) }}" class="img-fluid" alt="Foto_KTP" style="width: 50%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label bg-primary p-1 rounded-4 w-25 text-center text-light" for="foto_kk">Foto KK</label> <br>
                                    <a href="{{ url('/assets/images/kk/'.$getProfile->foto_kk) }}" target="_blank">
                                        <img src="{{ url('/assets/images/kk/'.$getProfile->foto_kk) }}" class="img-fluid" alt="Foto_KK" style="width: 70%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                         <strong>Form</strong> Kelengkapan Data Diri
                    </div>
                    <div class="card-body">
                        <form action="{{url('/umkm/update')}}" method="post">
                            @csrf
                                <div class="form-group mb-4">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" value="{{old('alamat')}}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat Anda...">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="telp">No Telp/Whatsapp</label>
                                            <input value="{{old('telp')}}" type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="No Telp/whatsapp..." />
                                            @error('telp')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary">Save <i class="bi bi-check-lg"></i></button>
                            <a href="{{ url('/umkm/profile') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a>
                       </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection