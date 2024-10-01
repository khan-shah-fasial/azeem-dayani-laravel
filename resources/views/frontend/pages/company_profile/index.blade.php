@extends('frontend.layouts.app')

@section('page.title', $page->meta_title)

@section('page.description', $page->meta_description)

@section('page.type', 'website')

@section('page.content')
@php
    if (!empty($page->content)) {
        $data = $page->content;
        $decoded_data = json_decode($data);

        //echo '<pre>';
        //print_r($decoded_data);
        //echo '</pre>';


        //exit();
        $about_content = $decoded_data->about_content ?? '';
        $core_content = $decoded_data->core_content ?? '';
        $policy_content = $decoded_data->policy_content ?? '';
        $about2_content1 = $decoded_data->about2_content1 ?? '';
        $about2_content2 = $decoded_data->about2_content2 ?? '';
        $mnv_description1 = $decoded_data->mnv_description1 ?? '';
        $mnv_description2 = $decoded_data->mnv_description2 ?? '';
        $about_image = $decoded_data->about_image ?? '';
        $core_image = $decoded_data->core_image ?? '';
        $policy_image = $decoded_data->policy_image ?? '';
        $mnv_image1 = $decoded_data->mnv_image1 ?? '';
        $mnv_image2 = $decoded_data->mnv_image2 ?? '';
        $mnv_bg_image1 = $decoded_data->mnv_bg_image1 ?? '';
        $mnv_bg_image2 = $decoded_data->mnv_bg_image2 ?? '';
        $about2_image1 = $decoded_data->about2_image1 ?? '';
        $about2_image2 = $decoded_data->about2_image2 ?? '';
        $teams = $decoded_data->team ?? '';


    } else {
        // If content is empty, set default empty values
        $about_content = '';
        $core_content = '';
        $policy_content = '';
        $about2_content1 = '';
        $about2_content2 = '';
        $mnv_description1 = '';
        $mnv_description2 = '';
        $about_image = '';
        $core_image = '';
        $policy_image = '';
        $mnv_image1 = '';
        $mnv_image2 = '';
        $mnv_bg_image1 = '';
        $mnv_bg_image2 = '';
        $about2_image1 = '';
        $about2_image2 = '';
        $teams = '';
    }
@endphp

