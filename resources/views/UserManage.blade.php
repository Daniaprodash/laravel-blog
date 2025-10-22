@extends('master')
@section('title', 'UserManage')
<link rel="stylesheet" href="{{asset('assets/css/userManageStyle.css')}}">
@section('content')
<div class="admin-users-container">
    <div class="admin-header">
        <h1 class="admin-title">
            <i class="fas fa-users"></i>
            إدارة المستخدمين
        </h1>
        <div class="admin-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $user->count() }}</span>
                <span class="stat-label">عدد المستخدمين</span>
            </div>
        </div>
    </div>

    <div class="users-grid">
        @forelse ($user as $user)
        <div class="admin-user-card">
            <div class="user-content-section">
                <div class="user-header">
                    <h3 class="user-admin-title">{{$user->name}}</h3>
                   
                </div>

                <div class="user-excerpt">
                    {{$user->email}}
                </div>

                <div class="user-actions">
                    <a href="#" class="action-btn edit-btn">
                        <i class="fas fa-edit"></i>
                        <span>تعديل</span>
                    </a>

                    <form action="{{route('auth.star', $user->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="action-btn edit-btn">
                        <i class="fas fa-star"></i>
                        <span>ترقية</span>
                      </a>
                    </form>
                   

                    <form action="{{route('auth.userDelete', $user->id)}}" method="POST" class="delete-form"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم');">
                        @csrf
                        
                        <button type="submit" class="action-btn delete-btn">
                            <i class="fas fa-trash"></i>
                            <span>حذف</span>
                        </button>
                    </form>
                   
                </div>
            </div>
        </div>
        @empty
        <div class="no-articles">
            <div class="no-users-content">
                <i class="fas fa-newspaper"></i>
                <h3>لا يوجد مستخدمين</h3>
                <p>لا يوجد مستخدمين</p>
                <a href="{{route('auth.showPostPage')}}" class="create-article-btn">
                    <i class="fas fa-plus"></i>
                    إضافة مستخدم للمدونة
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection