@extends('auth.main-login')
@section('title')
    Login
@endsection

@section('content')
<div class="container">
    <div class="form-box">
        <div class="row">
            <div class="col text-center">
                <p class="title">Login Sebagai?</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ url('/login') }}" class="button">UMKM</a>
            </div>
            
            <div class="col">
                <a href="{{ url('/login-pegawai') }}" class="button">Pegawai</a>
            </div>
        </div>
    </div>
</div>

<style>
    .container{
        margin-left: 80px;
        padding: 10%;
    }
    .form-box {
        padding: 50px;
        max-width: 300px;
        background: #f1f7fe;
        overflow: hidden;
        border-radius: 16px;
        color: #010101;
    }

    .form {
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 32px 24px 24px;
        gap: 16px;
        text-align: center;
    }

    /*Form text*/
    .title {
        font-weight: bold;
        font-size: 1.6rem;
    }

    /*Button*/
    .button {
        
        background-color: #0066ff;
        color: #fff;
        border: 0;
        border-radius: 24px;
        padding: 10px 16px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .3s ease;
    }

    .button:hover {
        background-color: #005ce6;
    }
</style>
@endsection