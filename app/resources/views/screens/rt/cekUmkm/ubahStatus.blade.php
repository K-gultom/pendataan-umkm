
@extends('layout.main-nav')

@section('title')
    Data UMKM Saya
@endsection

@section('content')

<div class="container-fluid ">
    <h4 class="mb-2">Data UMKM</h4>
    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb">
            @if ($umkmData->status == 'Sedang Ditinjau')
                <li class="breadcrumb-item"><a href="{{url('/rt/ditinjau')}}" class="text-decoration-none">Data Sedang Ditinjau</a></li>
            @elseif($umkmData->status == 'Disetujui') 
                <li class="breadcrumb-item"><a href="{{url('/rt/disetujui')}}" class="text-decoration-none">Data Disetujui</a></li>
            @elseif($umkmData->status == 'Tidak Disetujui')   
                <li class="breadcrumb-item"><a href="{{url('/rt/tidak/disetujui')}}" class="text-decoration-none">Data Tidak Disetujui</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <strong>Data</strong> Pribadi
                </div>
            </div>
        </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="card alert alert-success">
                        {{Session::get('message')}}
                    </div>
                    @endif
                    <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                            {{-- <input value="{{old('name')}}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pemilik Usaha"/> --}}
                                            <input readonly value="{{ $umkmData->name ?? old('name') }}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pemilik Usaha" />
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
                                            <input readonly type="number" value="{{ $umkmData->nik ?? old('nik') }}" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor induk kependudukan"/>
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="rt_id">RT</label>
                                            <div class="input-group">
                                            <select disabled value="{{ old('rt_id') ?? $umkmData->rt_id }}" name="rt_id" class="form-control @error('rt_id') is-invalid @enderror" id="">
                                                <option value="">Pilih RT</option>
                                                @foreach ($getRT as $item)
                                                    <option readonly value="{{ $item->id }}" {{ $umkmData->rt_id == $item->id ? 'selected' : '' }}>{{ $item->wilayah_rt }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                            </div>
                                            @error('rt_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="alamat_pemilik">Alamat</label>
                                            <input readonly value="{{ $umkmData->alamat_pemilik ?? old('alamat_pemilik') }}" type="text" name="alamat_pemilik" id="alamat_pemilik" class="form-control @error('alamat_pemilik') is-invalid @enderror" placeholder="Alamat..." />
                                            @error('alamat_pemilik')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-4 text-center">
                                            <label class="form-label bg-primary p-1 rounded-4 w-50 text-center text-light" for="foto_umkm">Foto KTP</label> <br>
                                            <a href="{{ url('/assets/images/ktp/'.$umkmData->getUser->foto_ktp) }}" target="_blank">
                                                <img src="{{ url('/assets/images/ktp/'.$umkmData->getUser->foto_ktp) }}" class="img-fluid rounded border border-primary" alt="Foto KTP" width="50%">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-4 text-center">
                                            <label class="form-label bg-primary p-1 rounded-4 w-50 text-center text-light" for="foto_umkm">Foto KK</label> <br>
                                            <a href="{{ url('/assets/images/kk/'.$umkmData->getUser->foto_kk) }}" target="_blank">
                                                <img src="{{ url('/assets/images/kk/'.$umkmData->getUser->foto_kk) }}" class="img-fluid rounded border border-primary" alt="Foto KK" width="50%">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong>Data </strong> UMKM
                        </div>
                    </div>
                </div>       
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <p>Kanan</p>
                            <div class="col mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="jenis_umkm_id">Jenis UMKM</label>
                                    <div class="input-group">
                                        <select disabled  value="{{ old('jenis_umkm_id') ?? $umkmData->jenis_umkm_id }}" name="jenis_umkm_id" class="form-control @error('jenis_umkm_id') is-invalid @enderror" id="">
                                            <option value="">Pilih Jenis UMKM</option>  
                                            @foreach ($getJenis as $item)
                                                <option value="{{$item->id}}" {{ $umkmData->jenis_umkm_id == $item->id ? 'selected' : '' }}>{{$item->jenis_umkm}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                    </div>
                                    @error('jenis_umkm_id')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="kategori_umkm_id">Kategori UMKM</label>
                                    <div class="input-group">
                                        <select disabled  value="{{ old('kategori_umkm_id') ?? $umkmData->kategori_umkm_id }}" name="kategori_umkm_id" class="form-control @error('kategori_umkm_id') is-invalid @enderror" id="">
                                            <option value="">Pilih Kategori UMKM</option> 
                                            @foreach ($getKategori as $item)
                                                <option value="{{$item->id}}" {{ $umkmData->kategori_umkm_id == $item->id ? 'selected' : '' }}>{{$item->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                    </div>
                                    @error('kategori_umkm_id')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                    <input readonly value="{{ $umkmData->nama_usaha ?? old('nama_usaha') }}" type="text" name="nama_usaha" id="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" placeholder="Nama Usaha UMKM"/>
                                    @error('nama_usaha')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="telp">No Telp/Whatsapp</label>
                                    <input readonly value="{{ $umkmData->telp ?? old('telp') }}" type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="No Telp/whatsapp..." />
                                    @error('telp')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="alamat_usaha">Alamat Tempat Usaha</label>
                                    <input readonly value="{{ $umkmData->alamat_usaha ?? old('alamat_usaha') }}" type="text" name="alamat_usaha" id="alamat_usaha" class="form-control @error('alamat_usaha') is-invalid @enderror" placeholder="Alamat Tempat Usaha..." />
                                    @error('alamat_usaha')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusSedangDitinjau" value="Sedang Ditinjau" {{ (old('status') == 'Sedang Ditinjau' || $umkmData->status == 'Sedang Ditinjau') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusSedangDitinjau">
                                        Sedang Ditinjau
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusDisetujui" value="Disetujui" {{ (old('status') == 'Disetujui' || $umkmData->status == 'Disetujui') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusDisetujui">
                                        Disetujui
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="statusTidakDisetujui" value="Tidak Disetujui" {{ (old('status') == 'Tidak Disetujui' || $umkmData->status == 'Tidak Disetujui') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusTidakDisetujui">
                                        Tidak Disetujui
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col ">
                            <p>Kiri</p>
                            <div class="col-12 mb-4">
                                <div class="mb-4 text-center">
                                    <label class="form-label bg-primary p-1 rounded-4 w-50 text-center text-light" for="foto_umkm">Foto UMKM Saat Ini</label> <br>
                                    <a href="{{ url('/assets/images/umkm/'.$umkmData->foto_umkm) }}" target="_blank">
                                        <img src="{{ url('/assets/images/umkm/'.$umkmData->foto_umkm) }}" class="img-fluid rounded border border-primary" alt="Foto UMKM" width="50%">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Perbaharui Data <i class="bi bi-check-lg"></i></button>
                    @if ($umkmData->status == 'Sedang Ditinjau')
                        <a href="{{ url('/rt/ditinjau') }}" class="btn btn-danger btn-block">Cancel <i class="bi bi-x"></i></a>
                    @elseif($umkmData->status == 'Disetujui')
                        <a href="{{ url('/rt/disetujui') }}" class="btn btn-danger btn-block">Cancel <i class="bi bi-x"></i></a>    
                    @elseif($umkmData->status == 'Tidak Disetujui')
                        <a href="{{ url('/rt/tidak/disetujui') }}" class="btn btn-danger btn-block">Cancel <i class="bi bi-x"></i></a>    
                    @endif


                </div>
            </form>
    </div>
</div>
@endsection