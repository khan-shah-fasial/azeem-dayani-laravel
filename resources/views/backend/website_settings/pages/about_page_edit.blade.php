<form id="edit_aboutus_form" action="{{ url(route('custom-pages.update', $page->id)) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @php
        if (!empty($page->content)) {
            $data = $page->content;
            $decoded_data = json_decode($data);

            $ab_img_1 = $decoded_data->ab_img_1 ?? '';
            $ab_img_2 = $decoded_data->ab_img_2 ?? '';

            $ab_title = $decoded_data->ab_title ?? '';
            $ab_description = $decoded_data->ab_description ?? '';

            $ab_journey_title = $decoded_data->ab_journey_title ?? '';
            $ab_journey_description = $decoded_data->ab_journey_description ?? '';
            $ab_journey_img = $decoded_data->ab_journey_img ?? '';

            $ab_vision_title = $decoded_data->ab_vision_title ?? '';
            $ab_vision_sub_title = $decoded_data->ab_vision_sub_title ?? '';
            $ab_vision_description = $decoded_data->ab_vision_description ?? '';
            $ab_vision_img = $decoded_data->ab_vision_img ?? '';

            $meta_title = $page->meta_title ?? '';
            $meta_description = $page->meta_description ?? '';
        } else {
            // If content is empty, set default empty values
            $ab_img_1 = '';
            $ab_img_2 = '';

            $ab_title = '';
            $ab_description = '';

            $ab_journey_title = '';
            $ab_journey_description = '';
            $ab_journey_img = '';

            $ab_vision_title = '';
            $ab_vision_sub_title = '';
            $ab_vision_description = '';
            $ab_vision_img = '';

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

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>About Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>About Image First <span class="red">*</span></label>
            <input class="form-control" type="file" id="ab_img_1" name="ab_img_1" accept=".jpg,.jpeg,.png,.webp"
                @if (empty($ab_img_1)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ab_img_1))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ab_img_1) }}">
                </div>
            @endif
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>About Image Second <span class="red">*</span></label>
            <input class="form-control" type="file" id="ab_img_2" name="ab_img_2" accept=".jpg,.jpeg,.png,.webp"
                @if (empty($ab_img_2)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ab_img_2))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ab_img_2) }}">
                </div>
            @endif
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>About Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="ab_title" name="ab_title" value="{{ $ab_title }}"
                required>
        </div>

        <div class="col-sm-8 form-group mb-3">
            <label>About Description <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="ab_description" rows="3"
                @if (empty($ab_description)) required @endif>{{ $ab_description }}</textarea>
        </div>

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Journey Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Image <span class="red">*</span></label>
            <input class="form-control" type="file" id="ab_journey_img" name="ab_journey_img"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($ab_journey_img)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ab_journey_img))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ab_journey_img) }}">
                </div>
            @endif
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="ab_journey_title" name="ab_journey_title" value="{{ $ab_journey_title }}"
                required>
        </div>

        <div class="col-sm-12 form-group mb-3">
            <label>Description <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="ab_journey_description" rows="3"
                @if (empty($ab_journey_description)) required @endif>{{ $ab_journey_description }}</textarea>
        </div>

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Vision Section </h3>
            <hr>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="ab_vision_title" name="ab_vision_title" value="{{ $ab_vision_title }}"
                required>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Sub Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="ab_vision_sub_title" name="ab_vision_sub_title" value="{{ $ab_vision_sub_title }}"
                required>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Image <span class="red">*</span></label>
            <input class="form-control" type="file" id="ab_vision_img" name="ab_vision_img" accept=".jpg,.jpeg,.png,.webp"
                @if (empty($ab_vision_img)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ab_vision_img))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ab_vision_img) }}">
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Descripition <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="ab_vision_description" rows="3"
                @if (empty($ab_vision_description)) required @endif>{{ $ab_vision_description }}</textarea>
        </div>

        {{-- -------------------------------------------------------------------------------------------------- --}}

        <div class="col-sm-12 form-group mb-3">
            <h3>SEO Section </h3>
            <hr>
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Meta Title <span class="red">*</span></label>
            <input class="form-control" type="text" id="meta_title" name="meta_title"
                value="{{ $meta_title }}" required>
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

    });
</script>
