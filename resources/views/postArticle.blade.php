@extends('master')
@section('title', __('messages.post_article_title'))
<link rel="stylesheet" href="{{asset('assets/css/postArticleStyle.css')}}">
@section('content')
<div class="container mt-5">
  @if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 1rem; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
       {{ session('success') }}
    </div>
  @endif

  <h2 class="mb-4 fw-bold text-center tit">{{ __('messages.post_article_heading') }}</h2>

  <form action="{{route('auth.postArticle')}}" method="POST" enctype="multipart/form-data">
     @csrf

     <!-- عنوان المقالة -->
     <div class="mb-3">
      <label for="title" class="form-label">{{ __('messages.article_title') }}</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('messages.enter_article_title') }}" required>
     </div>

     <!-- محتوى المقالة -->
     <div class="mb-3">
      <label for="content" class="form-label">{{ __('messages.article_content') }}</label>
      <textarea class="form-control" id="content" name="content" rows="6" placeholder="{{ __('messages.article_content_placeholder') }}" ></textarea>
     </div>

     <!-- تصنيف المقالة -->
     <div class="mb-3">
      <label for="Categori" class="form-label">{{ __('messages.category') }}</label>
      <select class="form-select" id="Categori" name="Categori" required>
        <option value="" disabled selected>{{ __('messages.select_category') }}</option>
        <option value="تقني">{{ __('messages.category_tech') }}</option>
        <option value="ثقافي">{{ __('messages.category_cultural') }}</option>
        <option value="اجتماعي">{{ __('messages.category_social') }}</option>
        <option value="رياضي">{{ __('messages.category_sports') }}</option>
      </select>
     </div>

     <!-- صورة المقالة -->
      <div class="mb-3">
      <label for="images" class="form-label">{{ __('messages.choose_image') }}</label>
      <input type="file" class="form-control" id="images" name="images" accept="image/*">
      </div>

      <!-- زر النشر -->
      <button type="submit" class="btn btn-success">{{ __('messages.post_article_button') }}</button>
  </form>
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
