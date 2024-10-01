@extends('frontend.layouts.app')

@section('page.title', $page->meta_title)

@section('page.description', $page->meta_description)

@section('page.type', 'website')

@section('page.content')

@php
    if (!empty($page)) {
        $title = $page->title;
        $slug = $page->slug;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
    } else {
        $title = '';
        $slug = '';
        $meta_title = '';
        $meta_description = '';
    }
    if (!empty($page->content)) {
        $data = $page->content;
        $decoded_data = json_decode($data);
        $banners = $decoded_data->banner ?? '';
        $about_content = $decoded_data->about_content ?? '';
        $about_image = $decoded_data->about_image ?? '';
        $wwd = $decoded_data->wwd_image ?? '';
        $activities = $decoded_data->activities ?? '';
        $scp_content = $decoded_data->scp_content ?? '';
        $scp_image1 = $decoded_data->scp_image1 ?? '';
        $scp_pdf1 = $decoded_data->scp_pdf1 ?? '';
        $scp_text1 = $decoded_data->scp_text1 ?? '';
        $scp_image2 = $decoded_data->scp_image2 ?? '';
        $scp_text2 = $decoded_data->scp_text2 ?? '';
        $scp_url = $decoded_data->scp_url ?? '';
        $scp_image3 = $decoded_data->scp_image3 ?? '';
        $scp_pdf2 = $decoded_data->scp_pdf2 ?? '';
        $scp_text3 = $decoded_data->scp_text3 ?? '';
        $cocs_description = $decoded_data->cocs_description ?? '';
        $cocs_pdf = $decoded_data->cocs_pdf ?? '';
    } else {
        // If content is empty, set default empty values
        $banners = '';
        $about_content = '';
        $about_image = '';
        $wwd = '';
        $activities = '';
        $scp_content = '';
        $scp_image1 = '';
        $scp_pdf1 = '';
        $scp_text1 = '';
        $scp_image2 = '';
        $scp_text2 = '';
        $scp_url = '';
        $scp_image3 = '';
        $scp_pdf2 = '';
        $scp_text3 = '';
        $cocs_description = '';
        $cocs_pdf = '';
    }
@endphp

<style>    
    .header {
        position: absolute;
        z-index: 2;
        width: 100%;
    }

    .header {
        background-color: transparent;
    }

    .search-icon {
        color: #fff; /* Icon color */
    }

    .search-icon:hover {
        color: #fff; /* Icon color */
    }

    .navbar-brand {
        padding: 0px;
        margin-top: -15px;
    }
    .navbar-nav .nav-link {
        padding: 0px !important;
    }

    
    .fa-bars:before, .fa-navicon:before {
        color: #fff;
    }

    
    @media screen and (max-width:767px) {

        .navbar-brand {
            padding: 0px;
            margin-top: 0px;
        }

    }
</style>


