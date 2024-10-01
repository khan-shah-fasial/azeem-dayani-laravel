<form id="create_product_category_form" action="{{ route('product-categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="form-group col-6 mb-3">
            <label>Title<span class="red">*</span></label>
            <input required type="text" name="title" class="form-control">
        </div>

        <div class="form-group col-6 mb-3">
            <label>Slug<span class="red">*</span></label>
            <input required type="text" name="slug" class="form-control" >
        </div>

        <div class="form-group col-6 mb-3">
            <label>Image<span class="red">*</span></label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group col-6 mb-3">
            <label>Status<span class="red">*</span></label>
            <select required name="is_active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="form-group col-12 mb-3">
            <label>Description<span class="red">*</span></label>
            <textarea required name="description" class="form-control trumbowyg"></textarea>
        </div>

        <div class="form-group col-12 mb-3">
            <label>Meta Title<span class="red">*</span></label>
            <input required type="text" name="meta_title" class="form-control">
        </div>

        <div class="form-group col-12 mb-3">
            <label>Meta Description<span class="red">*</span></label>
            <textarea required name="meta_description" class="form-control"></textarea>
        </div>

        <div class="col-sm-12">
        <div class="form-group m-3 text-end">
            <button type="submit" class="btn btn-block btn-primary">Create</button>
        </div>
    </div>
</form>
<script>
$(document).ready(function() {
    initTrumbowyg('.trumbowyg');
    initSelect2('.select2');
    initValidate('#create_product_category_form');

    $("#create_product_category_form").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, responseHandler);
    });

    var responseHandler = function(response) {
        location.reload();
    }

});
</script>