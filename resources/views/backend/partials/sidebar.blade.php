
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu menuitem-active">

                <!-- Brand Logo Light -->
                <a href="#" class="logo-light">
                    <span class="logo-lg">
                        {{-- <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo" style="width:170px; height:auto;" > --}}
                        <h4 class="about_main_name footer_logo_text">{{ $logo }}</h4>
                    </span>
                    <span class="logo-sm">
                        {{-- <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo" style="width:170px; height:auto;" > --}}
                        <h4 class="about_main_name footer_logo_text">{{ $logo }}</h4>
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="#" class="logo-dark">
                    <span class="logo-lg">
                        {{-- <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo" style="width:170px; height:auto;" > --}}
                        <h4 class="about_main_name footer_logo_text">{{ $logo }}</h4>
                    </span>
                    <span class="logo-sm">
                        {{-- <img class="header_logo" src="{{ asset('storage/' . $logo) }}" alt="Sagar Logo" style="width:170px; height:auto;" > --}}
                        <h4 class="about_main_name footer_logo_text">{{ $logo }}</h4>
                    </span>
                </a>

                <!-- Sidebar Hover Menu Toggle Button -->
                <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Show Full Sidebar" data-bs-original-title="Show Full Sidebar">
                    <i class="ri-checkbox-blank-circle-line align-middle"></i>
                </div>

                <!-- Full Sidebar Menu Close Button -->
                <div class="button-close-fullsidebar">
                    <i class="ri-close-fill align-middle"></i>
                </div>

                <!-- Sidebar -left -->
                <div class="h-100 show" id="leftside-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                    <!-- Leftbar User -->
                    <div class="leftbar-user">
                        <a href="#">
                            <img src="/assets/images/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name mt-2">{{ auth()->user()->name }}</span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title">Navigation</li>

                        <li class="side-nav-item"> <!--menuitem-active-->
                            <a href="{{ route('backend.dashboard') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>

                        {{-- <li class="side-nav-item">
                            <a href="{{ route('contact.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-bar-chart-2-line"></i> 
                                <span> Leads </span>
                            </a>
                        </li> --}}



                        {{--
                        <li class="side-nav-item">
                            <a href="{{ route('mediacoverage.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-clapperboard-line"></i> 
                                <span> Media Coverage </span>
                            </a>
                        </li> 

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="{{ url('#sidebarEmail2') }}" aria-expanded="false" aria-controls="sidebarEmail2" class="side-nav-link">
                                <i class="ri-article-line"></i>
                                <span> Page </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail2">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('setting.privacy') }}">Privacy Policy Page</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('setting.terms') }}">Terms & Conditions Page</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('setting.refund_policy') }}">Refund Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="side-nav-item">
                            <a href="{{ route('faq.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-questionnaire-line"></i> 
                                <span> FAQs </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ route('testimonial.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-discuss-line"></i>                                
                                <span> Testimonials </span>
                            </a>
                        </li>--}}





                        {{-- <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="{{ url('#sidebarEcommerce') }}" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="ri-article-line"></i>
                                <span> Posts </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('blogs.index') }}">All Posts</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogcategory.index') }}">Category</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogcomment.index') }}">Comment</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('author.index') }}">Author</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li class="side-nav-item">
                            <a href="{{ route('website.pages') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-discuss-line"></i>                                
                                <span> Pages </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="{{ url('#sidebarEmail') }}" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                                <i class="ri-article-line"></i>
                                <span> Film manage </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ route('products.index') }}">Film Listing</a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ route('product-categories.index') }}">Film Categories</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </li>
                        

                        <li class="side-nav-item">
                            <a href="{{ route('frontend_settings.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-discuss-line"></i>                                
                                <span> Front Website Setting </span>
                            </a>
                        </li>

                        {{-- <li class="side-nav-item">
                            <a href="{{ route('setting.index') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="ri-settings-2-line"></i>                                
                                <span> Setting </span>
                            </a>
                        </li> --}}
                    </ul>
                    <!--- End Sidemenu -->

                    <div class="clearfix"></div>
                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 2064px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 240px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
            </div>
            <!-- ========== Left Sidebar End ========== -->