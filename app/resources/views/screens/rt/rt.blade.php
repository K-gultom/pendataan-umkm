@extends('layout.main-nav')

@section('title')
    RT
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data RT</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data RT</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Data</strong> RT
                    </div>
                    <div class="w-100 text-end">
                        <a href="{{url('/rt/add')}}" class="btn btn-primary"> 
                            Tambah Data RT <i class="bi bi-plus-circle"></i> 
                        </a> 
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

                <div class="container">
                    <div class="row m-5">
                        <form action="{{url('#')}}">
                            <label for="search" class="form-label"><strong>Cari Data</strong> RT</label> <br> 
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari Nama ... / Wilayah RT">
                                <button class="btn  btn-primary" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Wilayah RT</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ (($data->currentPage() - 1) * $data->perPage()) + $loop->iteration }} 
                                </td>
                                <td>{{$item->wilayah_rt}} </td>
                                <td>{{$item->name}} </td>
                                <td>{{$item->email}} </td>
                                <td>{{$item->telp}} </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-sm">
                                        <i class="bi bi-eye"></i> Lihat Data
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Hapus Data ???');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
                <a href="{{url('/rt')}}" class="btn btn-primary">Refresh Page <i class="bi bi-arrow-clockwise"></i></a>
                {{$data->links()}}
            </div>
        </div> 
    </div>
@endsection