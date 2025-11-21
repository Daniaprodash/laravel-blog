@extends('master')
@section('title', __('messages.update_article'))
<link rel="stylesheet" href="{{asset('assets/css/updateArticleStyle.css')}}">
@section('content')
<div class="update-article-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="update-form-wrapper">
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-edit"></i>
                {{ __('messages.update_article') }}
            </h1>
            <p class="form-subtitle">{{ __('messages.edit_article_subtitle') }}</p>
        </div>

        <form class="update-form" action="{{ route('auth.updateArticle', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">
                    <i class="fas fa-heading"></i>
                    {{ __('messages.article_title') }}
                </label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" placeholder="{{ __('messages.enter_article_title') }}" required>
            </div>

            <div class="form-group">
                <label for="content">
                    <i class="fas fa-file-alt"></i>
                    {{ __('messages.article_content') }}
                </label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="{{ __('messages.article_content_placeholder') }}">{{ strip_tags($article->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="Categori">
                    <i class="fas fa-tag"></i>
                    {{ __('messages.category') }}
                </label>
                <select class="form-select" id="Categori" name="Categori" required>
                    <option value="تقني" {{ $article->Categori == 'تقني' ? 'selected' : '' }}>{{ __('messages.category_tech') }}</option>
                    <option value="ثقافي" {{ $article->Categori == 'ثقافي' ? 'selected' : '' }}>{{ __('messages.category_cultural') }}</option>
                    <option value="اجتماعي" {{ $article->Categori == 'اجتماعي' ? 'selected' : '' }}>{{ __('messages.category_social') }}</option>
                    <option value="رياضي" {{ $article->Categori == 'رياضي' ? 'selected' : '' }}>{{ __('messages.category_sports') }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="images">
                    <i class="fas fa-image"></i>
                    {{ __('messages.article_image') }}
                </label>
                <div class="image-upload-wrapper">
                    @if($article->image)
                    <div class="current-image">
                        <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}">
                        <span class="current-image-label">{{ __('messages.current_image') }}</span>
                    </div>
                    @endif
                    <input type="file" class="form-control file-input" id="images" name="images" accept="image/*">
                    <small class="file-hint">
                        <i class="fas fa-info-circle"></i>
                        {{ __('messages.file_hint_keep_current') }}
                    </small>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ __('messages.save_changes') }}
                </button>
                @auth 
                    @if(Auth::user()->role==='admin')
                        <a href="{{ route('auth.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            {{ __('messages.cancel') }}
                        </a>
                    @else
                        <a href="{{route('auth.userDashboard')}}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            {{ __('messages.cancel') }}
                        </a>
                    @endif
                @endauth
            </div>
        </form>
    </div>
</div>

<!-- محرر النصوص -->
<script>
  ClassicEditor
    .create(document.querySelector('#content'), {
      language: 'ar',
      toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
    })
    .catch(error => {
      console.error(error);
    });
</script>
@endsection
