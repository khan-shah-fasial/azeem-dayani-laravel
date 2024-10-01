@extends('frontend.layouts.app')

@section('page.title', 'Saagar')

@section('page.description', 'description')

@section('page.type', 'website')

@section('page.content')
  
<main class="career_page">

<section class="banner" id="career_banner_img">
    <div class="container ">
        <div class="banner_heading_div text-center">
            <h2 class="text-light banner_heading_text">Career</h2>
            <ul class="list-group list-unstyled list-group-horizontal banner_heading_breadcrumb">
                <li class="list-group-item"><a href=""><i class="fa fa-house text-light"></i></a></li>
                <li class="list-group-item"><a href="{{route('index')}}">Home</a></li> > 
                <li class="list-group-item"><p class="mb-0">Career</p></li>
            </ul>
        </div>                
    </div>
</section>

<section class="white_section career_contact_form py-lg-5 py-md-4 py-3 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pe-lg-5 pb-3">
                <div class="col-md-12 contact_us_form career_form bg-transparent text-md-start text-center">
                    <h4 class="col-md-12 product_heading text-start pb-md-3 float-start">
                        Enroll Now
                    </h4><br>
                    <form id="add_career_form" action="{{ route('form.save') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="form_type" value="career">

                        <div class="col-md-12 mb-lg-4 mb-3">                                
                            <input required type="text" name="full_name" class="form-control" placeholder="Full Name*">
                        </div>
                        <div class="row col-md-12 mb-lg-2 mb-md-0 mb-0 ms-md-0">
                            <div class="col-md-6 mb-md-3 mb-3 px-md-0 pe-md-3">                                    
                                <input required type="email" name="email" class="form-control" placeholder="Email Address*">
                            </div>
                            <div class="col-md-6 mb-3 mb-md-3 mb-0 ps-md-3 pe-md-0">                                    
                                <input required type="tel" name="mobile" class="form-control" placeholder="Mobile*">
                            </div>
                        </div>
                        <div class="col-12 mb-lg-4 mb-3">                                    
                            <input required type="text" class="form-control" name="apply_for" placeholder="Apply For*">
                        </div> 
                        <textarea class="col-12 mb-lg-3 mb-2" name="message" placeholder="Message"></textarea>
                        
                        <div class="col mb-lg-4 mb-3">                                    
                            <input required type="text" class="form-control" name="type_code" placeholder="Type Code*">
                        </div>                                
                        <button type="submit" class="">SUBMIT</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 ps-md-5">
                <img class="right_img what_we_do_img pe-lg-3" src="/assets/frontend/images/career/career_form_right_img.png">
            </div>
        </div>
    </div>
</section>
</main>


@endsection
@section('page.scripts')

<script>
    $(document).ready(function () {
        initValidate('#add_career_form');
        
        $('#add_career_form').submit(function (e) {
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