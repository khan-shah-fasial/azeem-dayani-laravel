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
            <p class="animated-para-work section_description text-center col-md-9 mx-auto pt-md-4">
                Azeem Dayani's body of work as a music supervisor in Bollywood is
                characterized by a unique blend of commercial appeal and artistic
                innovation. As one of the very few music supervisors in the Indian
                film industry, he has been at the forefront of redefining how music is
                curated, created, and marketed in Bollywood films.
            </p>
            <p class="animated-para-work section_description text-center col-md-9 mx-auto pt-md-2">
                His work is frequently cited in media outlets, interviews, and
                industry forums, highlighting his innovative approach to curating
                soundtracks that blend traditional and contemporary elements.
            </p>

            <div
                class="d-flex col-md-10 justify-content-center align-items-center mx-auto overflow-hidden none_film_heading pb-md-4">
                <div class="text-white" id="bars6"></div>

                <h3 class="col-md-8 text-center text-white category_title non_film">
                    FILM ALBUMS
                </h3>
                <div class="text-white" id="bars7"></div>
            </div>
            <div class="row film_row">
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/1teNu8WgSFQyNncvswvbAL" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_1.png" class="card-img-top" alt="Kapoor &amp; Sons" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Kapoor & Sons (2016)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/110yeLSV0XY4Wtu7DnenNq" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_2.png" class="card-img-top" alt="Baar Baar Dekho (2016)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Baar Baar Dekho (2016)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/7Ck2si1vtgdPXdKGtWGGXr" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_3.png" class="card-img-top"
                                alt="Ok Jaanu - The Humma Song (2016)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Ok Jaanu - The Humma Song (2016)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/26ska1StQhwbWADLTg2hky" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_4.png" class="card-img-top" alt="Badrinath ki Dulhania (2017)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Badrinath ki Dulhania (2017)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/2xDQeAsyh56C6vYxQKpYAm" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_5.png" class="card-img-top" alt="Bareilly Ki Barfi (2017)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Bareilly Ki Barfi (2017)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/2zkyMw73XzNXUQaXTb4cio" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_6.png" class="card-img-top" alt="Bareilly Ki Barfi (2017)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Loveyatri (2018)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/3JV6qkpTBbwUL0gSDPc6bA" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_7.png" class="card-img-top"
                                alt="Badhaai Ho - Special Thanks (2018)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Badhaai Ho - Special Thanks (2018)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/3dynRTuVOrAr5O7srr2txN" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_8.png" class="card-img-top" alt="Simmba (2018)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Simmba (2018)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/3hdOKtAGjNOJckzjOrgTmN" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_9.png" class="card-img-top" alt="Kesari (2019)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Kesari (2019)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/1Se33DZWNZ1OkrqbOf1K3u" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_10.png" class="card-img-top" alt="Good Newwz (2019)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Good Newwz (2019)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/10EGsrkAAHL1TQuUVQP655" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_11.png" class="card-img-top" alt="Laxmil (2020)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Laxmil (2020)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/5BLwx5IlfoWOrjJJ3i7gbK" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_12.png" class="card-img-top" alt="Shershah (2021)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Shershah (2021)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/49wsmGDdtSoQiLt2lsVbaQ" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_13.png" class="card-img-top" alt="Jugjugg Jeeyo (2022)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Jugjugg Jeeyo (2022)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/playlist/42ZUznKRyWsVX49bcrHERT" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_14.png" class="card-img-top" alt="Selfiee (2023)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Selfiee (2023)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/playlist/57o1PXKlhrYEbYTgQIEZo0" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_15.png" class="card-img-top" alt="Yodha (2024)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Yodha (2024)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/50WGXLzYqSHJQhu15Vv7is" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_24.png" class="card-img-top" alt="Kill (2024)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Kill (2024)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/playlist/6rH1IT8vORQ292TwaRCPhE" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_16.png" class="card-img-top" alt="Mr. & Mrs. Mahi (2024)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Mr. & Mrs. Mahi (2024)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/6bqZS60eLo3NhEQDtuUGaW" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_17.png" class="card-img-top" alt="Bad Newz (2024)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Bad Newz (2024)</h5>
                            </div>
                        </div>
                    </a>
                </div>
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
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/album/7b0RW9Inq2jLmTGonmqv11" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_18.png" class="card-img-top" alt="Vaaste (2019)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Vaaste (2019)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/7DE0I3buHcns00C0YEsYsY" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_19.png" class="card-img-top"
                                alt="Filhaal - Co-Produced & Music Supervisor (2019)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">
                                    Filhaal - Co-Produced & Music Supervisor (2019)
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/576v1keY82NOPITMNu0wD2" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_20.png" class="card-img-top"
                                alt="Filhaal 2 - Co-Produced & Music Supervisor (2021)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">
                                    Filhaal 2 - Co-Produced & Music Supervisor (2021)
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/6V7UVqe8XnAS4WPdpaw5TK" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_21.png" class="card-img-top"
                                alt="Tu Mile Dil Khile - Remix (2023)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Tu Mile Dil Khile - Remix (2023)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/5PUXKVVVQ74C3gl5vKy9Li" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_23.png" class="card-img-top" alt="Heeriye (2023)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">Heeriye (2023)</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="https://open.spotify.com/track/6t7PuZfHAtNGheWisgUq3I" target="_blank" class="card-link">
                        <div class="card">
                            <img src="/assets/frontend/images/Work/Image_22.png" class="card-img-top"
                                alt="Kya Loge Tum - Co-Produced & Music Supervisor (2023)" />
                            <div class="text-overflow card-body">
                                <h5 class="card-title">
                                    Kya Loge Tum - Co-Produced & Music Supervisor (2023)
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Repeat for other non-film cards -->
            </div>
        </section>
    </main>



@endsection

@section('page.scripts')
@endsection
