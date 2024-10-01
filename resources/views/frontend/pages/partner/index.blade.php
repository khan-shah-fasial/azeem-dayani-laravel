@extends('frontend.layouts.app')

@section('page.title', $page->meta_title)

@section('page.description', $page->meta_description)

@section('page.type', 'website')

@section('page.content')
@php
    if (!empty($page->content)) {
        $data = $page->content;
        $decoded_data = json_decode($data);

        /*
        echo '<pre>';
        print_r($decoded_data);
        echo '</pre>';
        exit();
        */
        
        $about_content = $decoded_data->about_content ?? '';
        $faqs = $decoded_data->faqs ?? '';


    } else {
        // If content is empty, set default empty values
        $about_content =  '';
        $faqs =  '';
    }
@endphp
<main class="enquire_page">

    <section class="first_section bg_smoky_img">
        <div class="container enquiry_section">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 left_section text-light">
                    {!! $about_content !!}
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="col-12 right_section">
                        <h3 class="fs-24" >Enquire Now</h3>
                        <form id="add_partner_us_form" action="{{ route('form.save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form_type" value="partner_us">

                            <input required type="text" name="company_name" class="form-control" placeholder="Company Name">
                            <input required type="text" name="full_name" class="form-control" placeholder="Full Name">
                            <div class="custom-dropdown">
                                <select required name="product" class="form-control custom-select">
                                    <option value="">Select Product*</option>
                                    <option value="vinyl">Vinyl</option>
                                    <option value="ethelene">Ethelene</option>
                                    <option value="methyl">Methyl</option>
                                    <option value="acetone">Acetone</option>
                                    <!-- Add your options here -->
                                </select>
                            </div>
                            <!-- <input required type="tel" name="mobile" class="form-control" placeholder="Mobile"> -->
                            <input type="number" class="form-control" placeholder="Quantity">
                            <input required type="email" name="email" class="form-control" placeholder="Email Address">
                            <!-- <input type="text" class="form-control" placeholder="Type Code">
                            
                            <div>
                                <img src="captcha_image.jpg" alt="CAPTCHA" class="img-fluid">
                            </div> -->
                            <textarea class="col-12 mb-3" name="message" id="message" placeholder="Message" rows="2"></textarea>
                            <button type="submit" class="btn btn-primary mt-md-3 mt-0">SEND</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($faqs))
    <section class="white_section faq py-lg-5 pb-md-3">
        <div class="container ">
            <h2 class="product_heading text-center pb-md-5 pb-2">Frequently Asked<span class="our"> Question</span></h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 accordion mb-md-3" id="faq_accordion">
                @foreach ($faqs as $index => $faq)
                    <div class="col">
                        <div class="accordion-item mb-2">
                            <h5 class="function_title mb-lg-3 mb-md-1 mb-0">
                                <button 
                                    class="accordion-button show" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{$index}}" 
                                    aria-expanded="true" 
                                    aria-controls="collapse{{$index}}">
                                    {{$faq->question}}
                                </button>
                            </h5>
                            <div id="collapse{{$index}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$index}}" data-bs-parent="#product_accordion">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</main>

    @endsection
    @section('page.scripts')

    <script>
        $(document).ready(function () {
            initValidate('#add_partner_us_form');
            
            $('#add_partner_us_form').submit(function (e) {
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