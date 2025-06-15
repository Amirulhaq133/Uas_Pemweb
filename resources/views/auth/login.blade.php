@extends('layouts.auth')

@section('title', 'Login')
@section('body-class', 'login-page')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Laravel</b>News</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="{{ route('social.redirect', 'github') }}" class="btn btn-block btn-dark">
                    <i class="fab fa-github mr-2"></i> Sign in using GitHub
                </a>
                <a href="{{ route('social.redirect', 'google') }}" class="btn btn-block btn-danger">
                    <i class="fab fa-google mr-2"></i> Sign in using Google
                </a>
                <a href="{{ route('social.redirect', 'microsoft') }}" class="btn btn-block btn-info">
                    <i class="fab fa-microsoft mr-2"></i> Sign in using Microsoft
                </a>
            </div>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Daftar akun baru</a>
            </p>
        </div>
    </div>
</div>
@endsection