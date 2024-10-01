<form id="edit_default_form" action="{{url(route('custom-pages.update', $page->id))}}" method="post"
    enctype="multipart/form-data">
    @csrf
    @php
		if (!empty($page->content)) {
			$content = $page->content ?? '';
		} else {
			$content =  '';        
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
                <label>Slug (URL) <span class="red">*</span></label>
                <input type="text" class="form-control"  maxlength="155" value="{{ $page->slug }}" name="slug" required>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Status <span class="red">*</span></label>
                <select class="form-select" name="is_active" required>
                    <option value="0" {{ $page->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ $page->is_active == 1 ? 'selected' : '' }}>Active</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <h3>Content</h3>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <label>Description<span class="red">*</span></label>
                <textarea class="form-control trumbowyg" name="content" rows="3"  @if (empty($content)) required @endif>{{ $content }}</textarea>
            </div>
        </div>
    </div>

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
    initValidate('#edit_default_form');

    $("#edit_default_form").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, responseHandler);
    });

    var responseHandler = function(response) {
        location.reload();
    }

});
</script>