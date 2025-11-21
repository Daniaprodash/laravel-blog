
<link rel="stylesheet" href="{{asset('assets/css/footerStyle.css')}}">
<footer id='footer'>
<div class="footer-top">
     <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>DashBlog</h3>
                        <p>
                            {{ __('messages.footer_address') }}<br><br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>{{ __('messages.footer_links') }}</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.index')}}">{{ __('messages.home') }}</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.whous')}}">{{ __('messages.about') }}</a></li>
                            @auth
                             @if(Auth::user()->role==='admin')
                              <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.dashboard')}}">{{ __('messages.dashboard') }}</a></li>
                             @else
                              <li><i class="bx bx-chevron-right"></i> <a href="{{route('auth.userDashboard')}}">{{ __('messages.dashboard') }}</a></li>
                             @endif
                            @endauth
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>{{ __('messages.categories') }}</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">{{ __('messages.category_tech') }}</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">{{ __('messages.category_cultural') }}</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">{{ __('messages.category_social') }}</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">{{ __('messages.category_sports') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>{{ __('messages.contact_us') }}</h4>
                        <p>
                            <strong>{{ __('messages.phone') }}:</strong> +991628899<br>
                            <strong>{{ __('messages.email') }}:</strong> Dash@gmail.com<br>
                        </p>
            </div>

        </div>
    </div>
</div>
</footer>
