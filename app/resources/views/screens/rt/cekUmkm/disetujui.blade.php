@extends('layout.main-nav')

@section('title')
    Data UMKM Disetujui
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data UMKM</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data UMKM</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Data</strong> UMKM
                    </div>
                    <div class="w-100 text-end">
                        <a href="{{url('/rt/umkm')}}" class="btn btn-primary"> 
                            Refresh Data <i class="bi bi-plus-circle"></i> 
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
                
                @if(isset($noDataMessage))
                    <div class="alert alert-warning">
                    {{ $noDataMessage }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>Nama UMKM</th>
                            <th class="text-center">Jenis UMKM</th>
                            <th class="text-center">Kategori UMKM</th>
                            <th class="text-center">RT</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getApprove as $item)
                                <tr>
                                    <td>
                                        {{ (($getApprove->currentPage() - 1) * $getApprove->perPage()) + $loop->iteration }} 
                                        {{-- {{ $loop->iteration }}  --}}
                                    </td>
                                    <td>{{$item->name}} </td>
                                    <td>{{$item->nama_usaha}} </td>
                                    <td class="text-center">{{$item->getJenis->jenis_umkm}} </td>
                                    <td class="text-center">{{$item->getKategori->nama_kategori}} </td>
                                    <td class="text-center">{{$item->getRT->wilayah_rt}} </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#lihatdata">
                                            <i class="bi bi-eye"></i> Lihat Status UMKM
                                        </a>
                                    </td>
                                </tr>   
                            @endforeach
                    </tbody>
                </table>
                {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                {{$getApprove->links()}}
            </div>
        </div> 
    </div>


    <div class="section">
        <div class="modal fade" id="lihatdata" tabindex="-1" aria-labelledby="lihatdataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @foreach ($getApprove as $item)
                            <h1 class="modal-title fs-5" id="lihatdataLabel">Data UMKM --- {{ $item->nama_usaha }}</h1>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($getApprove as $item)
                            <p>Nama Pemilik UMKM : <strong>{{ $item->name }}</strong> </p>
                            <p>Nomor Induk Kependudukan : <strong>{{ $item->nik }}</strong> </p>
                            <p>Alamat Pemilik: <strong>{{ $item ->alamat_pemilik}}</strong> </p>
                            <p>RT : <strong>{{ $item->getRT->wilayah_rt}}</strong> </p>
                            <p>Jenis UMKM : <strong>{{ $item->getJenis->jenis_umkm}}</strong> </p>
                            <p>Kategori UMKM : <strong>{{ $item->getKategori->nama_kategori}}</strong> </p>
                            <p>Nama Usaha : <strong>{{ $item->nama_usaha}}</strong> </p>
                            <p>Alamat Usaha : <strong>{{ $item->alamat_usaha}}</strong> </p>
                            <p>No. Telepon : <strong>{{ $item->telp}}</strong> </p>
                            <p> Status UMKM: 
                                <span class="badge rounded-pill 
                                    @switch($item->status)
                                    @case('Disetujui')
                                        bg-success text-white
                                        @break
                                    @default
                                        bg-light text-dark
                                    @endswitch
                                ">
                                  {{$item->status}}
                                </span>
                            </p>
                            
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

