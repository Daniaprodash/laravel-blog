@extends('master')
@section('title', 'إدارة المقالات - DASHBlog')
<link rel="stylesheet" href="{{ asset('assets/css/articleManageStyle.css') }}">
@section('content')

<div class="admin-articles-container">

    {{-- عرض رسالة النجاح --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1rem; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="articles-table-wrapper">
        <div class="table-responsive">
            <table class="articles-table">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-title">العنوان</th>
                        <th class="col-author">المؤلف</th>
                        <th class="col-category">التصنيف</th>
                        <th class="col-comments">التعليقات</th>
                        <th class="col-date">تاريخ النشر</th>
                        <th class="col-actions">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($article as $index => $item)
                    <tr class="article-row">
                        <td class="col-id">
                            <div class="article-id">{{ $index + 1 }}</div>
                        </td>
                        <td class="col-title">
                            <div class="article-title-cell">
                                @if($item->image)
                                <div class="article-image">
                                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->title }}">
                                </div>
                                @else
                                <div class="article-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                                <div class="article-title-info">
                                    <span class="article-title">{{ $item->title }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="col-author">
                            <div class="author-cell">
                                <div class="author-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="author-name">{{ $item->user->name }}</span>
                            </div>
                        </td>
                        <td class="col-category">
                            <span class="category-badge">
                                <i class="fas fa-tag"></i>
                                {{ $item->Categori }}
                            </span>
                        </td>
                        <td class="col-comments">
                            <span class="comments-count">
                                <i class="fas fa-comments"></i>
                                {{ $item->comments_count }}
                            </span>
                        </td>
                        <td class="col-date">
                            <span class="article-date">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $item->created_at->format('Y-m-d') }}
                            </span>
                        </td>
                        <td class="col-actions">
                            <div class="action-buttons">
                                <a href="{{ route('auth.showMore', $item->id) }}" class="action-btn view-btn" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('auth.editArticle', $item->id) }}" class="action-btn edit-btn" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" class="action-btn delete-btn" title="حذف" onclick="openConfirmModal({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-articles-message">
                            <div class="empty-state">
                                <i class="fas fa-newspaper"></i>
                                <h3>لا توجد مقالات</h3>
                                <p>لم يتم إنشاء أي مقالات بعد</p>
                                <a href="{{ route('auth.showPostPage') }}" class="create-article-btn">
                                    <i class="fas fa-plus"></i>
                                    إنشاء مقال جديد
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- نافذة التأكيد --}}
<div id="confirmModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:9999;">
    <div style="background:white; padding:30px; border-radius:15px; text-align:center; min-width:350px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
        <i class="fas fa-exclamation-triangle" style="font-size:48px; color:#ef4444; margin-bottom:15px;"></i>
        <p style="margin-bottom: 25px; font-size:16px; color:#333;">هل أنت متأكد من حذف هذه المقالة؟ لا يمكن التراجع بعد الحذف.</p>
        <form id="confirmDeleteForm" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#ef4444; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px; margin-left:10px;">نعم، حذف</button>
            <button type="button" onclick="closeConfirmModal()" style="background:#6b7280; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">إلغاء</button>
        </form>
    </div>
</div>

{{-- سكربتات --}}
<script>
    function openConfirmModal(articleId) {
        const form = document.getElementById('confirmDeleteForm');
        form.action = "{{ url('/deleteArticle') }}/" + articleId;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    // إغلاق النافذة عند النقر خارجها
    window.onclick = function(event) {
        const modal = document.getElementById('confirmModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

@endsection