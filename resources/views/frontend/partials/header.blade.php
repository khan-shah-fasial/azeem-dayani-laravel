@php
    $footer = Cache::remember('footer_settings', 60, function () {
        return DB::table('frontend_settings')->where('id', 1)->first();
    });// Use `first()` instead of `get()` to get a single record
    $logo = $footer->logo ?? '';
@endphp
<header id="header" class="header sticky-header">
    <a class="header_logo_link" href="{{ url(route('index')) }}">
        <!-- <img class="header_logo" src="images/footer_logo_2.png"> -->
        <h4 class="footer_logo_text">{{  $logo }}</h4>
    </a>
    <input class="menu-trigger" type="checkbox" id="menu_trigger" />
    <div class="overlay" id="fullscreen_nav">
        <ul class="menu-links">
            <li><a href="{{ url(route('index')) }}">Home</a></li>
            <li><a href="{{ url(route('about_us')) }}">About</a></li>
            <li><a href="{{ url(route('works')) }}">His Work</a></li>
            <li><a href="{{ url(route('achievements')) }}">Achievements</a></li>
            <li><a href="{{ url(route('gallery')) }}">Gallery</a></li>
            <li><a href="{{ url(route('contact-us')) }}">Contact</a></li>
        </ul>
    </div>
    <label class="hamburger-menu" for="menu_trigger"><span></span><span></span><span></span></label>

    <div class="whatsappdesktop">
        <a target="_blank" href="https://api.whatsapp.com/send?phone=9136755111&amp;text=Hello%21+Thank+you+for+reaching+out.%0A%0AI'm+currently+busy+creating+unique+musics%2C+but+your+message+is+important+to+me%21+I%E2%80%99ll+get+back+to+you+as+soon+as+possible.%0A%0AIn+the+meantime%2C+feel+free+to+check+out+my+website+for+more+information+about+my+work+and+available+pieces.%0A%0AHave+a+good+day%21">
            <i aria-hidden="true" class="fab fa-whatsapp"></i>
        </a>
    </div>
    
</header>

