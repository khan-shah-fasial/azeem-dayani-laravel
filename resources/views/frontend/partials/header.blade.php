@php
    $footer = Cache::remember('footer_settings', 60, function () {
        return DB::table('frontend_settings')->where('id', 1)->first();
    });// Use `first()` instead of `get()` to get a single record
    $logo = $footer->logo ?? '';
@endphp
<header id="header" class="header">
    <a href="{{ url(route('index')) }}">
        <!-- <img class="header_logo" src="images/footer_logo_2.png"> -->
        <h4 class="footer_logo_text">{{  $logo }}</h4>
    </a>
    <input class="menu-trigger" type="checkbox" id="menu_trigger" />
    <div class="overlay" id="fullscreen_nav">
        <ul class="menu-links">
            <li><a href="{{ url(route('index')) }}">Home</a></li>
            <li><a href="{{ url(route('about_us')) }}">About Us</a></li>
            <li><a href="{{ url(route('works')) }}">His Works</a></li>
            <li><a href="{{ url(route('achievements')) }}">Achievements & Accolades</a></li>
            <li><a href="{{ url(route('gallery')) }}">Gallery</a></li>
            <li><a href="{{ url(route('contact-us')) }}">Contact Us</a></li>
        </ul>
    </div>
    <label class="hamburger-menu" for="menu_trigger"><span></span><span></span><span></span></label>

</header>
