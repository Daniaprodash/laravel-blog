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
            <input type="text" name="keyword" placeholder="ابحث هنا..." class="search-input" value="{{ request('keyword') }}">
             <button type="submit" class="search-button">بحث</button>
          </div>
      </form>

      <div class="menu nav-options ">
        @auth
        <form action="{{ route('auth.logout') }}" method="POST" style=" margin-top:5px">
          @csrf
          <button class="log-in btn-link">Log out</button></form>
        @else
        <button class="log-in"><a href="{{route('auth.welcome')}}" class="btn-link">Sign in </a></button>
        @endauth
        <div class="nav-link">  
          <a href="#">Contact</a>
          <a href="#">Categories</a>
          <a href="{{route('auth.whous')}}">About</a>
          <a href="{{route('auth.index')}}">Home</a>
          @auth
          @if(Auth::user()->role==='admin')
            <a href="{{route('auth.dashboard')}}">your profile</a>
          @else
            <a href="{{route('auth.userDashboard')}}">your profile</a>
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
    