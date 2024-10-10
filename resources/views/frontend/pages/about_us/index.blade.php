@extends('frontend.layouts.app')

@section('page.title', $page->meta_title)

@section('page.description', $page->meta_description)

@section('page.type', 'website')

@php
    $footer = Cache::remember('footer_settings', 60, function () {
        return DB::table('frontend_settings')->where('id', 1)->first();
    });// Use `first()` instead of `get()` to get a single record
    $logo = $footer->logo ?? '';
@endphp

@section('page.content')
    <main id="about_us_page">
        <section class="about_azeem_dayani bg_green">
            <div class="music_director_composer_main_div col-md-12 row zip_zap_bg_img_container">
                <img class="zig-zag-img zip_zap_bg_og_img" src="/assets/frontend/images/Homepage/Object_3.png" />
                <div class="col-md-7">
                    <img src="{{ asset('storage/' . $data['ab_img_1']) }}" alt="azeem dayani"
                        class="reveal-img-toptobottom azeem_big_photo d-md-block d-none" />
                    <img src="{{ asset('storage/' . $data['ab_img_1']) }}" alt="azeem dayani"
                        class="reveal-img-toptobottom_mobile azeem_big_photo d-md-none d-block" />
                </div>
                <div class="col-md-4 about_main_div animate-about-first-section">
                    <div class="col-md-12 about">
                        <div class="position-relative">
                            <!-- <img class="image_heading azeem_heading" src="/assets/frontend/images/about-us/Top_Logo.png"> -->
                            <h4 class="about_main_name footer_logo_text">{{ $logo }}</h4>
                        </div>

                        <div class="about_content">
                            <h5 class="animated-heading-about music_director_composer_heading pb-md-2">
                               {{ $data['ab_title'] }}
                            </h5>
                            <div class="animated-para-about about_azeem_dayani_para para_font">
                                @php echo html_entity_decode($data['ab_description']) @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="azeem_stadium_img_div">
                <img class="reveal-img-diagonal azeem_stadium_img" src="{{ asset('storage/' . $data['ab_img_2']) }}" />
            </div>
            <!-- <div class="the_journey_main_div the_journey_div_new d-flex pt-md-5">
                <div class="slidercircle">
                    <div class="circle-one"></div>

                    <div class="circle-two"></div>
                    
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-10 the_journey_div ms-md-4">
                    <h2 class="animated-heading the_journey_heading font_tungsten">
                        {{ $data['ab_journey_title'] }}
                    </h2>
                    <div class="animated-para the_journey_content para_font">
                        {!! $data['ab_journey_description'] !!}
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div> -->
            <!-- <div class="cutting_headphone_div col-md-8 icon-container" data-icon-height="40vh">
                <img class="scaleup-element cutting_headphone" src="/assets/frontend/images/about-us/Headphones.png" />
            </div>
            <div class="text-white" id="bars4"></div> -->
        </section>
        <section class="vision_main_section icon-container zip_zap_bg_img_container" data-icon-height="30vh">
            <div class="film_music_zig_zag_img_div">
                <img class="zig-zag-img film_music_zig_zag_img" src="/assets/frontend/images/Homepage/Object_2.png" />
            </div>
            <div class="work_with_team_main_div col-md-9 mx-auto text-center">
                <p class="animated-para small_heading">
                   {{ $data['ab_vision_sub_title'] }}
                </p>
                <h2 class="animated-heading work_with_team_heading">
                    {{ $data['ab_vision_title'] }}
                </h2>
            </div>
            <div class="row vision_main_div align-items-center justify-content-center">
                <div class="col-md-2 row position-relative">
                    <h1 class="fade-in vision_heading font_miedinger text-light">
                        visi<span class="">on</span>
                    </h1>
                </div>
                <div class="col-md-9">
                    <img class="scaleup-element vision_main_image" src="{{ asset('storage/' . $data['ab_vision_img']) }}" />
                    <div class="col-md-10 azeem_vision_div pt-md-4 text-md-center">
                        <div class="animated-para azeem_vision para_font">
                            {!! $data['ab_vision_description'] !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                {{-- <!-- <div class="cutting_headphone_div col-md-7">
                          <img class="cutting_headphone" src="/assets/frontend/images/about-us/Music_5.png">
                      </div>         --> --}}
                <div class="slidercircle">
                    <div class="circle-one"></div>

                    <div class="circle-two"></div>
                    {{--
                    <!-- <div class="circle-middle">
                              <svg fill="#fff" id="Bold" enable-background="new 0 0 24 24" height="73" viewBox="0 0 24 24" width="73" xmlns="http://www.w3.org/2000/svg">
                                  <path d="m.455 16.512 10.969 7.314c.374.23.774.233 1.152 0l10.969-7.314c.281-.187.455-.522.455-.857v-7.312c0-.335-.174-.67-.455-.857l-10.969-7.313c-.374-.23-.774-.232-1.152 0l-10.969 7.313c-.281.187-.455.522-.455.857v7.312c0 .335.174.67.455.857zm10.514 4.528-8.076-5.384 3.603-2.411 4.473 2.987zm2.062 0v-4.808l4.473-2.987 3.603 2.411zm8.907-7.314-2.585-1.727 2.585-1.728zm-8.907-10.767 8.076 5.384-3.603 2.411-4.473-2.987zm-1.031 6.602 3.643 2.438-3.643 2.438-3.643-2.438zm-1.031-6.602v4.808l-4.473 2.987-3.603-2.411zm-8.906 7.314v-.001l2.585 1.728-2.585 1.728z" />
                              </svg>
                          </div> -->
                    --}}
                </div>
            </div>
        </section>
    </main>

@endsection

@section('page.scripts')
@endsection
