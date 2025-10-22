<link rel="stylesheet" href="{{asset('assets/css/footerStyle.css')}}">
<footer id='footer'>
<div class="footer-top">
     <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>DASHBlog</h3>
                        <p>
                            Dash company, Asi Street <br>
                            HAMA, SYRYA<br>
                            United Arab Emirates <br><br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>روابط مهمة</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.index')}}">الصفحة الرئيسية</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.whous')}}"> من نحن</a></li>
                            @auth
                             @if(Auth::user()->role==='admin')
                              <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.dashboard')}}">لوحة التحكم</a></li>
                             @else
                              <li><i class="bx bx-chevron-right"><a href="{{route('auth.userDashboard')}}">لوحة التحكم</a></i></li>
                             @endif
                            @endauth
                            <li><i class="bx bx-chevron-right"></i> <a href="#"></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>تصنيفات</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">مقالات برمجية</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">رياضه</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">طعام</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">مقالات حول الفن</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">مقالات دينية</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">مقالات تاريخية</a></li>
                        </ul>
                    </div>

                
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>اتصل بنا</h4>
                        <p>
                            <strong>Phone:</strong> +991628899<br>
                            <strong>Email:</strong> Dash@gmail.com<br>
                        </p>
            </div>

        </div>
    </div>
</div>
</footer>