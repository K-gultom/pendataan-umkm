@extends('layout.main-nav')

@section('title')
    Admin
@endsection

@section('content')

<style>
    /* .card{
        margin-bottom: 100px;
    } */
</style>

<div class="container-fluid ">
    <h4 class="mb-2">Edit Data Admin</h4>
    <nav aria-label="breadcrumb" class="mb-1">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Data Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Data Admin</li>
      </ol>
    </nav>
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <strong>Edit </strong> Data
            </div>
          </div>
        </div>
        
        <div class="card-body">
            @if(Session::has('message'))
              <div class="card alert alert-success">
                {{Session::get('message')}}
              </div>
            @endif
            
            <form action="" method="post">
                @csrf
                
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input value="{{old('name', $getData->name)}}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" />
                              @error('name')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                          <div class="input-group">
                            <select value="{{ old('jenis_kelamin') ?? '' }}" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="">
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="L" {{ old('jenis_kelamin',$getData->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                              <option value="P" {{ old('jenis_kelamin',$getData->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                            <label class="form-label" for="alamat">Alamat</label>
                            <input  value="{{old('alamat', $getData->alamat)}}" type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" />
                              @error('alamat')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="telp">No Telp/Whatsapp</label>
                            <input value="{{old('telp', $getData->telp)}}" type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" />
                              @error('telp')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                      <div class="form-outline">
                        <label class="form-label" for="email">Email</label>
                        <input readonly value="{{old('email', $getData->email)}}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Isi dengan Email Anda">
                        <h6 class="mt-2"><sup><i>*Email Tidak Dapat diubah</i></sup></h6>
                          @error('email')
                            <div class="invalid-feedback">
                              {{$message}}
                            </div>
                          @endif
                      </div>
                    </div>
                  </div>
  
                  <input type="text" name="level" value="admin" hidden>

                  <div class="d-flex">
                    <button type="submit" class="btn btn-primary mx-2">Edit Data <i class="bi bi-check-lg"></i></button>
                    <a href="{{ url('/admin') }}" class="btn btn-warning">Cancel <i class="bi bi-x"></i></a>
                </div>

            </form> 
        </div>
    </div>
</div>
@endsection