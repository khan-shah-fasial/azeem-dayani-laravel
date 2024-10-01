@extends('frontend.layouts.app')

@section('page.title', $meta_title)

@section('page.description', $meta_description)

@section('page.type', 'website')

@section('page.content')
  
<main class="products_page product_di_butyl_phosphate" id="di_butyl_phosphate">
        
        <section class="banner" id="product_categories_banner_img">
            <div class="container ">
                <div class="banner_heading_div text-center">
                    <h2 class="text-light banner_heading_text">{{$page_name}}</h2>
                    <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                        <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                        <li class="list-group-item"><a href="{{route('index')}}">Home</a></li> > 
                        <li class="list-group-item"><p class="mb-0">{{$page_name}}</p></li>
                    </ul>
                </div>                
            </div>
        </section>

        <section class="white_section product_info py-lg-5 pt-md-5 py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-12 text-center product_img_div">
                        <img id="zoomable-image" class="img-fluid product_img" src="{{ asset('storage/' . $image)}}" alt="Chemical Structure">
                    </div>
                    <div class="col-md-7 ps-md-5 product_details">
                        <div class="product_heading_btn_next_prev_div">
                            <h2 class="product_heading text-start pb-md-1"><span class="our">{{$page_name}}</span></h2>
                            <div class="col-md-3 col-2 btn_next_prev_div">
                                @if($previous_product)
                                    <a href="{{ route('product.detail', $previous_product->slug) }}">
                                        <i class="fa fa-arrow-left btn btn-primary"></i>
                                    </a>
                                @else
                                    <i class="fa fa-arrow-left btn btn-primary disabled"></i>
                                @endif

                                @if($next_product)
                                    <a href="{{ route('product.detail', $next_product->slug) }}">
                                        <i class="fa fa-arrow-right btn btn-primary"></i>
                                    </a>
                                @else
                                    <i class="fa fa-arrow-right btn btn-primary disabled"></i>
                                @endif
                            </div>
                        </div>
                        <h5 class="function_title text-dark">Function</h5>
                            {!! $function_description ?? '' !!}
                        <div class="product_description">
                            <div class="accordion" id="product_accordion">
                                <div class="accordion-item mb-2">
                                    <h5 class="function_title mb-0">
                                        <button 
                                            class="accordion-button show" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapseOne" 
                                            aria-expanded="true" 
                                            aria-controls="collapseOne">
                                            Product Description
                                        </button>
                                    </h5>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#product_accordion">
                                        <div class="accordion-body">
                                            {!! $product_description ?? '' !!}                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item mb-2">
                                    <h5 class="function_title mb-3">
                                        <button 
                                            class="accordion-button collapsed" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapseTwo" 
                                            aria-expanded="true" 
                                            aria-controls="collapseOne">
                                            Product information
                                        </button>
                                    </h5>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#product_accordion">
                                        <div class="accordion-body">                                        
                                            {!! $product_information ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                                            
                        </div>
                        <h5 class="product_description mt-md-3"></h5>
                        <!-- Add more product information here -->
                    </div>
                </div>
                <div class="col-md-12 pt-md-5 delievery_types">
                    <h4 class="product_heading text-start pb-md-1"><span class="our">Modes </span>of Delivery:</h4>
                    <p>
                        We supply material by road, sea and air depending upon the nature of chemical and shipping requirement.
                    </p>
                </div>
                </div>
            </div>
        </section>
        
        <section class="white_section product_info product-section pb-md-5 product_filter_gallery">
            <div class="container">
                <div class="row">
                    <h2 class="product_heading text-start pb-md-1"><span class="our">Related </span>Products</h2>
                    @foreach($related_products as $related_product)
                        <div class="col-md-3 product_filter_gallery_div">
                            <div class="card">
                                <img src="{{ asset('storage/' . $related_product->image) }}" alt="{{ $related_product->title }}" class="product_card_image card-img-top">
                                <div class="card-body d-flex">
                                    <a href="{{ route('product.detail', $related_product->slug) }}" class="d-flex align-items-center justify-content-between text-decoration-none w-100">
                                        <p class="card-text">{{ $related_product->title }}</p>
                                        <i class="btn btn-primary fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>


@endsection