@extends('frontend.layouts.app')

@section('page.title', 'Contact us')

@section('page.description', 'Saagar Contact Us Page')

@section('page.type', 'website')

@section('page.content')
  
<main class="contact_us_page">
        
        <section class="banner" id="contact_us_page_banner">
            <div class="container ">
                <div class="banner_heading_div text-center">
                    <h2 class="text-light banner_heading_text">Contact Us</h2>
                    <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                        <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                        <li class="list-group-item"><a href="{{route('index')}}">Home</a></li> > 
                        <li class="list-group-item"><p class="mb-0">Contact Us</p></li>
                    </ul>
                </div>                
            </div>
        </section>

        <section class="white_section address_and_map py-md-5 py-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 contact_info pe-md-4">
                        <h2 class="product_heading saagar_specialty text-start pb-md-3 float-start">
                            <span class="our">
                                Sagar Speciality 
                                Chemicals Pvt. Ltd.
                            </span>
                        </h2>
                        <div class="col-12 d-flex align-items-start gap-2 footer_location_1">
                            <img class="location_flags mt-1" src="/assets/frontend/images/flag_india.png">
                            <p class="pb-md-1 location_text"> 
                                {{$contacts[0]->address}} 
                            </p> 
                        </div>

                        <div class="d-flex flex-lg-row flex-column col-12 mb-md-0 mb-3">
                            <div class="col-lg-4 d-flex align-items-start gap-2 pb-md-3">
                                <i class="fa fa-phone mt-2"></i>
                                <div class="d-block">
                                    <span>Mobile Number: </span><br>
                                    <a href="tel:{{$contacts[0]->phone1}}" class="fw-500">{{$contacts[0]->phone1}}</a>
                                </div> 
                            </div>
                            <div class="col-lg-8 d-flex align-items-start justify-content-lg-center justify-content-start gap-2 pb-md-3">
                                <i class="fa fa-phone mt-2"></i>
                                <div class="d-block">
                                    <span>Landline Number: </span>  <br>
                                    <a href="tel:{{$contacts[0]->phone2}}" class="fw-500">{{$contacts[0]->phone2}} </a> /
                                    <a href="tel:{{$contacts[0]->phone3}}" class="fw-500">{{$contacts[0]->phone3}}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex align-items-cemter gap-2 pb-md-3 mb-md-0 mb-3">
                            <i class="fa fa-envelope mt-1"></i>
                            <a href="mailto:{{$contacts[0]->email1}}" class="fw-500">
                                {{$contacts[0]->email1}}
                            </a>
                        </div>

                        <div class="d-flex align-items-start gap-2 pt-lg-4">
                            <img class="location_flags mt-1" src="/assets/frontend/images/flag_brazil.png">
                            <p class="text-dark mb-3 pb-2 location_text"> 
                                {{$contacts[1]->address}}  
                            </p> 
                        </div>
                        <div class="d-flex gap-2 mb-md-0 mb-3">
                            <i class="fa fa-phone mt-2"></i>
                            <div class="block">
                                <span class="d-block mb-0">Overseas Business Enquiries: <br>
                                </span> 
                                    <a href="tel:{{$contacts[1]->phone1}}" class="mt-2">
                                        {{$contacts[1]->phone1}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 mb-md-0 mb-4">
                            <iframe 
                                src="{{$contacts[0]->google_map}}" 
                                width="100%" 
                                height="440" 
                                style="border:0; border-radius: 50px;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>

                    </div>

                    <div class="col-md-12 p-lg-5 p-md-4 p-3 contact_us_form mt-lg-5 mt-md-4 text-md-start text-center">
                        <h2 class="col-md-12 product_heading text-start pb-md-1 text-md-start text-center">
                            <span class="our">Enquiry</span>
                        </h2>
                        <br class="d-lg-block d-none">
                        <h5 class="form_mark">All fields marked as * are mandatory</h5>
                        <form id="add_contact_us_form" action="{{ route('form.save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form_type" value="contact_us">
                            <div class="col-md-12 mb-md-4 mb-3">      
                                <input required type="text" name="full_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="d-flex flex-md-row flex-column col-md-12 mb-2">
                                <div class="col-md-6 mb-3 pe-md-2">                                    
                                    <input required type="email" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-3 ps-md-2">                                    
                                    <input required type="tel" name="mobile" class="form-control" placeholder="Mobile">
                                </div>
                            </div>
                                <textarea class="col-12 mb-3" name="message" id="" rows="4" placeholder="Message"></textarea>
                            <button type="submit" class="">SEND</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main> 


@endsection
@section('page.scripts')

<script>
    $(document).ready(function () {
        initValidate('#add_contact_us_form');
        
        $('#add_contact_us_form').submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.notification, 'Success');

                        // Clear form fields
                        form[0].reset();
                    } else {
                        // toastr.error(response.notification.join('<br>'), 'Validation Error');
                        // Number the error messages
                        let errorMessages = response.notification.map((message, index) => (index + 1) + '. ' + message).join('<br>');
                        toastr.error(errorMessages, 'Validation Error');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('An unexpected error occurred. Please try again later.', 'Error');
                }
            });
        });
    });
</script>


@endsection