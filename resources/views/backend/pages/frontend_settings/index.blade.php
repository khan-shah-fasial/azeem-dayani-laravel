@extends('backend.layouts.app')

@section('page.name', 'Setting')

@section('page.content')
<div class="card">
   <div class="card-body">
    
      <div class="row mb-2">
         <div class="col-sm-5">
            <h3>Frontend Setting</h3>
         </div>
      </div> 

      <section>
      <form id="add_frontend_setting_form" action="{{url(route('frontend_settings.update', $settings->id))}}" method="post"
            enctype="multipart/form-data">
            @csrf
            @php
            if(!empty($settings->contacts)){
                $contacts_data = json_decode($settings->contacts);
            }
            if(!empty($settings->social_media)){
                $social_media_data = json_decode($settings->social_media);               
            }
            @endphp

            <div class="row">
                <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : '' }}">

                <div class="col-6 form-group mb-3">
                    <label>Image</label>
                    <input class="form-control" type="file" name="logo" accept=".jpg,.jpeg,.png,.webp" 
                        @if (empty($settings->logo)) required @endif>
                </div>

                @if (!empty($settings->logo))
                    <div class="div-preview-image col-6 form-group mb-3">
                        <input type="hidden" name="existing_logo" value="{{ $settings->logo }}">
                        <img width="180" src="{{ asset('storage/' . $settings->logo) }}">
                    </div>
                @endif

               
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label>Meta Title<span class="red">*</span></label>
                        <input type="text" class="form-control"  maxlength="155" name="meta_title" value="{{ isset($settings->meta_title) ? $settings->meta_title : '' }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Meta Description<span class="red">*</span></label>
                        <textarea class="form-control"  maxlength="255" name="meta_description" rows="3" required>{{ isset($settings->meta_description) ? $settings->meta_description : '' }}</textarea>
                    </div>
                </div>
                
                {{-- <hr>
                <h3>Contact Section</h3>
                @if (!empty($contacts_data))
                    @php
                        $lastindex = is_array($contacts_data) ? count($contacts_data) : $contacts_data->count();
                    @endphp
                    @foreach ($contacts_data as $index => $contact )
                        <div class="row gallery-image-row2">
                            <div class="col-md-9">
                                <div class="form-group row mb-3 ">
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_name">Name</label>
                                        <input type="text" name="contacts_name[]" class="form-control" value="{{ $contact->name }}" required>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_address">Address {{$index + 1}}</label>
                                        <textarea class="form-control"  maxlength="255" name="contacts_address[]" rows="3" required>{{ isset($contact->address) ? $contact->address : '' }}</textarea>
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_google_map">Google Map</label>
                                        <input type="text" name="contacts_google_map[]" class="form-control" value="{{ $contact->google_map }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_email1">Email 1</label>
                                        <input type="email" name="contacts_email1[]" required class="form-control" value="{{ $contact->email1 }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_email2">Email 2</label>
                                        <input type="email" name="contacts_email2[]" class="form-control" value="{{ $contact->email2 }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_email3">Email 3</label>
                                        <input type="email" name="contacts_email3[]" class="form-control" value="{{ $contact->email3 }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_phone1">Phone 1</label>
                                        <input type="text" name="contacts_phone1[]" required class="form-control" value="{{ $contact->phone1 }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_phone2">Phone 2</label>
                                        <input type="text" name="contacts_phone2[]" class="form-control" value="{{ $contact->phone2 }}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label for="contacts_phone3">Phone 3</label>
                                        <input type="text" name="contacts_phone3[]" class="form-control" value="{{ $contact->phone3 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="add-row-col-3-div col-md-3 ">
                                @if ($index === 0 || $index === $lastindex - 1)
                                    <button type="button" class="btn btn-outline-success add-row m-2">Add More +</button>
                                @endif
                                @if ($index > 0)
                                <button type="button" class="btn btn-outline-danger remove-row2 my-2">Remove -</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row gallery-image-row2">
                        <div class="col-md-9">
                            <div class="form-group row mb-3">                                
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_name">Name</label>
                                    <input type="text" name="contacts_name[]" class="form-control" required>
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_address">Address</label>
                                    <textarea class="form-control"  maxlength="255" name="contacts_address[]" rows="3" required></textarea>
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_google_map">Google Map</label>
                                    <input type="text" name="contacts_google_map[]" class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_email1">Email 1</label>
                                    <input type="email" name="contacts_email1[]" required class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_email2">Email 2</label>
                                    <input type="email" name="contacts_email2[]" class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_email3">Email 3</label>
                                    <input type="email" name="contacts_email3[]" class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_phone1">Phone 1</label>
                                    <input type="number" name="contacts_phone1[]" required class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_phone2">Phone 2</label>
                                    <input type="number" name="contacts_phone2[]" class="form-control">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="contacts_phone3">Phone 3</label>
                                    <input type="number" name="contacts_phone3[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="add-row-col-3-div col-md-3 ">
                            <button type="button" class="btn btn-outline-success add-row2 my-2">Add +</button>
                        </div>
                    </div>
                @endif --}}
                

                <hr>
                <h3>Social Media</h3>
                @if (isset($social_media_data) && !empty($social_media_data))     
                    @php
                        $lastindex = is_array($social_media_data) ? count($social_media_data) : $social_media_data->count();
                    @endphp   
                    @foreach ($social_media_data as $index => $row)
                            <div class="row gallery-image-row">
                                <div class="col-md-9">
                                    <div class="form-group row mb-3">  
                                        {{--
                                        <div class="col-6 form-group mb-3">
                                            <label>Icon</label>
                                            <input class="form-control" type="file" name="social_media_icon[]"
                                                accept=".jpg,.jpeg,.png,.webp" @if (empty($row->icon)) required @endif>
                                        </div>
                                        @if (!empty($row->icon))
                                            <div class="div-preview-image col-6 form-group mb-3">
                                                <input type="hidden" name="existing_social_media_icon[]" value="{{ $row->icon }}">
                                                <img width="180" src="{{ asset('storage/' . $row->icon) }}">                                       
                                            </div>
                                        @endif    
                                        --}}
                                        <div class="form-group col-12">
                                            <label for="social_media_icon">Icon</label>
                                            <input type="text" name="social_media_icon[]" class="form-control" value="{{ $row->icon }}" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="social_media_url">URL</label>
                                            <input type="text" name="social_media_url[]" class="form-control" value="{{ $row->url }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-row-col-3-div col-md-3">
                                    @if ($index === 0 || $index === $lastindex - 1)
                                        <button type="button" class="btn btn-outline-success add-row m-2">Add More +</button>
                                    @endif
                                    @if ($index > 0)
                                    <button type="button" class="btn btn-outline-danger remove-row my-2">Remove -</button>
                                    @endif
                                </div>
                            </div>
                    @endforeach
                @else
                    <div class="row gallery-image-row">
                        <div class="col-md-9">
                            <div class="form-group row mb-3">                            
                                <div class="form-group col-6">
                                    <label for="social_media_icon">Icon</label>
                                    <input class="form-control" type="text" name="social_media_icon[]" accept=".jpg,.jpeg,.png,.webp" required>
                                </div>        
                                <div class="form-group col-6">
                                    <label for="social_media_url">URL</label>
                                    <input type="text" name="social_media_url[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="add-row-col-3-div col-md-3">
                            <button type="button" class="btn btn-outline-success add-row my-2">Add +</button>
                        </div>
                    </div>
                @endif
               
                {{-- <div class="col-6 form-group mb-3">
                    <label>PDF</label>
                    <input class="form-control" type="file" name="pdf" @if (empty($settings->pdf)) required @endif>
                    @if (!empty($settings->pdf))
                        <input type="hidden" name="existing_pdf" value="{{ isset($settings->pdf) ? $settings->pdf : '' }}">
                        <a target="_blank" class="mt-2 btn btn-primary" href="{{ asset('storage/' . $settings->pdf) }}"> View PDF</a>
                    @endif
                </div> --}}

                <div class="col-sm-12">
                    <div class="form-group mb-3 text-end">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>

    </section>
    
   </div>
   <!-- end card-body-->
