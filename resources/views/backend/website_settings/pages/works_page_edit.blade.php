<form id="edit_aboutus_form" action="{{ url(route('custom-pages.update', $page->id)) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @php
        if (!empty($page->content)) {
            $data = $page->content;
            $decoded_data = json_decode($data);

            $description = $decoded_data->description ?? '';

            $meta_title = $page->meta_title ?? '';
            $meta_description = $page->meta_description ?? '';
        } else {
            // If content is empty, set default empty values
            $description = '';

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
            <h3>Description Section </h3>
            <hr>
        </div>

        <div class="col-sm-12 form-group mb-3">
            <label>Description Content <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="description" rows="3"  @if (empty($description)) required @endif>{{ $description }}</textarea>
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
