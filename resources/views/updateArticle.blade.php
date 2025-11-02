@extends('master')
@section('title', 'تعديل المقالة - DASHBlog')
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
                تعديل المقالة
            </h1>
            <p class="form-subtitle">قم بتعديل محتوى مقالتك</p>
        </div>

        <form class="update-form" action="{{ route('auth.updateArticle', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title">
                    <i class="fas fa-heading"></i>
                    عنوان المقالة
                </label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" placeholder="أدخل عنوان المقالة" required>
            </div>

            <div class="form-group">
                <label for="content">
                    <i class="fas fa-file-alt"></i>
                    محتوى المقالة
                </label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="اكتب محتوى المقالة هنا...">{{ strip_tags($article->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="Categori">
                    <i class="fas fa-tag"></i>
                    التصنيف
                </label>
                <select class="form-select" id="Categori" name="Categori" required>
                    <option value="تقني" {{ $article->Categori == 'تقني' ? 'selected' : '' }}>تقني</option>
                    <option value="ثقافي" {{ $article->Categori == 'ثقافي' ? 'selected' : '' }}>ثقافي</option>
                    <option value="اجتماعي" {{ $article->Categori == 'اجتماعي' ? 'selected' : '' }}>اجتماعي</option>
                    <option value="رياضي" {{ $article->Categori == 'رياضي' ? 'selected' : '' }}>رياضي</option>
                </select>
            </div>

            <div class="form-group">
                <label for="images">
                    <i class="fas fa-image"></i>
                    صورة المقالة
                </label>
                <div class="image-upload-wrapper">
                    @if($article->image)
                    <div class="current-image">
                        <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}">
                        <span class="current-image-label">الصورة الحالية</span>
                    </div>
                    @endif
                    <input type="file" class="form-control file-input" id="images" name="images" accept="image/*">
                    <small class="file-hint">
                        <i class="fas fa-info-circle"></i>
                        يمكنك ترك هذا الحقل فارغاً للاحتفاظ بالصورة الحالية
                    </small>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    حفظ التغييرات
                </button>
                @auth 
                    @if(Auth::user()->role==='admin')
                        <a href="{{ route('auth.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            إلغاء
                        </a>
                    @else
                        <a href="{{route('auth.userDashboard')}}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            إلغاء
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