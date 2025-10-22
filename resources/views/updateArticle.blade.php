@extends('master')
@section('title', 'تعديل المقالة - DASHBlog')
<link rel="stylesheet" href="{{asset('assets/css/updateArticleStyle.css')}}">
@section('content')
<form class="update_form" action="{{ route('auth.updateArticle', $article->id) }}" method="POST">
    @csrf
   
    <div class="form-group">
        <label for="title">عنوان المقالة</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
    </div>

    <div class="form-group">
        <label for="content">محتوى المقالة</label>
        <textarea class="form-control" id="content" name="content">{{ $article->content }}</textarea>
    </div>

    <div class="update-article-footer">
        <button type="submit" class="btn btn-primary">تعديل</button>
        @auth 
         @if(Auth::user()->role==='admin')
          <a href="{{ route('auth.dashboard') }}" class="btn btn-secondary">الغاء</a>
         @else
          <a href="{{route('auth.userDashboard')}}" class="btn btn-secondary">الغاء</a>
         @endif
        @endauth
    </div>
</form>
@endsection