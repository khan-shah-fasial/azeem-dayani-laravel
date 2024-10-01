<form id="edit_product_form" action="{{ route('products.update', $product->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="form-group col-6 mb-3">
            <label>Title<span class="red">*</span></label>
            <input required type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}"
                required>
        </div>

        <div class="form-group mb-3 col-sm-{{ !empty($product->image) ? 3 : 6 }}">
            <label>Image<span class="red">*</span></label>
            <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                @if (empty($product->image)) required @endif>
        </div>
        @if (!empty($product->image))
            <div class="div-preview-image col-3 form-group mb-3">
                <input type="hidden" name="existing_image" value="{{ $product->image }}">
                <img width="180" src="{{ asset('storage/' . $product->image) }}">
            </div>
        @endif

        <div class="form-group col-6 mb-3">
            <label>Status<span class="red">*</span></label>
            <select required name="is_active" class="form-control">
                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Active
                </option>
                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Inactive
                </option>
            </select>
        </div>

        <div class="form-group col-6 mb-3">
            <label>Product Category<span class="red">*</span></label>
            <select name="category" class="form-control select2">
                @foreach ($categories as $row)
                    <option value="{{ $row->id }}" {{ $row->id == $product->categories_id ? 'selected' : '' }}>
                        {{ $row->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12 mb-3">
            <label>Spotify URL<span class="red">*</span></label>
            <input required type="text" name="slug" class="form-control"
                value="{{ old('slug', $product->slug) }}" required>
        </div>



    </div>


    <div class="col-sm-12">
        <div class="form-group m-3 text-end">
            <button type="submit" class="btn btn-block btn-primary">Update</button>
        </div>
    </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        initTrumbowyg('.trumbowyg');
        initSelect2('.select2');
        initValidate('#edit_product_form');

        $("#edit_product_form").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, responseHandler);
        });

        var responseHandler = function(response) {
            location.reload();
        }

    });
</script>
