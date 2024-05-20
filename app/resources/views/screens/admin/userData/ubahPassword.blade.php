@extends('layout.main-nav')

@section('title')
    Password
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">Password</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Data</strong> Pengguna
                            </div>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Informasi Pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="mx-4">
                                            <td>Nama</td>
                                            <td>{{ $getData->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $getData->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            @if ($getData->telp)
                                                <td>{{ $getData->telp }}</td>
                                            @else
                                                <td>
                                                    <p class="bg-warning p-1 rounded-3">
                                                        Data Belum Diperbaharui User
                                                    </p>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="col offset-2">
                                <form action="" method="post">
                                    @csrf
                                        <div class="form-group mb-3">
                                            <label for="password">Ubah Password</label>
                                            <input type="text" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password Baru">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    <button type="submit" class="btn btn-primary">Update Password <i class="bi bi-check-lg"></i></button>
                                    <a href="{{ url('/umkm') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection