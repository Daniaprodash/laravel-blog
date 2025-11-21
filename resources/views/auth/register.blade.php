@extends('master')
@section('title', __('messages.register'))
<link rel="stylesheet" href="{{asset('assets/css/registerStyle.css')}}">
@section('content')
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2><i class="fas fa-user-plus mb-3" style="font-size: 3rem; color: #12372A;"></i></h2>
                <h2>{{ __('messages.create_account') }}</h2>
                <p>{{ __('messages.fill_details') }}</p>
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

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="{{ __('messages.name') }}" 
                           value="{{ old('name') }}" required>
                    <label for="name">{{ __('messages.name') }}</label>
                </div>

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
                    <div class="password-requirements">
                        {{ __('messages.password_requirements') }}
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="{{ __('messages.confirm_password') }}" required>
                    <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                </div>

                <button type="submit" class="btn btn-primary btn-register">
                    {{ __('messages.register') }}
                    <i class="fas fa-user-plus me-2"></i>
                </button>
            </form>

            <div class="login-link">
                <p class="mb-0">{{ __('messages.have_account') }}
                    <a href="{{ route('auth.login') }}">{{ __('messages.login') }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
