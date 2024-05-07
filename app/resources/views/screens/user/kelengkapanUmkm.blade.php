@extends('layout.main-nav')

@section('title')
    Kelengkapan
@endsection

@section('content')

<style>
    /* .card{
        margin-bottom: 100px;
    } */
</style>

<div class="container-fluid ">
    <h4 class="mb-2">Kelengkapan</h4>
    <nav aria-label="breadcrumb" class="mb-1">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Form Kelengkapan Data</li>
      </ol>
    </nav>
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <strong>Data  </strong> Pribadi
            </div>
          </div>
        </div>
        
        <div class="card-body">
            @if(Session::has('message'))
              <div class="card alert alert-success">
                {{Session::get('message')}}
              </div>
            @endif
            
            <form action="{{ url('/kelengkapan') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input value="{{old('name')}}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pemilik Usaha"/>
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endif
                        </div>
                    </div>
                    {{-- <input value="{{old('user_id')}}" type="text" name="user_id" class="form-control"  value="{{ $getUser->id}}"/> --}}
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
                            <input type="number" value="{{old('nik')}}" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor induk kependudukan"/>
                            @error('nik')
                                <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="rt_id">RT</label>
                            <div class="input-group">
                                <select  value="{{old('rt_id')}}" name="rt_id" class="form-control @error('rt_id') is-invalid @enderror" id="">
                                    <option value="">Pilih RT</option> 
                                    @foreach ($getRt as $item)
                                        <option value="{{$item->id}}">{{$item->wilayah_rt}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                            </div>
                            @error('rt_id')
                                <div class="invalid-feedback">
                                {{$message}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="alamat_pemilik">Alamat</label>
                            <input  value="{{old('alamat_pemilik')}}" type="text" name="alamat_pemilik" id="alamat_pemilik" class="form-control @error('alamat_pemilik') is-invalid @enderror" placeholder="Alamat..." />
                              @error('alamat_pemilik')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>

                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong>Data </strong> Usaha
                        </div>
                    </div>
                </div>       
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="kategori_umkm_id">Kategori UMKM</label>
                                <div class="input-group">
                                    <select  value="{{old('kategori_umkm_id')}}" name="kategori_umkm_id" class="form-control @error('kategori_umkm_id') is-invalid @enderror" id="">
                                        <option value="">Pilih Kategori UMKM</option> 
                                        @foreach ($getKategori as $item)
                                            <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
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
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="jenis_umkm_id">Jenis UMKM</label>
                                <div class="input-group">
                                    <select  value="{{old('jenis_umkm_id')}}" name="jenis_umkm_id" class="form-control @error('jenis_umkm_id') is-invalid @enderror" id="">
                                        <option value="">Pilih Jenis UMKM</option>  
                                        @foreach ($getJenis as $item)
                                            <option value="{{$item->id}}">{{$item->jenis_umkm}}</option>
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
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                <input value="{{old('nama_usaha')}}" type="text" name="nama_usaha" id="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" placeholder="Nama Usaha UMKM"/>
                                @error('nama_usaha')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @endif
                            </div>
                        </div>
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
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="alamat_usaha">Alamat Tempat Usaha</label>
                                <input  value="{{old('alamat_usaha')}}" type="text" name="alamat_usaha" id="alamat_usaha" class="form-control @error('alamat_usaha') is-invalid @enderror" placeholder="Alamat Tempat Usaha..." />
                                @error('alamat_usaha')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <input type="radio" name="status" id="" value="tidak" hidden> --}}

                    <button type="submit" class="btn btn-primary btn-block">save</button>

                    <button type="reset" class="btn btn-warning btn-block">Reset</button>
                </div>
            </form>
        </div>

                {{-- </div> --}}
    </div>
</div>
@endsection