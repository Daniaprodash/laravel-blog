@extends('master')
@section('title', __('messages.user_dashboard'))
<link rel="stylesheet" href="{{asset('assets/css/adminDashboardStyle.css')}}">
@section('content')
<div class="dashboard-page">
    <div class="container dashboard-container">
        <!-- رسالة الترحيب -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">
                        <i class="fas fa-hand-wave me-2" style="color: #667eea;"></i>
                        {{ __('messages.welcome_back', ['name' => Auth::user()->name]) }}
                    </h2>
                    <p class="text-muted mb-0">
                        {{ __('messages.dashboard_intro') }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="user-info">
                        <h5><i class="fas fa-user me-2"></i>{{ __('messages.account_info') }}</h5>
                        <p class="mb-1"><strong>{{ __('messages.email') }}:</strong> {{ Auth::user()->email }}</p>
                        <p class="mb-0"><strong>{{ __('messages.registered_at') }}:</strong> {{ Auth::user()->created_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- ادارة المقالة -->
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <div class="stats-icon text-primary">
                        <a href="{{route('auth.show_userArticle')}}">
                        <i class="fas fa-newspaper" ></i>
                        </a>
                    </div>
                    <h4 class="mb-2">{{$count_article}}</h4>
                    <p class="text-muted mb-0">{{ __('messages.manage_articles') }}</p>
                </div>
            </div>
            <!-- نشر مقالة -->
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <div class="stats-icon text-success">
                        <a href="{{route('auth.showPostPage')}}">
                        <i class="fas fa-plus text-warning"></i></a>
                    </div>
                    <h4 class="mb-2"></h4>
                    <p class="text-muted mb-0">{{ __('messages.publish_article') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
