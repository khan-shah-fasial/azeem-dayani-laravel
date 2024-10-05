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
        footer {
            background: #59a246;
        }
    </style>

    <main id="works_page">
        <section class="animate-work-first-section works_section film_section">
            <div class="works_headphone_heading">
                <h1 class="work_main_name section_title">HIS WORK</h1>
                <img class="img-scale-work headphone_heading" src="/assets/frontend/images/Work/Headphones.png" />
                <div class="text-white" id="bars5"></div>
            </div>
            <div class="animated-para-work section_description text-center col-md-9 mx-auto pt-md-4 para_font">
                @php
                    echo html_entity_decode($description);
                @endphp
            </div>

            <div
                class="d-flex col-md-10 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading pb-md-4">
                <div class="text-white" id="bars6"></div>

                <h3 class="col-md-8 text-center text-white category_title non_film">
                    FILM ALBUMS
                </h3>
                <div class="text-white" id="bars7"></div>
            </div>
            <div class="row film_row">
                @foreach ($flims as $row)
                    <div class="col-md-4 mb-4">
                        <a href="{{ $row->slug }}" target="_blank" class="card-link">
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
        </section>
        <section class="works_section non_film_section">
            <div
                class="d-flex col-md-11 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading pb-md-4">
                <div class="text-white" id="bars8"></div>
                <h3 class="col-md-8 text-center category_title non_film">
                    NON FILM SINGLES
                </h3>
                <div class="text-white" id="bars9"></div>
            </div>
            <div class="row non_film_row">
                @foreach ($non_flims as $row)
                    <div class="col-md-4 mb-4">
                        <a href="{{ $row->slug }}" target="_blank" class="card-link">
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
                <!-- Repeat for other non-film cards -->
            </div>
        </section>
    </main>



@endsection

@section('page.scripts')
@endsection
