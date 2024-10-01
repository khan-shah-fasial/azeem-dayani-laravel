@php
$allpages = DB::table('pages')
        ->where('type', '!=', 'custom_page')
        ->where('type', '!=', 'home_page')
        ->where('type', '!=', 'about_us')
        ->select('title', 'slug', 'type')
        ->limit(10)
        ->get();

    $footer = DB::table('frontend_settings')->where('id', 1)->first(); // Use `first()` instead of `get()` to get a single record
    $logo = $footer->logo ?? '';
@endphp
<header id="mainHeader" class="header pb-lg-2 pt-md-0 py-md-0 py-2">
      <div class="container">
          <div class="d-flex flex-column">
              <div class="top_bar col-12 pt-md-3 pt-2 d-lg-block d-none">                
                  <ul class="list-group list-group-horizontal list-unstyled">
                        <li class="nav-item dropdown google_translate_desktop">
                            <a class="inline-box nav-link " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <!-- <i class="text-light fa-solid fa-language"></i> -->
                                <!--<div id="google_translate_element" style="/*display: inline-block;*/"></div>-->
                                <div class="gtranslate_wrapper"></div>
                                <!-- <div class="gtranslate_wrapper">
                                    <div class="gt_switcher">
                                        <div class="gt_current">
                                            <img src="https://cdn.gtranslate.net/flags/svg/en.svg" alt="English Flag" class="gt_flag">
                                            <span class="gt_lang">English</span>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <ul class="gt_dropdown">
                                            <li data-lang="en">
                                                <img src="https://cdn.gtranslate.net/flags/svg/en.svg" alt="English Flag" class="gt_flag">
                                                <span class="gt_lang">English</span>
                                            </li>
                                            <li data-lang="es">
                                                <img src="https://cdn.gtranslate.net/flags/svg/es.svg" alt="Spanish Flag" class="gt_flag">
                                                <span class="gt_lang">Español</span>
                                            </li>
                                            <li data-lang="pt">
                                                <img src="https://cdn.gtranslate.net/flags/svg/pt.svg" alt="Portuguese Flag" class="gt_flag">
                                                <span class="gt_lang">Português</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> -->
                            </a>
                        </li>                      
                        <!-- <li class="list-group-item">
                            <a class="nav-link" href="#">ENG</a>
                        </li> -->
                        <li class="list-group-item">
                            <a class="nav-link" href="#"><i class="fa fa-linkedin-in" role="link" aria-label="linkedin logo"></i></a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link" href="#"><i class="fa fa-instagram" role="link" aria-label="instagram logo"></i></a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link" href="#"><i class="fa fa-x-twitter" role="link" aria-label="x-twitter logo"></i></a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link" href="#"><i class="fa fa-facebook" role="link" aria-label="facebook logo"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="menu">                    
                    <nav class="navbar d-none d-lg-inline navbar-expand-lg navbar-dark py-lg-0">
                        <div class="container">
                            <a class="navbar-brand" href="{{route('index')}}">
                                <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-label="Toggler">
                                <span class="navbar-toggler-icon"></span>
                            </button>                           
                           
                          <!-- N A V B A R     S T A R T -->
                          
                            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">                                
                                <ul class="navbar-nav">     
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('products_s')}}">Products</a>
                                    </li>       
                                    <li class="nav-item dropdown">
                                        <a class="nav-link me-1" href="{{route('about_us')}}">Company Profile</a>
                                        <ul class="submenu">
                                                <li>
                                                    <a href="" class="sub_menu"> scss</a>
                                                </li>
                                                <li>
                                                    <a href="" class="sub_menu"> jquery</a>
                                                </li>
                                                <li>
                                                    <a href="" class="sub_menu"> html</a>
                                                </li>
                                        </ul>
                                        <i class="fa fa-angle-down"></i>
                                    </li>  
                                    @foreach ($allpages as $page)
                                        <li class="nav-item">
                                            <a class="nav-link" 
                                            href="@if($page->type == 'home_page'){{ route('index')}} @else {{ url(route('page.detail', $page->slug)) }} @endif">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('career')}}">Career</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('contact_us')}}">Contact Us</a>
                                    </li>
                                    <li class="list-group-item">
                                        <form action="{{ route('products_s') }}" method="GET" class="searchForm position-relative" id="searchForm">
                                            <div class="search-icon-wrapper">
                                                <button type="button" class="btn search-icon" onclick="toggleSearchBar()" aria-label="search btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                            <div class="search-bar d-none">
                                                <input type="text" class="product-search" name="search" id="searchInput" class="form-control" placeholder="Search for Product..." value="{{ request('search') }}">
                                                <input type="hidden" name="category_id" id="category_id" value="">
                                                <button type="submit" class="btn search_btn search_btn_2" aria-label="search btn 2">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </li>
                                    <!-- <a class="nav-link" href="#"><i class="fa fa-search text-light"></i></a> -->
                                <!-- </li> -->
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <!-- navbar for mobile -->

                    <nav class="navbar d-lg-none d-block">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{route('index')}}">
                                <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo">
                            </a>
                            <div class="nav-item dropdown google_translate_tab ">
                                <a class="inline-box nav-link " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <!-- <i class="text-light fa-solid fa-language"></i> -->
                                    <!--<div id="google_translate_element" style="/*display: inline-block;*/"></div>-->
                                    <div class="gtranslate_wrapper"></div>
                                </a>
                            </div> 
                            <form action="{{ route('products_s') }}" method="GET" class="searchForm position-relative">
                                <div class="search-icon-wrapper">
                                    <button type="button" class="btn search-icon" onclick="toggleSearchBar2()" aria-label="search btn 3">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="search-bar-for-tab d-none">
                                    <input type="text" class="product-search" name="search" class="form-control" placeholder="Search for Product..." value="{{ request('search') }}">
                                    <input type="hidden" name="category_id" id="category_id" value="">
                                    <button type="submit" class="btn search_btn search_btn_2" aria-label="search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="offcanvas bars">
                                <span class="fa fa-bars"></span>
                            </button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                                <div class="offcanvas-header">
                                    <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5> -->
                                    <a class="navbar-brand" href="{{route('index')}}">
                                        <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo">
                                    </a>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" aria-label="bar close"></button>
                                </div>
                                
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav gap-lg-3 mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('products_category')}}">Products</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link me-1" href="{{route('about_us')}}">Company Profile</a>
                                            <ul class="submenu">
                                                <li>
                                                    <a href="" class="sub_menu"> scss</a>
                                                </li>
                                                <li>
                                                    <a href="" class="sub_menu"> jquery</a>
                                                </li>
                                                <li>
                                                    <a href="" class="sub_menu"> html</a>
                                                </li>
                                            </ul>
                                            <i class="fa fa-angle-down"></i>
                                        </li>  
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('partner_with_us')}}">Partner with us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('career')}}">Career</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="">Client</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('contact_us')}}">Contact Us</a>
                                        </li>
                                        <li class="nav-item d-flex justify-content-md-start justify-content-center">
                                            <ul class="mb-2 list-group list-unstyled list-group-horizontal mb-md-0 float-end">
                                                <!-- <li class="list-group-item">
                                                    <a class="nav-link" href="#">ENG</a>
                                                </li> -->
                                                <li class="px-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-linkedin-in" aria-label="linkedin logo"></i></a>
                                                </li>
                                                <li class="px-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-instagram" aria-label="instagram logo"></i></a>
                                                </li>
                                                <li class="px-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-x-twitter" aria-label="x-twitter logo"></i></a>
                                                </li>
                                                <li class="px-2">
                                                    <a class="nav-link" href="#"><i class="fa fa-facebook" aria-label=" facebook logo"></i></a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>                                
                                </div>
                            </div>
                        </div>
                    </nav>
              </div>
          </div>
      </div>

  </header>
  