</div>
@endsection

@section("page.scripts")
<script>
    $(document).ready(function() {
        initTrumbowyg('.trumbowyg');
        initSelect2('.select2');
        initValidate('#add_frontend_setting_form');


        // Add row functionality for Banner Section
        $(document).on('click', '.add-row', function() {
            var newRow = $('.gallery-image-row').first().clone();
            newRow.find('input, textarea').val('');
            newRow.find('.add-row-col-3-div').remove();
            newRow.find('.div-preview-image ').remove();
            newRow.append(
                '<div class="col-md-3"><button type="button" class="btn btn-outline-success add-row m-2">Add +</button><button type="button" class="btn btn-outline-danger remove-row my-2">Remove -</button></div>'
                );
            $('.gallery-image-row').last().after(newRow);
        });

        // Remove row functionality for Banner Section
        $(document).on('click', '.remove-row', function() {
            if ($('.gallery-image-row').length > 1) {
                $(this).closest('.gallery-image-row').remove();
            } else {
                alert('At least one row is required.');
            }
        });

        // Repeat for What We Do Section and other sections
        $(document).on('click', '.add-row2', function() {
            var newRow = $('.gallery-image-row2').first().clone();
            newRow.find('input,textarea').val('');
            newRow.find('textarea').trumbowyg('empty');
            newRow.find('.add-row-col-3-div').remove();
            newRow.find('.div-preview-image').remove();
            newRow.append(
                '<div class="col-md-3"><button type="button" class="btn btn-outline-success add-row2 m-2">Add +</button><button type="button" class="btn btn-outline-danger remove-row2 my-2">Remove -</button></div>'
                );
            $('.gallery-image-row2').last().after(newRow);
        });

        // Remove row functionality for What We Do Section
        $(document).on('click', '.remove-row2', function() {
            if ($('.gallery-image-row2').length > 1) {
                $(this).closest('.gallery-image-row2').remove();
            } else {
                alert('At least one row is required.');
            }
        });
        $("#add_frontend_setting_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });
        
        var responseHandler = function(response) {
            location.reload();
        }
    });

</script>
@endsection