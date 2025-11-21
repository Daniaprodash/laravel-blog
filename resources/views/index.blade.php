@extends('master')
@section('title', 'DASHBlog')
<link rel="stylesheet" href="assets/css/indexStyle.css">
@section('content')
<a href="{{ url('lang/en') }}">{{ __('messages.english') }}</a> |
<a href="{{ url('lang/ar') }}">{{ __('messages.arabic') }}</a>
  @foreach ($articles as $article)
  <div class="article-card">
    <div class="article-image">
        <img src="{{asset('images/' . $article->image)}}" alt="{{ __('messages.article_image_alt') }}" class="article-img">
        <div class="article-overlay">
            <div class="article-date">
                <i class="fas fa-calendar"></i>
                <span>{{ $article->created_at->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    
    <div class="article-content">
        <div class="article-header">
            <h3 class="article-title">{{ $article->title ?? __('messages.article_title_default') }}</h3>
            <div class="article-meta">
                <span class="publish-date">
                <i class="fas fa-arrow-clock"></i>
                    {{ $article->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
        
        <p class="article-excerpt">
            {!! Str::limit($article->content ?? __('messages.article_content_default'), 150, '...') !!}
        </p>
        
        <div class="article-footer">
            <a href="{{ route('auth.showMore', $article->id) }}" class="read-more-btn">
                <span>{{ __('messages.read_more') }}</span>
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
    
    <!-- اسم المستخدم الناشر -->
    <div class="article-author">
        <div class="author-info">
            <i class="fas fa-user"></i>
            <span class="author-name">{{ $article->user->name ?? __('messages.unknown') }}</span>
        </div>
    </div>
  </div>
  @endforeach


@endsection
