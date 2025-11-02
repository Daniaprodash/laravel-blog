@extends('master')
@section('title', 'تعديل المقالة - DASHBlog')
<link rel="stylesheet" href="{{asset('assets/css/postArticleStyle.css')}}">
@section('content')
<div class="container mt-5">
  @if(session('success'))
                    <div class="alert alert-success" style="margin-bottom: 1rem; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                       {{ session('success') }}
                    </div>
                 @endif
  <h2 class="mb-4 fw-bold text-center tit">نشر مقالة جديدة</h2>

  <form action="{{route('auth.postArticle')}}" method="POST" enctype="multipart/form-data">
     @csrf

     <!-- عنوان المقالة -->
     <div class="mb-3">
      <label for="title" class="form-label">عنوان المقالة</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="أدخل عنوان المقالة" required>
     </div>

     <!-- محتوى المقالة -->
     <div class="mb-3">
      <label for="content" class="form-label">محتوى المقالة</label>
      <textarea class="form-control" id="content" name="content" rows="6" placeholder="اكتب المحتوى هنا..." ></textarea>
     </div>

     <!-- تصنيف المقالة -->
     <div class="mb-3">
      <label for="Categori" class="form-label">التصنيف</label>
      <select class="form-select" id="Categori" name="Categori" required>
        <option value="" disabled selected>اختر التصنيف</option>
        <option value="تقني">تقني</option>
        <option value="ثقافي">ثقافي</option>
        <option value="اجتماعي">اجتماعي</option>
        <option value="رياضي">رياضي</option>
      </select>
     </div>
     <!-- صورة المقالة -->
      <div class="mb-3">
      <label for="images" class="form-label">اختر صورة</label>
      <input type="file" class="form-control" id="images" name="images" accept="image/*">
      </div>
      <!-- زر النشر -->
      <button type="submit" class="btn btn-success">نشر المقالة</button>
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