<main class="home-page">

    <section id="slider_banner_section">
        <div class="container-fluid px-0">
            @if (!empty($banners))
                <div class="owl-theme owl-carousel home_page_banner_slides" id="home_page_banner_slider">

                    @foreach ($banners as $banner)
                        <div class="banner_slides">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="banner_img" loading="lazy">
                            <div class="banner_contents_div">
                                <h4 class="banner_content text-light">{{$banner->text}}</h4>
                                <a href="{{$banner->url}}" class="banner_view_button" aria-label="banner slider button">{{$banner->button}}</a>
                            </div>
                        </div>
                    @endforeach


                </div>
            @endif
            <marquee behavior="scroll" direction="left" class="">
                Your Dedicated Partners for Supply of Specialty Chemicals
            </marquee>
            <div class="animated_arrow_div text-center">
                <span class="animated_arrow_span">
                    <a href="#our_products" aria-label="arrow down">
                        <i class="fa fa-arrow-down animated_arrow_down"></i>
                    </a>
                </span>
            </div>
        </div>
    </section>

    @if(!empty($products))
        <section class="pt-5 pb-md-2" id="our_products">
            <div class="container">
                <h2 class="product_heading text-center pt-md-1 pb-md-2"><span class="our">OUR</span> PRODUCT</h2>

                <div class="row justify-content-center">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-6 our_product_cards_div">
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="d-flex align-items-center justify-content-between text-decoration-none w-100">
                                <div class="card">
                                    <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                        class="product_card_image card-img-top" alt="product image" loading="lazy"> -->
                                        <span class="product_img_heading">{{ $product->title }}</span>
                                    <div class="card-body d-flex">
                                        <p class="card-text">{{ $product->title }}</p>
                                        <i class="btn btn-primary fa fa-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="col-12 text-center pt-md-4 pt-4">
                        <a href="{{url(route('products_s'))}}" class="btn a_btn blue_btn" aria-label="know about our proucts">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="white_section py-5" id="company_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-11 background_blue_img p-lg-5 p-md-4 ps-md-3 p-3 py-4">
                        <div class="col-md-8">
                            {!! $about_content !!}
                            <a href="{{route('about_us')}}" class="btn a_btn white_btn btn-lg mt-md-3 mt-0" aria-label="know about us">
                                Read More <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 position-relative">
                        <div class="col-md-5 col-12 saagar_speciality_chemical_machine float-end">
                            @if (!empty($about_image))
                                <img src="{{ asset('storage/' . $about_image) }}" alt="Chemical Process"
                                    class="img-fluid rounded" loading="lazy">
                            @endif

                            <div class="info_box text-lg-start text-center text-light p-lg-4 py-2 up_and_down">
                                <h4>100k+</h4>
                                <p>Lorem Ipsum</p>
                                <hr>
                                <h4>12M</h4>
                                <p>Lorem Ipsum Lans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="white_section industry_we_cater py-md-5 py-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <h2 class="product_heading text-center pb-lg-4 pb-md-3 float-start"><span class="our">INDUSTRY</span> WE
                        CATER</h2>
                </div>
                <div class="col-md-6 d-md-block d-none">
                    <a href="{{route('products_category')}}" class="btn a_btn blue_btn float-md-end float-start" aria-label="services we give">
                        View All
                    </a>
                </div>
            </div>
            <div class="row industry_contents_main_div">
           
            @foreach($productCategories as $category)
                <!-- Add your achievement items here -->
                <div class="col-md-4 col-6 mb-0 pe-md-0">
                    <a href="{{ route('products_s', ['category_id' => $category->id]) }}" class="d-block industry_content_div position-relative">
                    @if (!empty($category->image))    
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}" class="industry_img" loading="lazy">
                    @endif
                        <div class="d-flex industry_content">
                            <span class="industry_text_link ps-md-4">{{ $category->title }}</span>
                            <span class="industry_arrow_link pe-lg-3">
                                <img class="rotate45" src="/assets/frontend/images/home/right_arrow_45deg.png" alt="rotate 45 deg arrow" loading="lazy">
                            </span>
                        </div>
                    </a>
                </div>                
            @endforeach

            <div class="col-md-6 d-md-none d-block py-3 text-center">
                <a href="{{route('products_category')}}" class="btn a_btn blue_btn float-md-end" aria-label="services we give">
                    View All
                </a>
            </div>
        </div>
    </section>

    <section class="blue_section what_we_do py-lg-5 pt-md-4 py-4">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <h2 class="product_heading what_we_do_heading text-center pb-lg-4 pb-md-3 pb-1 float-start"><span
                            class="text-light">WHAT</span> WE DO?</h2>
                </div>
                <div class="col-md-6 d-md-block d-none">
                    <a href="{{route('what_we_do')}}"
                        class="btn a_btn purple_btn float-end border border-2 border-light text-light" aria-label="know about our works">
                        View All
                    </a>
                </div>
            </div>
            @if (!empty($wwd))
                <div class="row">

                    <div class="owl-theme owl-carousel" id="what_we_do_slider">
                        @foreach ($wwd as $index => $row)
                            <div class="col-12 what_we_do_main_div">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $row->image) }}" class="card-img-top" alt="card-img-top" loading="lazy">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$row->text}}</h5>
                                        <p class="card-text">{{$row->content}}</p>
                                        <a href="{{route('what_we_do')}}" class="what_we_do_link" aria-label="see what we do">Read More
                                            <img class="arrow_right_img" src="/assets/frontend/images/home/right-arrow.svg" alt="arrow right image" loading="lazy"> </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col-md-6 d-md-none d-block py-3 text-center">
                <a href="{{route('what_we_do')}}"
                    class="btn a_btn purple_btn float-md-end border border-2 border-light text-light" aria-label="know about our works">
                    View All
                </a>
            </div>
        </div>
    </section>

    <section class="white_section why_sscpl py-lg-5 py-4">
        <div class="container">
            <div class="row justify-content-between position-relative">
                <div class="animated_moving_machine py-md-2 d-md-block d-none">
                    <img class="moving_machine" src="/assets/frontend/images/home/animated_top-tank.png" alt="moving top tank">
                </div>
                <div class="col-12">
                    <div class="why_sscpl_bg_img">
                        <h2 class="product_heading text-light text-center pt-lg-5 pt-3 mt-md-4">WHY SSCPL?</h2>
                        <div class="row pt-lg-5 pt-3">
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-md-5 pb-3">
                                <div class="sscl_img_div"> <img src="/assets/frontend/images/home/funnel.png" alt=""
                                        class="sscl_img" loading="lazy"></div>
                                <p class="sscl_content mt-md-3">Product</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div"> <img
                                        src="/assets/frontend/images/home/competitve_pricing.png" alt=""
                                        class="sscl_img" loading="lazy"></div>
                                <p class="sscl_content mt-md-3">Competitve Pricing</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img src="/assets/frontend/images/home/packaging.png" alt=""
                                        class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Packaging</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img src="/assets/frontend/images/home/commitment.png" alt=""
                                        class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Commitment</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img src="/assets/frontend/images/home/delivery.png" alt=""
                                        class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Delivery</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img
                                        src="/assets/frontend/images/home/customised_solutions.png" alt=""
                                        class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Customised Solutions</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img src="/assets/frontend/images/home/compliances.png"
                                        alt="" class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Compliances</p>
                            </div>
                            <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                                <div class="sscl_img_div" loading="lazy"> <img src="/assets/frontend/images/home/customer_support.png"
                                        alt="" class="sscl_img"></div>
                                <p class="sscl_content mt-md-3">Customer Support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- @if (!empty($activities))
    <section class="white_section future_activity pb-lg-5 pb-3 pt-md-0 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-md-3">
                    <h2 class="product_heading text-center pt-md-4 pb-md-1 float-start"><span class="our">FUTURE</span>
                        ACTIVITES & OBJECTIVES</h2>
                </div>
                <div class="owl-theme owl-carousel" id="future_activity_slider">
                    @foreach ($activities as $index => $row )
                    <div class="col-12 future_activites_main_div">
                        <div class="card">
                            <!-- Add lazy class to images for lazy loading -->
                            <img src="/assets/frontend/images/home/unnamed.jpg" data-src="https://img.youtube.com/vi/{{ $row->url }}/hqdefault.jpg" class="card-img-top lazy"
                            alt="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{$row->text}}</h5>
                                <button type="button" class="btn gallery_yt_video" aria-label="Youtube btn" data-youtube-url="https://www.youtube.com/embed/{{$row->url}}">
                                    <i class="fa-regular fa-circle-play"></i>
                                </button>
                            </div>
                        </div>
                    </div>                  
                    @endforeach          
                </div>

            </div>
        </div>
    </section>
    @endif --}}


    <section class="white_section supply_chain_partner text-light bg-light pb-md-5 py-md-4 py-4">
        <div class="container">
            <div class="row d-flex justify-content-center position-relative">
                <div class="col-12">
                    <div class="content_img_div p-md-0 p-3 py-2">
                        <!-- <h2 class="product_heading text-light text-center pt-lg-5 pt-3">Supply Chain Partner</h2>
                        <br class="d-md-block d-none">
                        <div class="d-flex justify-content-center spply-chn-content_div">
                            <p class="col-md-9 sply_chn_content text-md-center pb-lg-5">
                                {{$scp_content}}
                            </p>
                        </div> -->
                        <div class="three_boxes_div col-md-11 row row-cols-2 row-cols-md-3">
                            <div class="col ">
                                <div class="spply_chn_box">
                                    <div class="spply_chn_box_img_div"> 
                                        <img src="{{ asset('storage/' . $scp_image1) }}" alt="" class="spply_chn_box_img" loading="lazy">
                                    </div>
                                    <h5 class="spply_chn_title my-lg-5 my-md-3">{{$scp_text1}}</h5>
                                    <a target="_blank" href="{{ asset('storage/' . $scp_pdf1) }}"
                                        class="spply_chn_btn">Download</a>
                                </div>
                            </div>

                            <div class="col ">
                                <div class="spply_chn_box">
                                    <div class="spply_chn_box_img_div"> 
                                        <img src="{{ asset('storage/' . $scp_image2) }}" alt="" class="spply_chn_box_img" loading="lazy">
                                    </div>
                                    <h5 class="spply_chn_title my-lg-5 my-md-3">{{$scp_text2}}</h5>
                                    <a target="_blank" href="{{route('partner_with_us')}}" class="spply_chn_btn">Connect Now</a>
                                </div>
                            </div>

                            <div class="col ">
                                <div class="spply_chn_box">
                                    <div class="spply_chn_box_img_div"> 
                                        <img src="{{ asset('storage/' . $scp_image3) }}" alt="" class="spply_chn_box_img" loading="lazy">
                                    </div>
                                    <h5 class="spply_chn_title my-lg-5 my-md-3">{{$scp_text3}}</h5>
                                    <a target="_blank" href="{{ asset('storage/' . $scp_pdf2) }}"
                                        class="spply_chn_btn">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="white_section code_of_conduct bg-light pb-md-5 py-3 pt-md-5 text-center">
        <div class="container">
            <h2 class="col-12 product_heading text-center mt-md-3 pt-lg-4 pb-md-3">CODE of <span class="our">CONDUCT</span></h2>
            <p class="col-12 code_of_content_div pb-md-3">{{$cocs_description }}</p>
            <div class="col-md-12 d-block pb-3 pt-2 text-center">
                <a target="_blank" href="{{ asset('storage/' . $cocs_pdf) }}" class="btn a_btn blue_btn" aria-label="see pdf for this">Read More</a>
            </div>
        </div>
    </section>

    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <iframe id="videoIframe" width="100%" height="480" src="" title="Introduction to Resin Art by Poonam Bukalsaria Shah | GoodHomes Craft Studio" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('page.scripts')
<script>
  $(document).ready(function(){
    $('.gallery_yt_video').click(function(){
      var url = $(this).attr('data-youtube-url');
      $('#videoIframe').attr('src', url);
      $('#videoModal').modal('show');
    });

    $('.close').click(function(){
      $('#videoModal').modal('hide');
    });

    $('#videoModal').on('hide.bs.modal', function () {
      $('#videoIframe').attr('src', '');
    });
  });
</script>
@endsection