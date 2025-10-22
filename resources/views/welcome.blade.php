@extends('master')
@section('title', 'Welcome')
<link rel="stylesheet" href="{{asset('assets/css/welcomeStyle.css')}}">
@section('content')
    <div class="hero-container">
        <div class="hero-card">
            <div class="mb-4">
                <i class="fas fa-blog" style="font-size: 4rem; color: #12372A;"></i>
            </div>
            
            <h1 class="hero-title">أهلا بك في مدونتنا</h1>
            <p class="hero-subtitle">
                نحن هنا لمساعدتك في مشاركة أفكارك وخبراتك في أي مجال أنت تحبه لكي يصل لأكبر عدد من الناس
          </p>

            @auth
                <div class="mb-3">
                    <p class="text-success mb-3">
                        <i class="fas fa-check-circle me-2"></i>
                        أنت قمت بتسجيل الدخول بالفعل!، {{ Auth::user()->name }}
                    </p>
                    @if(Auth::user()->role==='admin')
                    <a href="{{ route('auth.dashboard') }}" class="btn-hero">
                        الذهاب إلى لوحة التحكم
                        <i class="fas fa-dashboard me-2"></i>
                    </a>
                    @else
                    <a href="{{ route('auth.index') }}" class="btn-hero">
                        الذهاب إلى لوحة التحكم
                        <i class="fas fa-dashboard me-2"></i>
                    </a>
                    @endif
                </div>
            @else
                <div class="mb-4">
                    <a href="{{ route('auth.login') }}" class="btn-hero">
                        تسجيل دخول
                        <i class="fas fa-sign-in-alt me-2"></i>
                    </a>
                    <a href="{{ route('auth.register') }}" class="btn-hero btn-outline">
                        إنشاء حساب
                        <i class="fas fa-user-plus me-2"></i>

                    </a>
                </div>
            @endauth

            <div class="features">
                <h5 class="mb-3">ميزات مدونتنا</h5>
                <div class="feature-item">
                <span>توثيق عالي الآمان</span>
                    <i class="fas fa-shield-alt"></i>
                    
                </div>
                <div class="feature-item">
                <span>قاعدة بيانات قوية</span>
                    <i class="fas fa-database"></i>
                  
                </div>
                <div class="feature-item">
                <span>التأقلم مع حجم شاشتك</span>
                    <i class="fas fa-mobile-alt"></i>
                  
                </div>
                <div class="feature-item">
                <span>واجهة  سهلة الاستخدام</span> 
                    <i class="fas fa-palette"></i>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
