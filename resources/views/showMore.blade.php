@extends('master')
@section('title', 'مقال - DASHBlog')
<link rel="stylesheet" href="{{ asset('assets/css/showMoreStyle.css') }}">
@section('content')
<div class="article-detail-container">
                @if(session('success'))
                    <div class="alert alert-success" style="margin-bottom: 1rem; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                       {{ session('success') }}
                    </div>
                @endif
    <div class="article-detail-card">
        <!-- صورة المقال -->
        <div class="article-detail-image">
            <img src="{{asset('images/' . $article->image)}}" alt="صورة المقال" class="detail-img">
            <div class="article-detail-overlay">
                <div class="article-detail-date">
                <i class="fas fa-calendar"></i>
                    <span>{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- محتوى المقال -->
        <div class="article-detail-content">

            <!-- عنوان المقال -->
            <div class="article-detail-header">
                <h1 class="article-detail-title">{{ $article->title ?? 'عنوان المقال' }}</h1>
                <div class="article-detail-meta">
                    <div class="article-detail-info">
                        <span class="publish-detail-date">
                            <i class="fas fa-arrow-clock"></i>
                            {{ $article->created_at->diffForHumans() }}
                        </span>
                        <span class="article-detail-author">
                            <i class="fas fa-user"></i>
                            {{ $article->user->name ?? 'مجهول' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- محتوى المقال الكامل -->
            <div class="article-detail-body">
                <div class="article-detail-text">
                    {!! nl2br($article->content ?? 'محتوى المقال') !!}
                </div>
            </div>

            <!-- أزرار التنقل -->
            <div class="article-detail-footer">
                
             <!-- عودة للمقالات -->
                <a href="{{ route('auth.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>العودة للمقالات</span>
                </a>

             <!-- اضاقة تعليق -->
                @if(auth()->check())
                 <form action="{{route('auth.postComment')}}" method="POST">
                    @csrf
                  <div class="comment-container">
                  
                   <input type="text" placeholder="أضف تعليقك" class="comment-input" name="content">
                   <input type="hidden" name="article_id" value="{{$article->id}}">
                   <input type="hidden" name="user_id" value="{{auth()->id()}}">
                   <button type="submit" class="comment-btn">إرسال</button>
                  </div>
                 </form>
                 @elseif(auth()->guest())
                 <span>يجب عليك تسجيل الدخول لإضافة التعليق!</span>
                 <a href="{{route('auth.login')}}" class="btn btn-primary">تسجيل الدخول</a>
                @endif                

                <!-- مشاركة المقال -->
                <div class="article-detail-actions">
                    <button class="share-btn" onclick="shareArticle()">
                        <i class="fas fa-share"></i>
                        <span>مشاركة</span>
                    </button>
                </div>
                
            </div>

            <!-- تعليقات المقال -->
            <div class="article-detail-comments">
                <h3>تعليقات المقال</h3>
                <div class="article-detail-comments-list">
                 @if($article->comments->isNotEmpty())
                    @foreach($article->comments as $comment)
                     <div class="article-detail-comment comment-item">
                        
                        <p class="comment-content">{{$comment->content}}</p>
                        <span class="comment-author">{{$comment->user->name}}</span>
                        <span class="comment-date">{{$comment->created_at->diffForHumans()}}</span>
                       
                     </div>
                    @endforeach
                    @else
                    <div class="article-detail-comment no-comments">
                        <p>لا توجد تعليقات</p>
                    </div>
                 @endif
            </div>

        </div>

    </div>
</div>
@endsection





@section('scripts')
  <!-- مشاركة المقال -->
  <script>
   function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $article->title }}',
            text: '{{ Str::limit($article->content, 100) }}',
            url: window.location.href
        });
    } else {
        // نسخ الرابط للحافظة
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('تم نسخ رابط المقال!');
        });
    }
   }
 </script>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 3000);
</script>

@endsection


