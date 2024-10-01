@extends('frontend.layouts.app')

@section('page.title', $page_name)
@section('page.description', $meta_description)

@section('page.content')
  
<main class="product_categories_page">

<section class="banner" id="product_categories_banner_img">
    <div class="container">
        <div class="banner_heading_div text-center">
            <h2 class="text-light banner_heading_text">{{$page_name}}</h2>
            <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                <li class="list-group-item"><a href="{{ route('index') }}">Home</a></li> > 
                <li class="list-group-item"><p class="mb-0">{{$page_name}}</p></li>
            </ul>
        </div>
    </div>
</section>

<section class="white_section career_contact_form">
    <div class="container py-md-5">
        <div class="row">
            
                <div class="col-md-12">
                    {!! $content ?? '' !!}
                </div>
        </div>

    </div>
</section>

</main>
@endsection