<main class="about_us_page">

    <section class="banner" id="product_categories_banner_img">
        <div class="container ">
            <div class="banner_heading_div text-center">
                <h2 class="text-light banner_heading_text">About Us</h2>
                <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                    <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                    <li class="list-group-item"><a href="{{route('index')}}">Home</a></li> >
                    <li class="list-group-item">
                        <p class="mb-0">About Us</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="white_section about_us py-md-5 py-3">
        <div class="container">
            <div class="row about_us_story_div">
                <div class="col-md-7 pe-md-4">
                    <h2 class="product_heading text-start pb-md-1"><span class="our">ABOUT </span>US</h2>
                    {!! $about_content !!}
                </div>
                <div class="col-md-5 saagar_speciality_chemical_machines float-md-end">
                    @if (!empty($about_image))
                        <img src="{{ asset('storage/' . $about_image) }}" alt="Chemical Process" class="img-fluid rounded">
                    @endif
                    <div class="about_info_box info-box text-lg-start text-center text-light p-lg-4 py-2 up_and_down">
                        <h4>100k+</h4>
                        <p>Lorem Ipsum</p>
                        <hr>
                        <h4>12M</h4>
                        <p>Lorem Ipsum Lans</p>
                    </div>
                </div>
            </div>


            <div class="col-md-12 background_blue_img my-md-5 my-4 p-md-5 p-3 cor_values">
                <h2 class="product_heading text-start text-light pb-md-1">Cor Values</h2>
                <div class="row align-items-center">
                    <div class="col-md-7 text-light pe-md-4 pt-md-3">
                        {!! $core_content !!}
                    </div>
                    <div class="col-md-5 col-12">
                        @if (!empty($core_image))
                            <img src="{{ asset('storage/' . $core_image) }}" alt="Chemical Process"
                                class="img-fluid right_img ps-md-3">
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex flex-md-row-reverse flex-column align-items-center col-md-12 py-md-3 py-3 company_policies">
                <div class="col-md-7 ps-md-5">
                    <h2 class="col-md-12 product_heading text-start pb-md-3 float-start"><span class="our"> COMPANY
                        </span>POLICY</h2>
                    {!! $policy_content !!}
                </div>
                <div class="col-md-5">
                    @if (!empty($policy_image))
                        <img src="{{ asset('storage/' . $policy_image) }}" alt="Chemical Process" class="right_img what_we_do_img pe-md-3">
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (!empty($teams))
        <section class="blue_section management_team py-md-5 py-3">
            <div class="container">
                <h2 class="vission_heading product_heading py-md-3 text-light">MANAGEMENT<span class="purple_color">
                        TEAM</span></h2>

                @foreach ($teams as $index => $team)
                    <div class="col-md-12 row align-items-center">
                        <div class="col-md-3 my-md-0 my-2">
                            <img src="{{ isset($team->image) ? asset('storage/' . $team->image) : '' }}"
                                alt="{{ isset($team->name) ? $team->name : '' }}" class="img-fluid profile_img">
                        </div>
                        <div class="col-md-9">
                            <h5 class="name_and_position text-light pb-md-3">{{ isset($team->name) ? $team->name : '' }}</h5>
                            <p class="about_description text-light"> {{ isset($team->description) ? $team->description : '' }} </p>
                        </div>
                    </div>
                    @if ($index < count($teams) - 1)
                        <hr class="col-md-9 float-end text-light py-md-2">
                    @endif
                @endforeach
            </div>
        </section>
    @endif


    <section class="white_section  partnership py-md-5 py-3">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-7 pe-md-5">
                    {!! $about2_content1 !!}
                </div>
                @if (!empty($about2_image1))
                    <div class="col-md-5">
                        <img class="right_img what_we_do_img ps-lg-3 mt-md-0"
                            src="{{ asset('storage/' . $about2_image1) }}">
                    </div>
                @endif
            </div>
        </div>

        <div class="container ">
            <div class="d-flex flex-md-row-reverse flex-column align-items-center justify-content-between pt-md-5 pt-4">
                <div class="col-md-6 ps-md-4">
                    {!! $about2_content2 !!}
                </div>
                @if (!empty($about2_image1))
                    <div class="col-md-5">
                        <img class="right_img what_we_do_img pe-lg-3" src="{{ asset('storage/' . $about2_image2) }}">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="white_section why_sscpl py-lg-5 py-3 pb-md-5 pb-3">
        <div class="container mb-md-5">
            <div class="row justify-content-between position-relative">
                <div class="animated_moving_machine py-md-2 d-md-block d-none">
                    <img class="moving_machine" src="/assets/frontend/images/home/animated_top-tank.png" alt="">
                </div>
                <div class="col-12 why_sscpl_bg_img">                    
                    <h2 class="product_heading text-light text-center pt-lg-5 pt-3 mt-md-4">WHY SSCPL?</h2>
                    <div class="row pt-lg-5 pt-3 px-md-0 px-3">
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/funnel.png" alt=""
                                    class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Product</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/competitve_pricing.png"
                                    alt="" class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Competitve Pricing</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/packaging.png" alt=""
                                    class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Packaging</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/commitment.png" alt=""
                                    class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Commitment</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/delivery.png" alt=""
                                    class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Delivery</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/customised_solutions.png"
                                    alt="" class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Customised Solutions</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/compliances.png" alt=""
                                    class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Compliances</p>
                        </div>
                        <div class="col-md-3 col-6 sscl_contents_main_div text-center pb-lg-5 pb-3">
                            <div class="sscl_img_div"> <img src="/assets/frontend/images/home/customer_support.png"
                                    alt="" class="sscl_img"></div>
                            <p class="sscl_content mt-md-3">Customer Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="white_section vision_mission pt-lg-4 py-md-5 py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col ps-lg-0">
                    <div class="our_vission_main_div text-light p-lg-5 p-md-4" style="background-image: url('{{ asset('storage/' . $mnv_bg_image1) }}'); background-size: cover; background-position: center; border-radius: 30px;">
                        <div class="vission_img_div">
                            <img src="{{ asset('storage/' . $mnv_image1) }}" alt="" class="vission_img">
                        </div>
                        <h2 class="vission_heading product_heading py-lg-3 py-2 text-light"><span
                                class="purple_color">OUR</span> VISSION</h2>
                            <p class="vission_para text-light"> {!! $mnv_description1 !!} </p>
                    </div>
                </div>
                <div class="col pe-lg-0">
                    <div class="text-light our_mission_main_div p-lg-5 p-md-4" style="background-image: url('{{ asset('storage/' . $mnv_bg_image2) }}'); background-size: cover; background-position: center; border-radius: 30px; ">
                        <div class="mission_img_div">
                            <img src="{{ asset('storage/' . $mnv_image2) }}" alt="" class="mission_img">
                        </div>
                        <h2 class="mission_heading product_heading py-lg-3 py-2 text-light"><span
                                class="purple_color">OUR</span> MISSION</h2>
                            <p class="mission_para text-light">  {!! $mnv_description2 !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


@endsection