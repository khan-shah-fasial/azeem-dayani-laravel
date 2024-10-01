@php
    $allpages = DB::table('pages')
    ->where('type', '!=', 'home_page') // Exclude pages with type 'home_page'
        ->select('title', 'slug')
        ->limit(10)
        ->get();
        
    $footer = DB::table('frontend_settings')->where('id', 1)->first(); // Use `first()` instead of `get()` to get a single record
    $contacts = json_decode($footer->contacts);
    $social_media = json_decode($footer->social_media);
    $pdf = $footer->pdf;
@endphp


<footer class="footer bg-dark text-light pt-lg-5 pt-md-4 py-3 pb-md-3">
        <div class="container">
            <div class="row">
                {{-- <!-- Locations Section -->
                <div class="col-lg-4 col-md-6 footer_location_div">
                    <h5 class="pb-lg-4 pb-3 footer_location_heading">Locations</h5>
                    <p class="d-flex align-items-start gap-2 footer_location_1 pb-3">
                        <img class="location_flags" src="/assets/frontend/images/flag_india.png" alt="indian flag">
                        <span class="text-light location_text"> 
                            {{$contacts[0]->address}}
                        </span> 
                    </p>
                    <p class="d-flex align-items-start gap-2 footer_location_2 pb-3">
                        <img class="location_flags" src="/assets/frontend/images/flag_brazil.png" alt="brazilian flag">
                        <span class="text-light location_text"> 
                            {{$contacts[1]->address}} 
                        </span> 
                    </p>
                    <div class="d-flex gap-2 pb-3">
                        <i class="fa fa-phone"></i>
                        <span>
                            <h6 class="d-block mb-0">Overseas Business Enquiries: <br>
                            </h6> 
                                <a href="tel:{{$contacts[1]->phone1}}" class="footer_contact_links">
                                    {{$contacts[1]->phone1}} 
                                </a>
                        </span>
                    </div>
                </div>
    
                <!-- Contact Info Section -->
                <div class="col-lg-3 col-md-5 footer_contact_div ps-md-0 py-2">
                    <h5 class="pb-lg-4 pb-md-2 pb-1 footer_contact_heading">Contact Info</h5>
                    <div class="d-flex align-items-start gap-2 pb-lg-3 pb-2">
                        <i class="fa fa-phone"></i>
                        <span>Mobile Number: <br>
                            <a href="tel:{{$contacts[0]->phone1}}" class="footer_contact_links">
                            {{$contacts[0]->phone1}}
                            </a>
                        </span> 
                    </div>
                    <div class="d-flex align-items-start gap-2 pb-lg-3 pb-2">
                        <i class="fa fa-phone"></i>
                        <span>Landline Number: <br>
                            <a href="tel:{{$contacts[0]->phone2}}" class="footer_contact_links">
                                {{$contacts[0]->phone2}} 
                            </a>/
                            <a href="tel:{{$contacts[0]->phone3}}" class="footer_contact_links">
                                {{$contacts[0]->phone3}} 
                            </a>
                         
                        </span> 
                    </div>
                    <div class="d-flex align-items-md-start align-items-center gap-2 pb-3">
                        <i class="fa fa-envelope"></i>
                            <a href="mailto:{{$contacts[0]->email1}}" class="footer_contact_links">
                            {{$contacts[0]->email1}}
                            </a>
                    </div>
                </div>
    
                <!-- Useful Links Section -->
                <div class="col-lg-2 col-6 footer_useful_link_1_div ps-md-3">
                    <h5 class="pb-lg-4 pb-md-2 pb-1 footer_useful_link_1_heading">Useful Links</h5>
                    <ul class="list-group-item list-unstyled">
                        @foreach ($allpages as $page)
                        <li class="list-item">
                            <a href="{{ url(route('page.detail',$page->slug)) }}">
                                {{ $page->title }}
                            </a>
                        </li>
                        @endforeach
                        <li class="list-item"><a class="footer_useful_link_1_links" href="{{route('career')}}">Career</a></li>
                        <li class="list-item"> <a href="{{route('products_category')}}" class="footer_useful_link_1_links">Industry Areas</a> </li>
                        <li class="list-item"> <a href="{{route('contact_us')}}" class="footer_useful_link_1_links">Contact Us</a> </li>
                    </ul>
                </div> --}}

                <div class="col-lg-3 col-5 footer_useful_link_2_div">
                <h5 class="pb-lg-4 pb-md-2 pb-1 footer_useful_link_2_heading">Useful Links</h5>
                    <ul class="list-group-item list-unstyled">
                        <li class="list-item"> <a href="{{route('products_category')}}" class="footer_useful_link_2_links">Chemicals Imports & Exports</a> </li>
                        <li class="list-item"> <a href="{{route('products_category')}}" class="footer_useful_link_2_links">Supply Chain Solutions</a> </li>
                        <li class="list-item"> <a href="{{route('products_category')}}" class="footer_useful_link_2_links">Supply Chain Partner</a> </li>
                        <li class="list-item">
                            @if (isset($social_media) && !empty($social_media))
                            <ul class="list-group-item list-unstyled d-flex gap-4 social_media_icon pt-lg-5">
                                @foreach ($social_media as $index => $row )
                                <li class="list-item"> 
                                    <a href="{{ $row->url}}" class="footer_useful_link_2_links" aria-label="social media links">
                                        {!! $row->icon !!}
                                    </a> 
                                </li>
                                @endforeach                                
                            </ul> 
                            @endif                       
                        </li>
                    </ul>
                </div>
            </div>

            <br class="d-md-block d-none">
            <hr>
            <div class="pt-md-2 footer_copyright text-center">
                <span class="copyright_content"> © Copyright - Sagar Speciality Chemicals Pvt. Ltd. | Designed by Nexgeno</span>
            </div>
        </div>
    </footer>

    
    <div class="sidebar_instant_links">
          <div class="sidebar_social_media">
            @if (isset($social_media) && !empty($social_media))
                <ul class="list-group-item list-unstyled mb-0 mt-1">
                    @foreach ($social_media as $index => $row )
                    <li class="list-item"> 
                        <a href="{{ $row->url}}" class="sidebar_social_media_link" aria-label="sidebar social media links">
                            {!! $row->icon !!}
                        </a> 
                    </li>
                    @endforeach                                
                </ul> 
            @endif               
          </div>
          @if(!empty($pdf)) 
            <a href="{{ asset('storage/' . $pdf) }}" download="{{ asset('storage/' . $pdf) }}" class="newsletter-download-link text-white">
                <div class="newsletter">
                    <div class="d-flex position-relative rotate-90">
                        <label class="file-upload-label" for="fileUpload">NewsLetter
                            <i class="fa fa-file-arrow-down"></i>
                        </label>                
                    </div>
                </div>
            </a>
          @endif
      </div>