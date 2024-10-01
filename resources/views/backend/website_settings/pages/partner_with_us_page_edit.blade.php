<form id="edit_aboutus_form" action="{{url(route('custom-pages.update', $page->id))}}" method="post"
    enctype="multipart/form-data">
    @csrf
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

    <div class="row">
        <input type="hidden" name="id" value="{{ $page->id }}">
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <label>Title <span class="red">*</span></label>
                <input type="text" class="form-control" name="title"  maxlength="155" value="{{ $page->title }}" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Slug (URL) <span class="red">*</span><span class="small"> (Deafult Pages Slug Not Editable) </span></label>
                <input readonly type="text" class="form-control"  maxlength="155" value="{{ $page->slug }}" name="slug" required>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Status <span class="red">*</span><span class="small"> (Deafult Pages Status Not Editable) </span></label>
                <select class="pe-none form-select" name="is_active" required>
                    <option value="0" {{ $page->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ $page->is_active == 1 ? 'selected' : '' }}>Active</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <h3>About section</h3>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <label>Description<span class="red">*</span></label>
                <textarea class="form-control trumbowyg" name="about_content" rows="3"  @if (empty($about_content)) required @endif>{{ $about_content }}</textarea>
            </div>
        </div>
    </div>


    <hr>
    <h3>Team section</h3>
    @if (!empty($faqs))        
        @php
            $lastindex = is_array($faqs) ? count($faqs) : $faqs->count();
        @endphp
        @foreach ($faqs as $index => $faq)
                <div class="row gallery-image-row">
                    <div class="col-md-9">
                        <div class="form-group row mb-3 ">
                            <div class="col-6 form-group mb-3">
                                <label>Question<span class="red">*</span></label>
                                <input type="text" class="form-control" name="question[]" maxlength="255" value="{{$faq->question}}" required>
                            </div>
                            <div class="col-6 form-group mb-3">
                                <label>Answer <span class="red">*</span></label>
                                <textarea class="form-control" name="answer[]" rows="3" required>{{$faq->answer}}</textarea>
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
                        <label>Question <span class="red">*</span> </label>
                        <input type="text" class="form-control" name="question[]" maxlength="255" required>
                    </div>
                    <div class="col-6 form-group mb-3">
                        <label>Answer <span class="red">*</span> </label>
                        <textarea class="form-control" name="answer[]" rows="3" required></textarea>
                    </div>
                </div>
            </div>
            <div class="add-row-col-3-div col-md-3">
                <button type="button" class="btn btn-outline-success add-row my-2">Add More +</button>
            </div>
        </div>
    @endif


    <hr>
    <h3>Seo Section</h3>
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label>Meta Title<span class="red">*</span></label>
            <input type="text" class="form-control"  maxlength="255" name="meta_title" value="{{ $page->meta_title }}" required>
        </div>
        <div class="form-group mb-3">
            <label>Meta Description<span class="red">*</span></label>
            <textarea class="form-control"  maxlength="255" name="meta_description" rows="3" required>{{ $page->meta_description }}</textarea>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group mb-3 text-end">
            <button type="submit" class="btn btn-block btn-primary">Update</button>
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
        newRow.find('input, textarea').val('');  // Clear input and textarea values
        newRow.find('.add-row-col-3-div').remove();  // Remove specific div
        newRow.find('.div-preview-image').remove();  // Remove preview image div
        
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

});
</script>