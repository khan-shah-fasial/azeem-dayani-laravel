<form id="create_product_form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-6 mb-3">
            <label>Title<span class="red">*</span></label>
            <input required type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group col-6 mb-3">
            <label>Image<span class="red">*</span></label>
            <input required type="file" name="image" class="form-control">
        </div>

        <div class="form-group col-6 mb-3">
            <label>Status<span class="red">*</span></label>
            <select required name="is_active" class="form-control">
                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group col-6 mb-3">
            <label>Category<span class="red">*</span></label>
            <select required name="category" class="form-control select2">
                @foreach ($categories as $row)
                    <option value="{{ $row->id }}">
                        {{ $row->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12 mb-3">
            <label>Spotify URL<span class="red">*</span></label>
            <input required type="url" name="slug" class="form-control" value="{{ old('title') }}">
        </div>

    </div>
    <div class="col-sm-12">
        <div class="form-group m-3 text-end">
            <button type="submit" class="btn btn-block btn-primary">Create</button>
        </div>
    </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        initTrumbowyg('.trumbowyg');
        initSelect2('.select2');
        initValidate('#create_product_form');

        $("#create_product_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            location.reload();
        }

    });
</script>
