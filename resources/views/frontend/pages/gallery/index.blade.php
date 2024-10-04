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
            <div class="masonry_gallery">
                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_1.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_1.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_2.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_2.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_3.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_3.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_8.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_8.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_9.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_9.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_10.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_10.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_11.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_11.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_12.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_12.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_13.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_13.jpeg" /></a>
                </div>
                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_14.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_14.jpeg" /></a>
                </div>

                <div class="masonry_gallery_div gallery_dt_img the_gallery_img">
                    <a href="images/Gallery/gallery_image_15.jpeg" data-fancybox="images" data-caption="Image1"><img
                            class="reveal-img-top" src="/assets/frontend/images/Gallery/gallery_image_15.jpeg" /></a>
                </div>
            </div>

            <div class="col-md-10 mx-auto row gallery_videos" id="gallery_videos">
                <div class="gallery-video-item item col-md-3">
                    <img src="/assets/frontend/images/Gallery/gallery_image_14.png" />
                    <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                        data-youtube-url="/assets/frontend/images/Gallery/gallery_video1.mp4"></button>
                    <!-- <i class="fa-regular fa-circle-play"></i> -->
                </div>

                <div class="gallery-video-item item col-md-3">
                    <img src="/assets/frontend/images/Gallery/gallery_video2-0.jpg" alt="Video 1 Thumbnail" />
                    <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                        data-youtube-url="/assets/frontend/images/Gallery/gallery_video2.mp4"></button>
                    <!-- <i class="fa-regular fa-circle-play"></i> -->
                </div>

                <div class="gallery-video-item item col-md-3">
                    <img src="/assets/frontend/images/Gallery/gallery_image_15.png" alt="Video 1 Thumbnail" />
                    <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                        data-youtube-url="/assets/frontend/images/Gallery/gallery_video3.mp4"></button>
                    <!-- <i class="fa-regular fa-circle-play"></i> -->
                </div>
                <div class="gallery-video-item item col-md-3">
                    <img src="/assets/frontend/images/Gallery/gallery_image_13.png" alt="Video 1 Thumbnail" />
                    <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                        data-youtube-url="/assets/frontend/images/Gallery/gallery_video4.mp4"></button>
                    <!-- <i class="fa-regular fa-circle-play"></i> -->
                </div>

                <div class="gallery-video-item item col-md-3">
                    <img src="/assets/frontend/images/Gallery/gallery_image_2.png" alt="Video 1 Thumbnail" />
                    <button type="button" class="btn gallery_yt_video" data-toggle="modal" data-target="#exampleModal"
                        data-youtube-url="/assets/frontend/images/Gallery/gallery_video5.mp4"></button>
                    <!-- <i class="fa-regular fa-circle-play"></i> -->
                </div>

                <!-- Add more items as needed -->
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
