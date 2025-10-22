@extends('master')
@section('title', 'Register')
<link rel="stylesheet" href="{{asset('assets/css/registerStyle.css')}}">
@section('content')
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2><i class="fas fa-user-plus mb-3" style="font-size: 3rem; color: #12372A;"></i></h2>
                <h2>إنشاء حساب جديد</h2>
                <p>قم بتعبئة بياناتك لإنشاء الحساب</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="full Name" 
                           value="{{ old('name') }}" required>
                    <label for="name">full Name</label>
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Email" 
                           value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    <div class="password-requirements">
                    يجب أن تحتوب كلمة السر على أكثر من 6 محارف
                        <i class="fas fa-info-circle"></i>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Confirm Password" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>

                <button type="submit" class="btn btn-primary btn-register">
                    إنشاء حساب
                    <i class="fas fa-user-plus me-2"></i>
                </button>
            </form>

            <div class="login-link">
                <p class="mb-0">لديك حساب بالفعل؟ 
                    <a href="{{ route('auth.login') }}">تسجيل الدخول</a>
                </p>
            </div>
        </div>
    </div>
@endsection