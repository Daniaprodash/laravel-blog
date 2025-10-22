@extends('master')
@section('title', 'إدارة المقالات - DASHBlog')
<link rel="stylesheet" href="{{asset('assets/css/articleManageStyle.css')}}">
@section('content')

<div class="admin-articles-container">

    <div class="admin-header">
        <h1 class="admin-title">
            <i class="fas fa-newspaper"></i>
            إدارة المقالات
        </h1>
        <div class="admin-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $article->count() }}</span>
                <span class="stat-label">إجمالي المقالات</span>
            </div>
        </div>
    </div>

    <div class="articles-grid">
      @forelse ($article as $item)
            <!-- عنوان المقال -->
        <div class="article-content-section">
           

            <div class="article-actions">
                     <h3 class="article-admin-title">{{ $item->title }}</h3>
                     <a href="{{ route('auth.showMore', $item->id) }}" class="action-btn view-btn" title="عرض">
                     <i class="fas fa-eye"></i>
                     </a>
    
                     <a href="{{route('auth.editArticle', $item->id)}}" class="action-btn edit-btn" title="تعديل">
                     <i class="fas fa-edit"></i>
                     </a>

                     <form action="{{route('auth.deleteArticle' , $item->id)}}" method="POST" class="delete-form"
                         onsubmit="return confirm('هل أنت متأكد من حذف هذه المقالة؟');">
                         @csrf
                         <button type="submit" class="action-btn delete-btn" title="حذف">
                         <i class="fas fa-trash"></i>
                         </button>
                     </form>
            </div>
        </div>

        @empty
          <div class="no-articles">
            <div class="no-articles-content">
                <i class="fas fa-newspaper"></i>
                <h3>لا توجد مقالات</h3>
                <p>لم يتم إنشاء أي مقالات بعد</p>
                <a href="{{route('auth.showPostPage')}}" class="create-article-btn">
                    <i class="fas fa-plus"></i>
                    إنشاء مقال جديد
                </a>
            </div>
          </div>
       

      @endforelse
    </div>
</div>

@endsection