@extends('master')
@section('title', __('messages.welcome'))
<link rel="stylesheet" href="{{asset('assets/css/welcomeStyle.css')}}">
@section('content')
    <div class="hero-container">
        <div class="hero-card">
            <div class="mb-4">
                <i class="fas fa-blog" style="font-size: 4rem; color: #12372A;"></i>
            </div>
            
            <h1 class="hero-title">{{ __('messages.hero_title') }}</h1>
            <p class="hero-subtitle">
                {{ __('messages.hero_subtitle') }}
            </p>

            @auth
                <div class="mb-3">
                    <p class="text-success mb-3">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ __('messages.already_logged_in', ['name' => Auth::user()->name]) }}
                    </p>
                    @if(Auth::user()->role==='admin')
                    <a href="{{ route('auth.dashboard') }}" class="btn-hero">
                        {{ __('messages.go_to_dashboard') }}
                        <i class="fas fa-dashboard me-2"></i>
                    </a>
                    @else
                    <a href="{{ route('auth.index') }}" class="btn-hero">
                        {{ __('messages.go_to_dashboard') }}
                        <i class="fas fa-dashboard me-2"></i>
                    </a>
                    @endif
                </div>
            @else
                <div class="mb-4">
                    <a href="{{ route('auth.login') }}" class="btn-hero">
                        {{ __('messages.login') }}
                        <i class="fas fa-sign-in-alt me-2"></i>
                    </a>
                    <a href="{{ route('auth.register') }}" class="btn-hero btn-outline">
                        {{ __('messages.register') }}
                        <i class="fas fa-user-plus me-2"></i>
                    </a>
                </div>
            @endauth

            <div class="features">
                <h5 class="mb-3">{{ __('messages.features_title') }}</h5>
                <div class="feature-item">
                    <span>{{ __('messages.feature_security') }}</span>
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="feature-item">
                    <span>{{ __('messages.feature_database') }}</span>
                    <i class="fas fa-database"></i>
                </div>
                <div class="feature-item">
                    <span>{{ __('messages.feature_responsive') }}</span>
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="feature-item">
                    <span>{{ __('messages.feature_ui') }}</span> 
                    <i class="fas fa-palette"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
