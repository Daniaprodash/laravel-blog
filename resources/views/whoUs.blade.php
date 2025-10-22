@extends('master')
@section('title', 'مقال - DASHBlog')
<link rel="stylesheet" href="{{ asset('assets/css/whoUsStyle.css') }}">
@section('content')

<div class="article-detail-container">
    <div class="article-detail-card">
        <!-- صورة المقال -->
        <div class="article-detail-image">
            <img src="{{ asset('assets/images/img3.webp') }}" alt="صورة المقال" class="detail-img">
            <div class="article-detail-overlay">
                <div class="article-detail-date">
                <i class="fas fa-calendar"></i>
                    <span>1/9/2025</span>
                </div>
            </div>
        </div>

        <!-- محتوى المقال -->
        <div class="article-detail-content">
            <!-- عنوان المقال -->
            <div class="article-detail-header">
                <h1 class="article-detail-title">من نحن؟</h1>
                <div class="article-detail-meta">
                    <div class="article-detail-info">
                        <span class="publish-detail-date">
                            <i class="fas fa-arrow-clock"></i>
                            11:11
                        </span>
                        <span class="article-detail-author">
                            <i class="fas fa-user"></i>
                            By: ProDASH Company
                        </span>
                    </div>
                </div>
            </div>

            <!-- محتوى المقال الكامل -->
            <div class="article-detail-body">
                <div class="article-detail-text">
                "
        نحن مجموعة من عشاق الكتابة والمعرفة، اجتمعنا لنقدم محتوى عربيًا غنيًا، موثوقًا، وممتعًا في مجالات الثقافة، التقنية، والتطوير الذاتي
 انطلقت مدونتنا من شغفنا بمشاركة الأفكار التي تصنع فرقًا، وتقديم مقالات تساعد القارئ على فهم العالم من حوله بطريقة أعمق وأكثر وعيًا.
 نؤمن بأن الكلمة الصادقة قادرة على الإلهام والتغيير، ولهذا نحرص على تقديم محتوى مدروس، بعيدًا عن الضجيج، قريبًا من العقل والقلب.
 نرحب بك في عالمنا، ونسعد بتواصلك، آرائك، واقتراحاتك التي تثري تجربتنا وتدفعنا للأفضل"
                </div>
            </div>

            <!-- أزرار التنقل -->
            <div class="article-detail-footer">
                <a href="{{ route('auth.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>العودة للصفحة الرئيسية</span>
                </a>
               
                
            </div>
        </div>
    </div>
</div>

@endsection