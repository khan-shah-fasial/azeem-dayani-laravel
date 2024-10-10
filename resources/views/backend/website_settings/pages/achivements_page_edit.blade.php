<form id="edit_aboutus_form" action="{{ url(route('custom-pages.update', $page->id)) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @php
        if (!empty($page->content) && $page->content !== null) {
            $data = $page->content;
            $decoded_data = json_decode($data, true);

            $sec_title = $decoded_data["sec_title"] ?? '';
            $sec_description = $decoded_data["sec_description"] ?? '';

            $image = $decoded_data["image"] ?? '';
            $img_title = $decoded_data["img_title"] ?? '';

            $video = $decoded_data["video_image"] ?? '';
            $url = $decoded_data["url"] ?? '';
            $video_title = $decoded_data["video_title"] ?? '';

            $meta_title = $page->meta_title ?? '';
            $meta_description = $page->meta_description ?? '';
        } else {
            // If content is empty, set default empty values
            $sec_title = '';
            $sec_description = '';

            $image = '';
            $img_title = '';

            $video = '';
            $url = '';
            $video_title = '';

            $meta_title = '';
            $meta_description = '';
        }
    @endphp

    <div class="row">
        <input type="hidden" name="id" value="{{ $page->id }}">
        <input type="hidden" class="form-control" name="title" maxlength="155" value="{{ $page->title }}" required>
        <input readonly type="hidden" class="form-control" maxlength="155" value="{{ $page->slug }}" name="slug"
            required>
        <input type="hidden" class="form-control" name="is_active" value="1" required>

        {{--------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>page Section </h3>
            <hr>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Section Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="sec_title" name="sec_title" value="{{ $sec_title }}"
                required>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Section description <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="sec_description" rows="3"  @if (empty($sec_description)) required @endif>{{ $sec_description }}</textarea>
        </div>

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Image Section </h3>
            <hr>
        </div>

        @if (!empty($image))
            @php
                $lastindex = is_array($image) ? count($image) : $image->count();
            @endphp
            @foreach ($image as $index => $banner)
                <div class="row gallery-image-row">
                    <div class="col-md-9">
                        <div class="form-group row mb-3 ">
                            <div class="col-8 form-group mb-3">
                                <label>Image <span class="red">*</span></label>
                                <input class="form-control" type="file" id="image" name="image[]"
                                    accept=".jpg,.jpeg,.png,.webp" @if (empty($banner)) required @endif>
                                <input type="hidden" name="img_count[]" value="1">
                            </div>
                            @if (!empty($banner))
                                <div class="div-preview-image col-3 form-group mb-3">
                                    <input type="hidden" name="existing_banner_image[]" value="{{ $banner }}">
                                    <img width="180" src="{{ asset('storage/' . $banner) }}">
                                </div>
                            @endif

                            <div class="col-sm-6 form-group mb-3">
                                <label>Image Title <span class="red">*</span></label>
                                <input class="form-control" type="text" id="url" name="img_title[]" value="{{ $img_title[$index] }}"
                                    required>
                            </div>

                        </div>
                    </div>
                    <div class="add-row-col-3-div col-md-3">
                        @if ($index === 0 || $index === $lastindex - 1)
                            <button type="button" class="btn btn-outline-success add-row m-2">Add More +</button>
                        @endif
                        @if ($index > 0)
                            <button type="button" class="btn btn-outline-danger remove-row my-2">Remove</button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="row gallery-image-row">
                <div class="col-md-9">
                    <div class="form-group row mb-3 ">
                        <div class="col-6 form-group mb-3">
                            <label>Image <span class="red">*</span></label>
                            <input class="form-control" type="file" id="image" name="image[]"
                                accept=".jpg,.jpeg,.png,.webp" required>
                            <input type="hidden" name="img_count[]" value="1">
                        </div>
                        <div class="col-sm-6 form-group mb-3">
                            <label>Image Title <span class="red">*</span></label>
                            <input class="form-control" type="text" id="url" name="img_title[]"
                                required>
                        </div>
                    </div>
                </div>
                <div class="add-row-col-3-div col-md-3">
                    <button type="button" class="btn btn-outline-success add-row my-2">Add More +</button>
                </div>
            </div>
        @endif

        {{-- -------------------------------------------------------------------------------------------------- --}}

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Video Section </h3>
            <hr>
        </div>

        @if (!empty($video))
            @php
                $lastindex_video = is_array($video) ? count($video) : $video->count();
            @endphp
            @foreach ($video as $index => $banner)
                <div class="row gallery-video-row">
                    <div class="col-md-9">
                        <div class="form-group row mb-3 ">
                            <div class="col-8 form-group mb-3">
                                <label>video <span class="red">*</span></label>
                                <input class="form-control" type="file" id="video" name="video[]"
                                accept=".mp4,.mkv,.avi,.mov,.wmv" @if (empty($banner)) required @endif>
                                <input type="hidden" name="video_count[]" value="1">
                            </div>
                            @if (!empty($banner))
                                <div class="div-preview-video col-3 form-group mb-3">
                                    <input type="hidden" name="existing_banner_video[]" value="{{ $banner }}">
                                    <video width="180" controls>
                                        <source src="{{ asset('storage/' . $banner) }}" type="video/mp4">
                                    </video>
                                </div>
                            @endif
                        </div>

                        {{-- <div class="col-sm-6 form-group mb-3">
                            <label>Video URL <span class="red">*</span></label>
                            <input class="form-control" type="text" id="url" name="url[]" value="{{ $url[$index] }}"
                                required>
                        </div> --}}

                        <div class="col-sm-6 form-group mb-3">
                            <label>Video Title <span class="red">*</span></label>
                            <input class="form-control" type="text" id="video_title" name="video_title[]" value="{{ $video_title[$index] }}"
                                required>
                        </div>

                    </div>
                    <div class="add-row-col-3-div col-md-3">
                        @if ($index === 0 || $index === $lastindex_video - 1)
                            <button type="button" class="btn btn-outline-success add-row-video m-2">Add More +</button>
                        @endif
                        @if ($index > 0)
                            <button type="button" class="btn btn-outline-danger remove-row-video my-2">Remove</button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="row gallery-video-row">
                <div class="col-md-9">
                    <div class="form-group row mb-3 ">
                        <div class="col-6 form-group mb-3">
                            <label>video <span class="red">*</span></label>
                            <input class="form-control" type="file" id="video" name="video[]"
                            accept=".mp4,.mkv,.avi,.mov,.wmv" required>
                            <input type="hidden" name="video_count[]" value="1">
                        </div>
                        {{-- <div class="col-sm-6 form-group mb-3">
                            <label>Video URL <span class="red">*</span></label>
                            <input class="form-control" type="text" id="url" name="url[]"
                                required>
                        </div> --}}
                        <div class="col-sm-6 form-group mb-3">
                            <label>Video Title <span class="red">*</span></label>
                            <input class="form-control" type="text" id="video_title" name="video_title[]"
                                required>
                        </div>
                    </div>
                </div>
                <div class="add-row-col-3-div col-md-3">
                    <button type="button" class="btn btn-outline-success add-row-video my-2">Add More +</button>
                </div>
            </div>
        @endif

        {{-- -------------------------------------------------------------------------------------------------- --}}
        

        <div class="col-sm-12 form-group mb-3">
            <h3>SEO Section </h3>
            <hr>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Meta Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="meta_title" name="meta_title" value="{{ $meta_title }}"
                required>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Meta description <span class="red">*</span></label>
            <input class="form-control" type="text" id="meta_description" name="meta_description"
                value="{{ $meta_description }}" required>
        </div>

        <div class="col-sm-12">
            <div class="form-group mb-3 text-end">
                <button type="submit" class="btn btn-block btn-primary">Update</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        initTrumbowyg('.trumbowyg');
        initSelect2('.select2');
        initValidate('#edit_aboutus_form');

        $("#edit_aboutus_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            location.reload();
        }

        // Add row functionality for Banner Section
        $(document).off('click', '.add-row').on('click', '.add-row', function() {
            var newRow = $('.gallery-image-row').first().clone();
            newRow.find('input, textarea').val('');
            newRow.find('.add-row-col-3-div').remove();
            newRow.find('.div-preview-image ').remove();
            newRow.append(
                '<div class="col-md-3"><button type="button" class="btn btn-outline-success add-row m-2">Add More +</button><button type="button" class="btn btn-outline-danger remove-row my-2">Remove</button></div>'
            );
            $('.gallery-image-row').last().after(newRow);
        });

        // Remove row functionality for Banner Section
        $(document).off('click', '.remove-row').on('click', '.remove-row', function() {
            if ($('.gallery-image-row').length > 1) {
                $(this).closest('.gallery-image-row').remove();
            } else {
                alert('At least one row is required.');
            }
        });


        // Add row functionality for Banner Section
        $(document).off('click', '.add-row-video').on('click', '.add-row-video', function() {
            var newRow = $('.gallery-video-row').first().clone();
            newRow.find('input, textarea').val('');
            newRow.find('.add-row-col-3-div').remove();
            newRow.find('.div-preview-video ').remove();
            newRow.append(
                '<div class="col-md-3"><button type="button" class="btn btn-outline-success add-row-video m-2">Add More +</button><button type="button" class="btn btn-outline-danger remove-row-video my-2">Remove</button></div>'
            );
            $('.gallery-video-row').last().after(newRow);
        });

        // Remove row functionality for Banner Section
        $(document).off('click', '.remove-row-video').on('click', '.remove-row-video', function() {
            if ($('.gallery-video-row').length > 1) {
                $(this).closest('.gallery-video-row').remove();
            } else {
                alert('At least one row is required.');
            }
        });

    });
</script>
