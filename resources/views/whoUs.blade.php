@extends('master')
@section('title', __('messages.about_title'))
<link rel="stylesheet" href="{{ asset('assets/css/whoUsStyle.css') }}">
@section('content')

<div class="article-detail-container">
    <div class="article-detail-card">
        <!-- صورة المقال -->
        <div class="article-detail-image">
            <img src="{{ asset('assets/images/img3.webp') }}" alt="{{ __('messages.who_image_alt') }}" class="detail-img">
            <div class="article-detail-overlay">
                <div class="article-detail-date">
                <i class="fas fa-calendar"></i>
                    <span>{{ __('messages.about_date') }}</span>
                </div>
            </div>
        </div>

        <!-- محتوى المقال -->
        <div class="article-detail-content">
            <!-- عنوان المقال -->
            <div class="article-detail-header">
                <h1 class="article-detail-title">{{ __('messages.about_heading') }}</h1>
                <div class="article-detail-meta">
                    <div class="article-detail-info">
                        <span class="publish-detail-date">
                            <i class="fas fa-arrow-clock"></i>
                            {{ __('messages.about_time') }}
                        </span>
                        <span class="article-detail-author">
                            <i class="fas fa-user"></i>
                            {{ __('messages.about_author', ['company' => 'ProDASH Company']) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- محتوى المقال الكامل -->
            <div class="article-detail-body">
                <div class="article-detail-text">
                    {!! nl2br(e(__('messages.about_text'))) !!}
                </div>
            </div>

            <!-- أزرار التنقل -->
            <div class="article-detail-footer">
                <a href="{{ route('auth.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>{{ __('messages.back_home') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
