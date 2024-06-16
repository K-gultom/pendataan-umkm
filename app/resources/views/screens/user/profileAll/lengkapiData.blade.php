@extends('layout.main-nav')

@section('title')
    Kelengkapan Data
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Kelengkapan Data</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/umkm/profile')}}" class="text-decoration-none">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelengkapan Data </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                         <strong>Form</strong> Kelengkapan Data Diri
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
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
                                        <div class="form-group mb-4">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" value="{{old('tempat_lahir')}}" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Tempat Lahir...">
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-4">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" id="tgl_lahir" value="{{old('tgl_lahir')}}" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir">
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
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
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                            <div class="input-group">
                                              <select value="{{ old('jenis_kelamin') ?? '' }}" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                              </select>
                                              <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                            </div>
                                            @error('jenis_kelamin')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="kewarganegaraan">Kewarganegaraan</label>
                                            <div class="input-group">
                                            <select value="{{ old('kewarganegaraan') ?? '' }}" name="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror" id="">
                                                <option value=""></option>
                                                <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                                <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                            </select>
                                            <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                            </div>
                                            @error('kewarganegaraan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="agama">Agama</label>
                                            <div class="input-group">
                                            <select value="{{ old('agama') ?? '' }}" name="agama" class="form-control @error('agama') is-invalid @enderror" id="">
                                                <option value=""></option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Khatolik" {{ old('agama') == 'Khatolik' ? 'selected' : '' }}>Khatolik</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Agama_Kepercayaan" {{ old('agama') == 'Agama_Kepercayaan' ? 'selected' : '' }}>Agama Kepercayaan</option>
                                            </select>
                                            <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                            </div>
                                            @error('agama')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="foto_ktp">Foto KTP</label>
                                    <input value="{{old('foto_ktp')}}" type="file" name="foto_ktp" id="foto_ktp" class="form-control @error('foto_ktp') is-invalid @enderror">
                                    <p class="mt-1"><sup><i>Dokumen yang diupload harus dalam bentuk JPEG, JPG, PNG</i></sup></p>
                                    @error('foto_ktp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="foto_kk">Foto Kartu Keluarga</label>
                                    <input value="{{old('foto_kk')}}" type="file" name="foto_kk" id="foto_kk" class="form-control @error('foto_kk') is-invalid @enderror">
                                    <p class="mt-1"><sup><i>Dokumen yang diupload harus dalam bentuk JPEG, JPG, PNG</i></sup></p>
                                    @error('foto_kk')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
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