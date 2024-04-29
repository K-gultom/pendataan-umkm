@extends('auth.main-login')
@section('title')
    Login
@endsection

@section('content')
<div class="container">
    <div class="form-box">
        <form class="form" method="POST" action="{{ url('/') }}">
            @csrf
            <span class="title">Login</span>
            {{-- <span class="subtitle">Silahkan Login Menggunakan Email dan Password yang telah Anda daftar</span>  --}}
            <div class="form-container">
                <input type="email" name="email" class="input" placeholder="Email">
                <input type="password" name="password" class="input" placeholder="Password">
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="form-section">
          <p>Belum Punya Akun? <a href="{{ url('/register') }}">Register</a> </p>
        </div>
    </div>
</div>

<style>
    .container{
        margin-left: 80px;
        padding: 10%;
    }
    .form-box {
        padding: 20px;
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

    .subtitle {
        font-size: 1rem;
        color: #666;
    }

    /*Inputs box*/
    .form-container {
        overflow: hidden;
        border-radius: 8px;
        background-color: #fff;
        margin: 1rem 0 .5rem;
        width: 100%;
    }

    .input {
        background: none;
        border: 0;
        outline: 0;
        height: 40px;
        width: 100%;
        border-bottom: 1px solid #eee;
        font-size: .9rem;
        padding: 8px 15px;
    }

    .form-section {
        padding: 16px;
        font-size: .85rem;
        background-color: #e0ecfb;
        box-shadow: rgb(0 0 0 / 8%) 0 -1px;
    }

    .form-section a {
        font-weight: bold;
        color: #0066ff;
        transition: color .3s ease;
    }

    .form-section a:hover {
        color: #005ce6;
        text-decoration: underline;
    }

    /*Button*/
    .form button {
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

    .form button:hover {
        background-color: #005ce6;
    }
</style>
@endsection