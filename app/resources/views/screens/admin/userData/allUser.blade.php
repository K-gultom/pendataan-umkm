@extends('layout.main-nav')

@section('title')
    User UMKM
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Data User UMKM</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Data User UMKM</li>
            </ol>
        </nav>

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

        <div class="container">
            <div class="row m-5">
                <form action="">
                    <label for="search" class="form-label"><strong>Cari Data</strong> User UMKM</label><br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Nama Pemilik/UMKM/NIK ...">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="w-100 pt-1">
                        <strong>Data</strong> User UMKM
                    </div>
                    <div class="w-100 text-end">
                        <a href="{{url('/umkm')}}" class="btn btn-primary">
                            Refresh Data <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(isset($noDataMessage))
                    <div class="alert alert-warning">
                        {{ $noDataMessage }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getData as $item)
                            <tr>
                                <td>
                                    {{ (($getData->currentPage() - 1) * $getData->perPage()) + $loop->iteration }}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email}}</td>
                                @if ($item->telp > 0)
                                    <td>{{ $item->telp }}</td>
                                @else
                                    <td>Data Belum Diperbaharui User</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ url('/umkm/password') }}/{{ $item->id }}" class="btn btn-warning">Ganti Password <i class="bi bi-key"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $getData->links() }}
            </div>
        </div>
    </div>
    
    <style>
        .rotate {
            transform: rotate(90deg); /* Memutar ikon 90 derajat */
        }

    </style>
    
@endsection
