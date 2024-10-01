@extends('frontend.layouts.app')

@section('page.title', 'Product Categories')

@section('page.content')
  
<main class="product_categories_page">

<section class="banner" id="product_categories_banner_img">
    <div class="container">
        <div class="banner_heading_div text-center">
            <h2 class="text-light banner_heading_text">Product Categories</h2>
            <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                <li class="list-group-item"><a href="{{ route('index') }}">Home</a></li> > 
                <li class="list-group-item"><p class="mb-0">Product Categories</p></li>
            </ul>
        </div>
    </div>
</section>

<section class="white_section career_contact_form py-lg-5 py-3">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($productCategories as $category)
                <div class="col-lg-3 col-md-4 col-6 our_product_cards_div">
                    <a href="{{ route('products_s', ['category_id' => $category->id]) }}" class="d-flex align-items-center justify-content-md-between text-decoration-none w-100">
                        <div class="card">
                            {{--
                            @if (!empty($category->image))
                                <img src="{{ asset('storage/' . $category->image) }}" alt="" class="product_card_image card-img-top">
                            @endif
                            --}}
                            <div class="card-body d-flex">
                                <p class="card-text">{{ $category->title }}</p>
                                <i class="btn btn-primary fa fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row">
            <div class="col-12 text-center pt-md-4 pt-4">
                {{ $productCategories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>

</main>
@endsection
