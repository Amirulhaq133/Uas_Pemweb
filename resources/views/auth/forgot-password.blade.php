@extends('layouts.auth')

@section('title', 'Lupa Password')
@section('body-class', 'login-page')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Laravel</b>News</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Masukkan email untuk reset password</p>

            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <p class="mb-0">
                            <a href="{{ route('login') }}">Kembali ke login</a>
                        </p>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Send Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection