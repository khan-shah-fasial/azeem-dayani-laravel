@php
    $footer = Cache::remember('footer_settings', 60, function () {
        return DB::table('frontend_settings')->where('id', 1)->first();
    });// Use `first()` instead of `get()` to get a single record
    $logo = $footer->logo ?? '';
@endphp

<footer class="footer pt_6">
    <div class=" text-center">
        <a href="index.php" class="text-decoration-none">
            <!-- <img class="header_logo" src="images/footer_logo_2.png"> -->
            <h4 class="footer_logo_text">{{ $logo }}</h4>
        </a>
        <div class="col-md-12 footer_links_div">
            <ul class="list-group list-group-horizontal list-unstyled justify-content-center">
                <li class="list-group-item footer_list">
                    <a href="{{ url(route('about_us')) }}" class="footer_link">about</a>
                </li>
                <li class="list-group-item footer_list">
                    <a href="{{ url(route('works')) }}" class="footer_link">His works</a>
                </li>
                <li class="list-group-item footer_list">
                    <a href="{{ url(route('achievements')) }}" class="footer_link">Achievements</a>
                </li>
                {{-- <!-- <li class="list-group-item footer_list">
                    <a href="playlist.php" class="footer_link">playlist</a>
                </li> --> --}}
                <li class="list-group-item footer_list">
                    <a href="{{ url(route('gallery')) }}" class="footer_link">gallery</a>
                </li>
                <li class="list-group-item footer_list">
                    <a href="{{ url(route('contact-us')) }}" class="footer_link">contact</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 footer_social_links_div">
        <div id="bars3"></div>
        <ul
            class="list-group-item list-unstyled d-flex gap-4 footer_social_media_icons pt-md-3 mb-0 justify-content-center">
            <li class="list-item">
                <a href="" class="social_media_links">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>

            <li class="list-item">
                <a href="" class="social_media_links">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>

            <li class="list-item">
                <a href="" class="social_media_links">
                    <i class="fa fa-linkedin-in"></i>
                </a>
            </li>
        </ul>


        {{-- <div class="sidebar_social_media">
            @if (isset($social_media) && !empty($social_media))
                <ul class="list-group-item list-unstyled mb-0 mt-1">
                    @foreach ($social_media as $index => $row)
                        <li class="list-item">
                            <a href="{{ $row->url }}" class="sidebar_social_media_link"
                                aria-label="sidebar social media links">
                                {!! $row->icon !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div> --}}


    </div>
</footer>
