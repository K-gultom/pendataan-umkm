@extends('layout.main-nav')

@section('title')
    Data UMKM 
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Data UMKM</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Data UMKM Disetujui</li>
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
                    <label for="search" class="form-label"><strong>Cari Data</strong> UMKM</label><br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Nama Pemilik ...">
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
                        <strong>Data</strong> UMKM Disetujui
                    </div>
                    <div class="w-100 text-end">
                        <a href="{{url('/rt/disetujui')}}" class="btn btn-primary">
                            Refresh Data <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if($getData->isEmpty())
                    <div class="alert alert-danger">
                        Maaf, Tidak Ada UMKM yang <strong>Disetujui</strong>
                    </div>
                @else
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
                            @foreach ($getData as $item)
                                <tr>
                                    <td>
                                        {{ (($getData->currentPage() - 1) * $getData->perPage()) + $loop->iteration }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nama_usaha }}</td>
                                    <td class="text-center">{{ $item->getJenis->jenis_umkm }}</td>
                                    <td class="text-center">{{ $item->getKategori->nama_kategori }}</td>
                                    <td class="text-center">{{ $item->getRT->wilayah_rt }}</td>
                                    <td class="text-center">
                                        <a id="viewModalStatus" href="" data-id="{{ $item->id }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#statusUmkm">
                                            <i class="bi bi-eye"></i> Status
                                        </a>
                                        {{-- <a id="SaveModel" data-id="{{ $item->id }}" href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#saveData">
                                            <i class="bi bi-eye"></i> Ubah Status UMKM
                                        </a> --}}
                                        <a href="{{ url('/rt/status') }}/{{ $item->id }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Lihat Data/Ubah Status
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $getData->links() }}
                @endif
                
            </div>
        </div>
    </div>

    {{-- Ubah Status --}}
    <div class="section">
        <div class="modal fade" id="saveData" tabindex="-1" aria-labelledby="saveDataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="saveDataLabel">Ubah Status UMKM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/api/update/umkm') }}" method="post" id="saveDataForm">
                            @csrf
                            <input type="text" name="id" id="saveDataId" hidden>
                            <div class="row">
                                <div class="col-4">
                                    <p><strong>Status UMKM:</strong></p>
                                </div>
                                <div class="col-3">
                                    <input type="radio" name="status" id="disetujui" value="Disetujui">
                                    <label for="disetujui">Disetujui</label>
                                </div>
                                <div class="col-4">
                                    <input type="radio" name="status" id="tidakdisetujui" value="Tidak Disetujui">
                                    <label for="tidakdisetujui">Tidak Disetujui</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check-lg"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lihat Data --}}
    <div class="section">
        <div class="modal fade" id="statusUmkm" tabindex="-1" aria-labelledby="statusUmkmLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="statusUmkmLabel">Data UMKM --- <span id="namaUsahaStatus"></span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nama Pemilik UMKM : <strong id="namaStatus"></strong></p>
                        <p>Nomor Induk Kependudukan : <strong id="nikStatus"></strong></p>
                        <p>Alamat Pemilik: <strong id="alamatStatus"></strong></p>
                        <p>RT : <strong id="rtStatus"></strong></p>
                        <p>Jenis UMKM : <strong id="jenisStatus"></strong></p>
                        <p>Kategori UMKM : <strong id="namaKategoriStatus"></strong></p>
                        <p>Nama Usaha : <strong id="namaUsahaBodyStatus"></strong></p>
                        <p>Alamat Usaha : <strong id="alamatUsahaStatus"></strong></p>
                        <p>No. Telepon : <strong id="telpStatus"></strong></p>
                        <p>Status UMKM: <span id="statusContainerStatus"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // FOR SHOW DATA
        const viewModalStatus = document.querySelector('#statusUmkm');
        viewModalStatus.addEventListener('show.bs.modal', (e) => {
            let button = e.relatedTarget;
            let id = button.getAttribute('data-id');

            fetch('/api/view/umkm/' + id).then(response => response.json()).then(data => {
                if (data) {
                    document.getElementById('namaStatus').textContent = data.data.name;
                    document.getElementById('nikStatus').textContent = data.data.nik;
                    document.getElementById('alamatStatus').textContent = data.data.alamat_pemilik;
                    document.getElementById('rtStatus').textContent = data.data.get_r_t.wilayah_rt;
                    document.getElementById('jenisStatus').textContent = data.data.get_jenis.jenis_umkm;
                    document.getElementById('namaKategoriStatus').textContent = data.data.get_kategori.nama_kategori;
                    document.getElementById('namaUsahaStatus').textContent = data.data.nama_usaha;
                    document.getElementById('namaUsahaBodyStatus').textContent = data.data.nama_usaha;
                    document.getElementById('alamatUsahaStatus').textContent = data.data.alamat_usaha;
                    document.getElementById('telpStatus').textContent = data.data.telp;
                    document.getElementById('statusContainerStatus').innerHTML = `
                        <span id="status" class="badge rounded-pill
                            ${(data.data.status == 'Disetujui') ? 'bg-success text-white' : ''}
                            ${(data.data.status == 'Sedang Ditinjau') ? 'bg-warning text-dark' : ''}
                            ${(data.data.status == 'Tidak Disetujui') ? 'bg-danger text-white' : ''}
                            ${(data.data.status == 'Tidak Aktif') ? 'bg-danger text-white' : ''}
                            ">
                            ${data.data.status}
                        </span>
                    `;
                } else {
                    console.error('No data found for the given ID.');
                }
            }).catch(error => {
                console.error('Error fetching data:', error);
            });
        });

        // FOR SAVE DATA
        document.querySelector('#saveDataForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch('{{ url("/api/update/umkm") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(data => {
                if (data.status) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        document.querySelectorAll('[data-bs-target="#saveData"]').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                document.getElementById('saveDataId').value = id;
            });
        });
    </script>
@endsection
