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
    <main id="achievements_page">
        <section class="animate-achievements-first-section achievements_section">
            <div class="row">
                <div class="col-md-12 text-center pb-md-5">
                    <div class="col-md-10 mx-auto">
                        <h1 class="achievements_main_name achievement_title">
                            {{ $sec_title }}
                        </h1>
                        <div class="achievement_top_desecription animated-para-achievements">{!! $sec_description !!}</div>
                    </div>
                </div>
                <div class="zip_zap_bg_img_container">
                    <img class="zig-zag-img zip_zap_bg_og_img" src="/assets/frontend/images/Homepage/Object_3.png" />
                </div>
                <div class="col-md-2 d-md-flex align-items-center d-none position-relative h_63">
                    <!-- <div class="side_text">
                              <h2>Achievements</h2>
                          </div> -->
                    <img src="/assets/frontend/images/Achievements/Headphone_new_2.png"
                        class="left-scaleup-element img-fluid headphones_icon left-scaleup-element" alt="Headphones" />
                </div>
                <div class="col-md-9 pb-md-5 d-flex flex-md-row flex-column">
                    <div class="float-up">
                        <div class="row pb-md-5">
                            <!-- Add your achievement items here -->

                            @foreach ($image as $index => $row)
                                <div class="col-md-4 mb-2 award_main_div">
                                    <a href="" class="text-decoration-none">
                                        <div class="card achievement_card">
                                            <div class="masonry_gallery achievement_page_gallery">
                                                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                                                    <a href="{{ asset('storage/' . $row) }}" data-fancybox="images"
                                                        data-caption="Image1">
                                                        <img src="{{ asset('storage/' . $row) }}" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title award_name">
                                                    {{ $img_title[$index] }}
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                            <div class="col-md-4 mb-4"></div>
                            <!-- Repeat this block for each achievement -->
                        </div>
                    </div>

                    @foreach ($video_image as $index => $row)
                        <div class="col-md-4 mx-auto row pt-md-5" id="gallery_videos">
                            <div class="item col-12 d-flex flex-column">
                                <div class="video_div">
                                    <img src="{{ asset('storage/' . $video_image_i[$index]) }}" />
                                    <button type="button" class="btn gallery_yt_video" data-toggle="modal"
                                        data-target="#exampleModal"
                                        data-youtube-url="{{ asset('storage/' . $row) }}">
                                        {{-- <!-- <i class="fa-regular fa-circle-play"></i>       -->
                                        <!-- <img class="play_btn_img" src="/assets/frontend/images/Achievements/play_button.png"> --> --}}
                                    </button>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title award_name">
                                        {{ $video_title[$index] }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            {{-- <!-- <div class="col-md-12 music_coomposer d-flex justify-content-center">
                      <p class="collaboration_subtitle text-start col-md-9 font_tungsten">
                          Music composer Tanishk Bagchi and Azeem share a great work chemistry,
                          they have also come to be known as the most successful music duo in the last few years.
                      </p>
                  </div>          --> --}}
        </section>

        {{-- <!-- <section class="collaborations_section text-center">
                  <div class="col-md-12 d-flex justify-content-center align-items-center flex-column">
                      <p class="collaboration_highlight text-start col-md-9 pt-md-3">
                          Their hit single "Vaaste" crossed over 533 million views on YouTube.
                      </p>
                      <p class="collaboration_highlight text-start col-md-9 pt-md-3">
                          Amongst their many hits together, the ones that had the whole nation captive are
                      </p>
                  </div>
                  <div class="col-md-12 row">
                      <div class="col-md-9">
                          <ul class="col-md-8 collaborations_list mx-auto">
                              <li>Ve Maahi</li>
                              <li>Aankh Marey</li>
                              <li>Badri Ki Dulhania</li>
                              <li>Tamma Tamma Again</li>
                              <li>Tere Bin</li>
                              <li>Bolna</li>
                              <li>Akh Lad Jaave</li>
                              <li>The Humma Song</li>
                              <li>Sweety Tera Drama And many more.</li>
                          </ul>
                      </div>
                      <div class="col-md-3 float-end position-relative">
                          <img class="green_jacket" src="/assets/frontend/images/Achievements/T-Shirt.png">
                          <div class="collaboration_side_text">
                              <h2>Collaborations</h2>
                          </div>
                      </div>
                  </div>
              </section> --> --}}
    </main>

    <!-- Modal -->
    <div class="gallery modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">YouTube Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="videoIframe" width="100%" height="480"
                            src="https://www.youtube.com/embed/z2XS_RryJGk"
                            title="Introduction to Resin Art by Poonam Bukalsaria Shah | GoodHomes Craft Studio"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page.scripts')
@endsection
