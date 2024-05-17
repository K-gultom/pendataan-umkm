@extends('layout.main-nav')

@section('title')
    Jenis UMKM
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">Jenis UMKM</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/umkm/jenis')}}" class="text-decoration-none">Jenis UMKM</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Jenis UMKM</li>
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
                        <form action="{{ url('/umkm/jenis/edit') }}/{{ $getid->id }}" method="post">
                            @csrf
                                <div class="form-group mb-3">
                                    <label for="Jenis_UMKM">Jenis UMKM</label>
                                    <input type="text" id="Jenis_UMKM" value="{{old('Jenis_UMKM', $getid->jenis_umkm)}}" class="form-control @error('Jenis_UMKM') is-invalid @enderror" name="Jenis_UMKM" placeholder="Jenis UMKM">
                                    @error('Jenis_UMKM')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary">Update <i class="bi bi-check-lg"></i></button>
                            <a href="{{ url('/umkm/jenis') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a>
                       </form>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Data</strong> UMKM
                            </div>
                            <div class="w-100 text-end">
                                <a href="{{ url('/umkm/jenis') }}" class="btn btn-primary text-light btn-sm">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
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
                        
                        {{-- Alert delete --}}
                        @if (Session::has('DeleteSucces'))
                            <div class="alert alert-warning" id="flash-DeleteSucces">
                                {{Session::get('DeleteSucces')}}
                            </div>
                            <script>
                                setTimeout(function (){
                                    document.getElementById('flash-DeleteSucces').style.display='none';
                                }, {{ session('timeout', 5000) }});
                            </script>
                        @endif

                        {{-- alert Warning --}}
                        @if (session('DataNull'))
                            <div class="alert alert-warning" id="flash-DataNull">
                                {{session('DataNull')}}
                            </div>
                            <script>
                                setTimeout(function (){
                                    document.getElementById('flash-DataNull').style.display='none';
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
                                            {{ $loop->iteration }}    
                                        </td>
                                        <td>{{ $item->jenis_umkm }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/umkm/jenis/edit') }}/{{ $item->id }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="{{ url('/umkm/jenis/del') }}/{{ $item->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ???');">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection