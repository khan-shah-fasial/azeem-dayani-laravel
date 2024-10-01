@extends('frontend.layouts.app')

@section('page.title', 'Products')

@section('page.content')
  
<main class="product_categories_page">

<section class="banner" id="product_categories_banner_img">
    <div class="container">
        <div class="banner_heading_div text-center">
            <h2 class="text-light banner_heading_text">Products</h2>
            <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                <li class="list-group-item"><a href="{{ route('index') }}">Home</a></li> > 
                <li class="list-group-item"><p class="mb-0">Products</p></li>
            </ul>
        </div>
    </div>
</section>

<section class="white_section gallery_filter">
    <div class="container py-md-5">
        <div class="row">
            <div class="col-md-3 sidebar">                
                <form action="{{ route('products_s') }}" method="GET" id="searchForm">
                    <div class="search-bar-filter">
                        <button type="submit" class="btn search_btn me-2">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" name="search" class="product-search form-control" placeholder="Search for Product" value="{{ request('search') }}">
                    </div>    
                    <div class="d-flex justify-content-between">
                        <ul class="list-group filter_list">
                            <li onclick="viewAllCategories()" class="cursor-pointer list-group-item @if($categoryId == '') active @endif">
                                View All Categories
                            </li>
                            @foreach($productCategories as $category)
                                <li onclick="submitCategoryForm({{ $category->id }})"
                                    class="cursor-pointer list-group-item @if($category->id == $categoryId) active @endif">
                                    {{ $category->title }}
                                </li>
                            @endforeach
                        </ul>
                        <input type="hidden" name="category_id" id="category_id" value="{{ $categoryId }}">
                    </div>
                </form>
            </div>
            <div class="col-md-9 product_filter_gallery">
                @if($products->isEmpty())
                    <p class="text-center">No products available.</p>
                @else
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4 product_filter_gallery_div">
                                <a href="{{ route('product.detail', $product->slug) }}" class="d-block text-decoration-none">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="product_card_image card-img-top">
                                        <div class="card-body d-flex align-items-center justify-content-between">
                                            <p class="card-text">{{ $product->title }}</p>
                                            <i class="btn btn-primary fa fa-arrow-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination Links -->
                    <div class="col-12 text-center pt-md-4">
                        {{ $products->appends(['category_id' => $categoryId])->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@section('page.scripts')
<script>
function submitCategoryForm(categoryId) {
    // Set the category_id hidden field value
    document.getElementById('category_id').value = categoryId;

    // Clear the search input field using getElementsByClassName
    var searchInputs = document.getElementsByClassName('product-search');
    if (searchInputs.length > 0) {
        searchInputs[0].value = '';
    }

    // Submit the form using getElementsByClassName
    var searchForm = document.getElementsByClassName('searchForm');
    if (searchForm.length > 0) {
        searchForm[0].submit();
    }
}

function viewAllCategories() {
    // Clear the search input field using getElementsByClassName
    var searchInputs = document.getElementsByClassName('product-search');
    if (searchInputs.length > 0) {
        searchInputs[0].value = '';
    }

    // Clear the category_id hidden field
    document.getElementById('category_id').value = '';

    // Submit the form using getElementsByClassName
    var searchForm = document.getElementsByClassName('searchForm');
    if (searchForm.length > 0) {
        searchForm[0].submit();
    }
}


</script>
@endsection
