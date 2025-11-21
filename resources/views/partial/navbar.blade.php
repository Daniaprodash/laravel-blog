<link rel="stylesheet" href="{{asset('assets/css/navbarStyle.css')}}">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        DashBlog
          <i class="fas fa-blog me-2"></i>
      </a>

      <form action="{{ route('auth.ArticleSearch') }}" method="GET" class="search-form">
          <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="keyword" placeholder="{{ __('messages.search_placeholder') }}" class="search-input" value="{{ request('keyword') }}">
             <button type="submit" class="search-button">{{ __('messages.search') }}</button>
          </div>
      </form>

      <div class="menu nav-options ">
        @auth
        <form action="{{ route('auth.logout') }}" method="POST" style=" margin-top:5px">
          @csrf
          <button class="log-in btn-link">{{ __('messages.logout') }}</button></form>
        @else
        <button class="log-in"><a href="{{route('auth.welcome')}}" class="btn-link">{{ __('messages.login') }} </a></button>
        @endauth
        <div class="nav-link">  
          <a href="#">{{ __('messages.contact') }}</a>
          <a href="#">{{ __('messages.categories') }}</a>
          <a href="{{route('auth.whous')}}">{{ __('messages.about') }}</a>
          <a href="{{route('auth.index')}}">{{ __('messages.home') }}</a>
          @auth
          @if(Auth::user()->role==='admin')
            <a href="{{route('auth.dashboard')}}">{{ __('messages.profile') }}</a>
          @else
            <a href="{{route('auth.userDashboard')}}">{{ __('messages.profile') }}</a>
          @endif  
          @endauth
        </div>
         
      </div> 
  </div>
      <i class="fas fa-bars mobile-nav-toggle"></i>
</nav>
<!-- endNavbar -->


<!-- زر القائمة -->
<!-- script -->
<script>
  // دالة لتبديل القائمة المنسدلة
  function toggleCategories(event) {
    event.preventDefault();
    event.stopPropagation();
    const dropdown = event.currentTarget.parentElement;
    dropdown.classList.toggle('active');
  }

  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.mobile-nav-toggle');
    const navMenu = document.querySelector('.nav-options');

    toggleBtn.addEventListener('click', function () {
      navMenu.classList.toggle('active');

      // تبديل شكل الأيقونة
      if (toggleBtn.classList.contains('fa-bars')) {
        toggleBtn.classList.remove('fa-bars');
        toggleBtn.classList.add('fa-x');
      } else {
        toggleBtn.classList.remove('fa-x');
        toggleBtn.classList.add('fa-bars');
      }
    });

  
  });
</script>
