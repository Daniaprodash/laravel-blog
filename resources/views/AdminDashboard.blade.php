@extends('master')
@section('title', __('messages.dashboard'))
<link rel="stylesheet" href="{{asset('assets/css/adminDashboardStyle.css')}}">
@section('content')<div class="dashboard-page">
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

        <!-- إحصائيات -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <div class="stats-icon text-primary">
                     <i class="fas fa-newspaper" ></i>
                    </div>
                    <h4 class="mb-2">{{$count}}</h4>
                    <a href="{{route('auth.article')}}">
                    <p class="text-muted mb-0">{{ __('messages.manage_articles') }}</p></a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <div class="stats-icon text-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="mb-2">{{$count_users}}</h4>
                    <a href="{{route('auth.showUser')}}">
                    <p class="text-muted mb-0">{{ __('messages.manage_users') }}</p></a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <div class="stats-icon text-warning">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h4 class="mb-2">{{$article_user}}</h4>
                    <a href="{{route('auth.showPostPage')}}">
                    <p class="text-muted mb-0">{{ __('messages.publish_article') }}</p></a>
                </div>
            </div>
        </div>

        <!-- محتوى إضافي -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="welcome-card">
                    <h5><i class="fas fa-bell me-2"></i>{{ __('messages.latest_notifications') }}</h5>
                    <p class="text-muted">{{ __('messages.no_notifications') }}</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
    <div class="welcome-card">
        <h5><i class="fas fa-tasks me-2"></i>{{ __('messages.latest_activities') }}</h5>

        @forelse($activities as $activity)
            <p>
                <i class="fas fa-history me-1 text-primary"></i>
                {{ $activity->description }}
                <br>
                <small class="text-muted">{{ $activity->user->name }}</small>
                <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>

            </p>
        @empty
            <p class="text-muted">{{ __('messages.no_recent_activities') }}</p>
        @endforelse
    </div>
</div>
        </div>
    </div>
 </div>
@endsection
