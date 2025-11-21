@extends('master')
@section('title', __('messages.user_management'))
<link rel="stylesheet" href="{{asset('assets/css/userManageStyle.css')}}">
@section('content')
@if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 1rem; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
       {{ session('success') }}
    </div>
@endif

<div class="admin-users-container">
    <div class="admin-header">
        <h1 class="admin-title">
            <i class="fas fa-users"></i>
            {{ __('messages.user_management') }}
        </h1>
        <div class="admin-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $user->count() }}</span>
                <span class="stat-label">{{ __('messages.total_users') }}</span>
            </div>
        </div>
    </div>

    <div class="users-table-wrapper">
        <div class="table-responsive">
            <table class="users-table">
                <thead>
                    <tr>
                        <th class="col-id">{{ __('messages.id') }}</th>
                        <th class="col-name">{{ __('messages.name') }}</th>
                        <th class="col-email">{{ __('messages.email') }}</th>
                        <th class="col-role">{{ __('messages.role') }}</th>
                        <th class="col-articles">{{ __('messages.articles_count') }}</th>
                        <th class="col-date">{{ __('messages.registered_at') }}</th>
                        <th class="col-actions">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $index => $singleUser)
                    <tr class="user-row">
                        <td class="col-id">
                            <div class="user-id">{{ $index + 1 }}</div>
                        </td>
                        <td class="col-name">
                            <div class="user-name-cell">
                                <div class="user-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="user-name-info">
                                    <span class="user-name">{{ $singleUser->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="col-email">
                            <span class="user-email">
                                <i class="fas fa-envelope"></i>
                                {{ $singleUser->email }}
                            </span>
                        </td>
                        <td class="col-role">
                            @if($singleUser->role === 'admin')
                                <span class="badge badge-admin">
                                    <i class="fas fa-crown"></i>
                                    {{ __('messages.admin') }}
                                </span>
                            @else
                                <span class="badge badge-user">
                                    <i class="fas fa-user"></i>
                                    {{ __('messages.user') }}
                                </span>
                            @endif
                        </td>
                        <td class="col-articles">
                            <span class="articles-count">
                                <i class="fas fa-newspaper"></i>
                                {{ $singleUser->articles_count }}
                            </span>
                        </td>
                        <td class="col-date">
                            <span class="user-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $singleUser->created_at }}
                            </span>
                        </td>
                        <td class="col-actions">
                            <div class="action-buttons">
                                @if($singleUser->role !== 'admin')
                                <form action="{{ route('auth.star', $singleUser->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    <button type="submit" class="action-btn promote-btn" title="{{ __('messages.promote_to_admin') }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                                @endif

                                @if($singleUser->id !== Auth::id())
                                
                                    <button type="submit" class="action-btn delete-btn" title="{{ __('messages.delete_user') }}" onclick="openConfirmModal({{ $singleUser->id }})" data-toggle="modal" data-target="#confirmModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                
                                @else
                                <span class="current-user-indicator" title="{{ __('messages.current_user') }}">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-users-message">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <h3>{{ __('messages.no_users') }}</h3>
                                <p>{{ __('messages.no_users_found') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:9999;">
    <div style="background:white; padding:30px; border-radius:15px; text-align:center; min-width:350px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
        <i class="fas fa-exclamation-triangle" style="font-size:48px; color:#ef4444; margin-bottom:15px;"></i>
        <p style="margin-bottom: 25px; font-size:16px; color:#333;">{{ __('messages.delete_user_confirm') }}</p>
        <form id="confirmDeleteForm" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#ef4444; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px; margin-left:10px;">{{ __('messages.yes_delete') }}</button>
            <button type="button" onclick="closeConfirmModal()" style="background:#6b7280; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">{{ __('messages.cancel') }}</button>
        </form>
    </div>
</div>
<script>
    function openConfirmModal(userId) {
        const form = document.getElementById('confirmDeleteForm');
        form.action = `/userDelete/${userId}`; // أو استخدمي route إذا عندك JS routing
        if(form) {
            document.getElementById('confirmModal').style.display = 'flex';
        }
    }
    function closeConfirmModal() {
        if(document.getElementById('confirmModal')) {
            document.getElementById('confirmModal').style.display = 'none';
        }
    }
</script>
@endsection
