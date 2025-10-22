@extends('master')
@section('title', 'Login')
<link rel="stylesheet" href="{{asset('assets/css/loginStyle.css')}}">
@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-user-circle mb-3" style="font-size: 3rem; color: #12372A;"></i></h2>
                <h2>تسجيل الدخول</h2>
                <p>أدخل حسابك الالكتروني وكلمة السر</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Email" 
                           value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="password" required>
                    <label for="password">password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    تسجيل الدخول
                    <i class="fas fa-sign-in-alt me-2"></i>
                  
                </button>
            </form>

            <div class="register-link">
                <p class="mb-0">ألا تملك حساب؟
                    <a href="{{ route('auth.register') }}">إنشاء حساب</a>
                </p>
            </div>
        </div>
    </div>
@endsection