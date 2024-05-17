@extends('layout.main-nav')

@section('title')
    Kategori UMKM
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">Kategori UMKM</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/umkm/kategori')}}">Kategori UMKM</a></li>
            <li class="breadcrumb-item active" aria-current="page">edit Kategori UMKM</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Edit</strong> Data
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_kategori">Kategori UMKM</label>
                                    <input type="text" id="nama_kategori" value="{{old('nama_kategori', $getId->nama_kategori)}}" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" placeholder="Kategori UMKM">
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary">Update <i class="bi bi-check-lg"></i></button>
                            <a href="{{ url('/umkm/kategori') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a>
                       </form>
                    </div>
                </div>
            </div>



            {{--===============================SECTION========================= --}}
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Data</strong> UMKM
                            </div>
                            <div class="w-100 text-end">
                                <a href="{{ url('/umkm/kategori') }}" class="btn btn-primary text-light btn-sm">Refresh Data</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="container">
                            <div class="row m-3">
                                <form action="{{url('#')}}">
                                    <label for="search" class="form-label"><strong>Cari Kategori </strong> UMKM</label> <br> 
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari Kategori UMKM...">
                                        <button class="btn  btn-primary" type="submit">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- Alert Success --}}
                        @if (Session::has('message'))
                            <div class="alert alert-success" id="flash-message">
                                {{Session::get('message')}}
                            </div>
                            <script>
                                setTimeout(function (){
                                    document.getElementById('flash-message').style.display='none';
                                }, {{ session('timeout', 5000) }});
                            </script>
                        @endif
                        <!-- SECTION -->
                        <table id="example2" class="table table-hover mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis UMKM</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $item )
                                    <tr>
                                        <td>
                                            {{ (($data->currentPage() - 1) * $data->perPage()) + $loop->iteration }} 
                                        </td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/umkm/kategori/edit') }}/{{ $item->id }}" class="btn btn-warning btn-sm">
                                                {{-- {{ url('/umkm/kategori/edit') }}/{{ $item->id }} --}}
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('/umkm/kategori/del') }}/{{ $item->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ???');">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection