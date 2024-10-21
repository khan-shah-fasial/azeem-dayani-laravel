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

    <main id="gallery_page">
        <section class="works_section film_section">
            <div class="contact_heading_div text-center animate-contact-first-section">
                <h1 class="contact_main_name text-light contact_heading mb-0">
                    gallery
                </h1>
                <!-- <h1 class="section_title">HIS WORK</h1> -->
                <img class="scale-img-contact contact_us_heading_img" src="/assets/frontend/images/contact-us/Headphone.png" />
            </div>
            
            <div class="col-md-10 mx-auto row gallery_videos" id="gallery_videos">
                @foreach ($video_image as $index => $row)
                    <div class="gallery-video-item item col-lg-3 col-md-6 col-12">
                        <img src="{{ asset('storage/' . $video_image_i[$index]) }}" />
                        <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                            data-youtube-url="{{ asset('storage/' . $row) }}"
                            data-title=""></button>
                    </div>
                @endforeach
                <!-- Add more items as needed -->
            </div>

            <div class="masonry_gallery">
                @foreach ($image as $index => $row)
                    <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                        <a href="{{ asset('storage/' .$row) }}" data-fancybox="images" data-caption="Image{{ $index }}"><img
                                class="reveal-img-top" src="{{ asset('storage/' .$row) }}" /></a>
                    </div>
                @endforeach
            </div>

        </section>
    </main>

    <!-- Modal -->
    <div class="gallery modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="videoIframe" width="100%" height="480"
                            src=""
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
