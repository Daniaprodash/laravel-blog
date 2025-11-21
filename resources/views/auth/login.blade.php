@extends('master')
@section('title', __('messages.login'))
<link rel="stylesheet" href="{{asset('assets/css/loginStyle.css')}}">
@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2><i class="fas fa-user-circle mb-3" style="font-size: 3rem; color: #12372A;"></i></h2>
                <h2>{{ __('messages.login') }}</h2>
                <p>{{ __('messages.enter_credentials') }}</p>
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
                           id="email" name="email" placeholder="{{ __('messages.email') }}" 
                           value="{{ old('email') }}" required>
                    <label for="email">{{ __('messages.email') }}</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                    <label for="password">{{ __('messages.password') }}</label>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    {{ __('messages.login') }}
                    <i class="fas fa-sign-in-alt me-2"></i>
                </button>
            </form>

            <div class="register-link">
                <p class="mb-0">{{ __('messages.no_account') }}
                    <a href="{{ route('auth.register') }}">{{ __('messages.register') }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
