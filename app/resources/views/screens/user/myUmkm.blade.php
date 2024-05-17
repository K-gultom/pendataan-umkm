@extends('layout.main-nav')

@section('title')
    UMKM Saya
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data UMKM Saya</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data UMKM Saya</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Data</strong> UMKM
                    </div>
                    <div class="w-100 text-end">
                        @if (empty($getProfile->foto_ktp))
                            <a href="{{url('/umkm/profile')}}" class="btn btn-primary"> 
                                Lengkapi Data Diri <i class="bi bi-plus-circle"></i> 
                            </a> 
                        @else
                            <a href="{{url('/umkm/add')}}" class="btn btn-primary"> 
                                Tambah Data UMKM <i class="bi bi-plus-circle"></i> 
                            </a> 
                        @endif
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
                            <th>Nama UMKM</th>
                            <th class="text-center">RT</th>
                            <th class="text-center">Kategori UMKM</th>
                            <th width="150px">Foto UMKM</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getUmkm as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }} 
                                    </td>
                                    <td>{{$item->nama_usaha}} </td>
                                    <td class="text-center">{{$item->getRT->wilayah_rt}} </td>
                                    <td class="text-center">{{$item->getKategori->nama_kategori}} </td>
                                    <td>
                                        <a href="{{ url('/assets/images/umkm/'.$item->foto_umkm) }}" target="_blank">
                                            <img src="{{ url('/assets/images/umkm/'.$item->foto_umkm) }}" class="img-fluid" alt="Foto_KTP" style="width: 70%;">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a id="viewModal" href="" data-id="{{ $item->id }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lihatdata">
                                            <i class="bi bi-eye"></i> Status UMKM
                                        </a>
                                        {{-- <a href="{{ url('/umkm/view') }}/{{ $item->id }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-eye"></i> Lihat Data
                                        </a> --}}
                                        </a>
                                        <a href="{{ url('/umkm/edit') }}/{{ $item->id }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit Data
                                        </a>
                                        <a href="{{url('/umkm/del')}}/{{ $item->id }}" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Hapus Data ???');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>   
                            @endforeach
                    </tbody>
                </table>
                {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                {{-- {{$item->links()}} --}}
            </div>
        </div> 
    </div>
    

    <div class="section">
        <div class="modal fade" id="lihatdata" tabindex="-1" aria-labelledby="lihatdataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="lihatdataLabel">Data UMKM --- <span id="namaUsaha"></span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <p>Nama Pemilik UMKM : <strong id="nama"></strong> </p>
                            <p>Nomor Induk Kependudukan : <strong id="nik"></strong> </p>
                            <p>Alamat Pemilik: <strong id="alamat"></strong> </p>
                            <p>RT : <strong id="rt"></strong> </p>
                            <p>Jenis UMKM : <strong id="jenis"></strong> </p>
                            <p>Kategori UMKM : <strong id="namaKategori"></strong> </p>
                            <p>Nama Usaha : <strong id="namaUsahaBody"></strong> </p>
                            <p >Alamat Usaha : <strong id="alamatUsaha"></strong> </p>
                            <p >No. Telepon : <strong id="telp"></strong> </p>
                            <p> Status UMKM: <span id="statusContainer"></span>
                            </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const viewModal = document.querySelector('#lihatdata');

        viewModal.addEventListener('show.bs.modal', (e) => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-id')
            
            fetch('/api/view/' + id).then(response => response.json()).then(data => {
                console.log(data);
                document.getElementById('nama').textContent  = data.data.name;
                document.getElementById('nik').textContent  = data.data.nik;
                document.getElementById('alamat').textContent  = data.data.alamat_pemilik;
                document.getElementById('rt').textContent  = data.data.get_r_t.wilayah_rt;
                document.getElementById('jenis').textContent  = data.data.get_jenis.jenis_umkm;
                document.getElementById('namaKategori').textContent  = data.data.get_kategori.nama_kategori;
                document.getElementById('namaUsaha').textContent  = data.data.nama_usaha;
                document.getElementById('namaUsahaBody').textContent  = data.data.nama_usaha;
                document.getElementById('alamatUsaha').textContent  = data.data.alamat_usaha;
                document.getElementById('telp').textContent  = data.data.telp;
                document.getElementById('statusContainer').innerHTML  = `
                    <span id="status" class="badge rounded-pill
                        ${(data.data.status == 'Disetujui') && 'bg-success text-white'}
                        ${(data.data.status == 'Sedang Ditinjau') && 'bg-warning text-dark'}
                        ${(data.data.status == 'Tidak Disetujui') && 'bg-danger text-white'}
                        ">
                          ${data.data.status}
                    </span>
                `;
            })
        })
    </script>
@endsection