@extends('frontend.layouts.app')

@section('page.title', 'Contact us')

@section('page.description', 'Saagar Contact Us Page')

@section('page.type', 'website')

@section('page.content')

    <main id="contact_page">
        <section class="animate-contact-first-section contact_heading_n_form bg_green pt-md-5 pt-4">
            <div class="contact_heading_div text-center">
                <h1 class="contact_main_name text-light contact_heading mb-0">
                    contact
                </h1>
                <!-- <h1 class="section_title">HIS WORK</h1> -->
                <img class="scale-img-contact contact_us_heading_img" src="/assets/frontend/images/contact-us/Headphone.png" />
            </div>
            <div class="container-fluid pt-md-5">
                <div class="row">
                    <div class="col-md-6 px-0 azeem_dayani_contact_us_long_img_div">
                        <img class="reveal-img-toptobottom-contact azeem_dayani_contact_us_long_img" src="{{ asset('storage/' . $image) }}" style="clip-path: polygon(0px 0px, 100% 0px, 100% 100%, 0px 100%);">
                    </div>
                    <div class="col-md-6 px-0 object_bg_img">
                        <div class="zip_zap_bg_img_container">
                            <img class="zig-zag-img zip_zap_bg_og_img" src="/assets/frontend/images/Homepage/Object_3.png" />
                        </div>
                        <div class="col-lg-10 col-md-12 contact_form contact_form_animate p-lg-5 p-md-4">
                            <h4 class="form_heading">get in touch</h4>
                            <form id="add_contact_us_form" action="{{ route('form.save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                                <div class="mb-md-4 mb-3">
                                    <input type="text" name="full_name" class="form-control" placeholder="Name" required />
                                </div>
                                <div class="mb-md-4 mb-3">
                                    <input type="text" name="mobile" class="form-control" placeholder="Contact" required
                                        maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                </div>
                                <div class="mb-md-4 mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email Id" required />
                                </div>
                                <div class="mb-md-4 mb-3">
                                    <textarea class="form-control" name="message" rows="3" placeholder="Message" required></textarea>
                                </div>
                                <button type="submit" class="btn submit_btn">SUBMIT</button>
                            </form>
                        </div>
                        <!-- <div class="contact_details">
                              <h2 class="contact_details_heading"><span class="lets">Let's </span>do the thing</h2>
                              <div class="d-flex align-items-center gap-4 text-light mb-3 phone">
                                  <a href="tel:+91-12345 56798">
                                      <img class="font_img" src="/assets/frontend/images/contact-us/Contact.png">
                                      +91-12345 56798
                                  </a>
                              </div>
                              <div class="d-flex align-items-center gap-4 text-light mb-3 mail">
                                  <a href="mailto:info@azeemdayani.com">
                                      <img class="font_img" src="/assets/frontend/images/contact-us/Message.png">
                                      info@azeemdayani.com
                                  </a>
                              </div>
                          </div>  -->
                        <div class="contact_buffer_div">
                            <h3 class="heading-anim buffering_text">Buffering</h3>
                            <img class="scaleup-element contact_headphone_image" src="/assets/frontend/images/contact-us/Headphone_2.png" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection
@section('page.scripts')

<script>
    $(document).ready(function() {
        initValidate('#add_contact_us_form');
        $("#add_contact_us_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            $('input, textarea').val('');
            $("select option:first").prop('selected', true);
            setTimeout(function() {
               location.reload();
            }, 5000);
        }
    });
</script>

@endsection

