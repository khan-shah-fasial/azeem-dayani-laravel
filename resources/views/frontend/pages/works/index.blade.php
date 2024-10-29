@extends('frontend.layouts.app')

@section('page.title', $page->meta_title)

@section('page.description', $page->meta_description)

@section('page.type', 'website')

@section('page.content')
    @php
        if (!empty($page->content)) {
            $data = $page->content;
            $decoded_data = json_decode($data);
        } else {
        }
    @endphp

    <style>
       
        .header { 
            background: #218ee3 !important; 
        } 
    </style>

    <main id="works_page">
        <section class="animate-work-first-section works_section film_section">
            <div class="works_headphone_heading">
                <h1 class="work_main_name section_title">HIS WORK</h1>
                <img class="img-scale-work headphone_heading" src="/assets/frontend/images/Work/Headphones.png" />
                <!-- <div class="text-white" id="bars5"></div> -->
            </div>
            <div class="animated-para-work section_description text-center col-md-9 mx-auto pt-md-4 para_font">
                @php
                    echo html_entity_decode($description);
                @endphp
            </div>

            @if(count($flims) > 0)
                <div
                    class="d-flex col-md-10 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading pb-md-4 pt5">
                    <div class="text-white" id="bars6"></div>

                    <h3 class="col-md-8 text-center text-white category_title non_film">
                        FILM ALBUMS
                    </h3>
                    <div class="text-white" id="bars7"></div>
                </div>
                <div class="row film_row" style="background:#218ee3;">
                    @foreach ($flims as $row)
                        <div class="col-lg-4 col-md-6 col-12 mb-md-4 mb-3 card_main">
                            <a href="{{ $row->slug }}" target="_blank" class="card-link text-decoration-none">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $row->image) }}" class="card-img-top"
                                        alt="Kapoor &amp; Sons" />
                                    <div class="text-overflow card-body">
                                        <h5 class="card-title">{{ $row->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        @if(count($non_flims) > 0)
            <section class="works_section non_film_section">
                <div
                    class="d-flex col-md-11 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading pb-md-4 pt5">
                    <div class="text-white" id="bars8"></div>
                    <h3 class="col-md-8 text-center category_title non_film">
                        NON FILM SINGLES
                    </h3>
                    <div class="text-white" id="bars9"></div>
                </div>
                <div class="row non_film_row">
                    @foreach ($non_flims as $row)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <a href="{{ $row->slug }}" target="_blank" class="card-link text-decoration-none">
                                <div class="card non_film_card">
                                    <img src="{{ asset('storage/' . $row->image) }}" class="card-img-top"
                                        alt="Kapoor &amp; Sons" />
                                    <div class="text-overflow card-body non_film_card_body">
                                        <h5 class="card-title non_film_card_title">{{ $row->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- Repeat for other non-film cards -->
                </div>
            </section>
        @endif

        @if(count($ott) > 0)
            <section class="works_section ott_music_section">
                <div
                    class="d-flex col-md-11 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading ott_heading pb-md-4 pt5">
                    <div class="text-white" id="bars11"></div>
                    <h3 class="col-md-8 text-center category_title non_film">
                        OTT
                    </h3>
                    <div class="text-white" id="bars12"></div>
                </div>
                <div class="row non_film_row ott_row">
                    @foreach ($ott as $row)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <a href="{{ $row->slug }}" target="_blank" class="card-link text-decoration-none">
                                <div class="card non_film_card">
                                    <img src="{{ asset('storage/' . $row->image) }}" class="card-img-top"
                                        alt="Kapoor &amp; Sons" />
                                    <div class="text-overflow card-body non_film_card_body">
                                        <h5 class="card-title non_film_card_title">{{ $row->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- Repeat for other non-film cards -->
                </div>
            </section>
        @endif

    </main>



@endsection

@section('page.scripts')
@endsection
