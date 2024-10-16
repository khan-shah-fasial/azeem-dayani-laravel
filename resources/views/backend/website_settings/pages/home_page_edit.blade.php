<form id="edit_home_form" action="{{url(route('custom-pages.update', $page->id))}}" method="post"
    enctype="multipart/form-data">
    @csrf
    @php
    if (!empty($page->content)) {
        $data = $page->content;
        $decoded_data = json_decode($data);

        $banner = $decoded_data->banner ?? '';
        $banner_text = $decoded_data->banner_text ?? '';

        $about_content = $decoded_data->about_content ?? '';
        $about_image = $decoded_data->about_image ?? '';

        $ows1 = $decoded_data->ows_image_1 ?? '';
        $ows2 = $decoded_data->ows_image_2 ?? '';
        $ows3 = $decoded_data->ows_image_3 ?? '';
        $ows4 = $decoded_data->ows_image_4 ?? '';
        $url1 = $decoded_data->ows_image_1_url ?? '';
        $url2 = $decoded_data->ows_image_2_url ?? '';
        $url3 = $decoded_data->ows_image_3_url ?? '';
        $url4 = $decoded_data->ows_image_4_url ?? '';
        $ows_content = $decoded_data->ows_content ?? '';

        $achivements_image = $decoded_data->achivements_image ?? '';
        $achivements_banner_bg = $decoded_data->achivements_banner_bg ?? '';
        $achivements_content = $decoded_data->achivements_content ?? '';

        $film_catg = $decoded_data->film_catg ?? '';
        $non_film_catg = $decoded_data->non_film_catg ?? '';
        $ott_catg = $decoded_data->ott_catg ?? '';

        $meta_title = $page->meta_title ?? '';
        $meta_description = $page->meta_description ?? '';
    } else {
        // If content is empty, set default empty values
        $banners = '';
        $banner_text = '';

        $about_content = '';
        $about_image = '';

        $ows1 = '';
        $ows2 = '';
        $ows3 = '';
        $ows4 = '';
        $url1 = '';
        $url2 = '';
        $url3 = '';
        $url4 = '';
        $ows_content = '';

        $achivements_image = '';
        $achivements_banner_bg = '';
        $achivements_content = '';

        $film_catg = '';
        $non_film_catg = '';

        $meta_title = '';
        $meta_description = '';
    }

@endphp

    <div class="row">
        <input type="hidden" name="id" value="{{ $page->id }}">
        <input type="hidden" class="form-control" name="title"  maxlength="155" value="{{ $page->title }}" required>
        <input readonly type="hidden" class="form-control"  maxlength="155" value="{{ $page->slug }}" name="slug" required>
        <input type="hidden" class="form-control" name="is_active" value="1" required>

{{------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Banner Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Banner Image <span class="red">*</span></label>
            <input class="form-control" type="file" id="banner" name="banner"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($banner)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($banner))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $banner) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Banner Text <span class="red">*</span></label>
            <input class="form-control" type="text" id="banner_text" name="banner_text" value="{{ $banner_text }}"
            required>
        </div>

{{------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>About Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>About Image <span class="red">*</span></label>
            <input class="form-control" type="file" id="about_image" name="about_image"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($about_image)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($about_image))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $about_image) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>About Content <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="about_content" rows="3"  @if (empty($about_content)) required @endif>{{ $about_content }}</textarea>
        </div>

{{------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Our Work Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Our Work Section Image 1 <span class="red">*</span></label>
            <input class="form-control" type="file" id="ows_image" name="ows_image_1"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($ows1)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ows1))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ows1) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Image 1 url <span class="red">*</span></label>
            <input class="form-control" type="text" id="ows_image_1" name="ows_image_1_url" value="{{ $url1 }}"
            required>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Our Work Section Image 2 <span class="red">*</span></label>
            <input class="form-control" type="file" id="ows_image" name="ows_image_2"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($ows2)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ows2))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ows2) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Image 2 url <span class="red">*</span></label>
            <input class="form-control" type="text" id="ows_image_2" name="ows_image_2_url" value="{{ $url2 }}"
            required>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Our Work Section Image 3 <span class="red">*</span></label>
            <input class="form-control" type="file" id="ows_image" name="ows_image_3"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($ows3)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ows3))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ows3) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Image 3 url <span class="red">*</span></label>
            <input class="form-control" type="text" id="ows_image_3" name="ows_image_3_url" value="{{ $url3 }}"
            required>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Our Work Section Image 4 <span class="red">*</span></label>
            <input class="form-control" type="file" id="ows_image" name="ows_image_4"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($ows4)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($ows4))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $ows4) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-6 form-group mb-3">
            <label>Image 4 url <span class="red">*</span></label>
            <input class="form-control" type="text" id="ows_image_4" name="ows_image_4_url" value="{{ $url4 }}"
            required>
        </div>

        <div class="col-sm-12 form-group mb-3">
            <label>Our Work Section Content <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="ows_content" rows="3"  @if (empty($ows_content)) required @endif>{{ $ows_content }}</textarea>
        </div>

{{------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Achivements Section </h3>
            <hr>
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Achivements Section Image <span class="red">*</span></label>
            <input class="form-control" type="file" id="achivements_image" name="achivements_image"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($achivements_image)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($achivements_image))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $achivements_image) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-4 form-group mb-3">
            <label>Achivements Section Background Banner <span class="red">*</span></label>
            <input class="form-control" type="file" id="achivements_banner_bg" name="achivements_banner_bg"
                accept=".jpg,.jpeg,.png,.webp" @if (empty($achivements_banner_bg)) required @endif>
        </div>

        <div class="col-sm-2 form-group mb-3">
            @if (!empty($achivements_banner_bg))
                <div class="div-preview-image col-3 form-group mb-3">
                    <img width="180" src="{{ asset('storage/' . $achivements_banner_bg) }}">                                       
                </div>
            @endif
        </div>

        <div class="col-sm-12 form-group mb-3">
            <label>Achivements Section Content <span class="red">*</span></label>
            <textarea class="form-control trumbowyg" name="achivements_content" rows="3"  @if (empty($achivements_content)) required @endif>{{ $achivements_content }}</textarea>
        </div>

{{------------------------------------------------------------------------------------------------------}}

        <div class="col-sm-12 form-group mb-3">
            <h3>Playlist Section </h3>
            <hr>
        </div>

        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Playlist Section Flim <span class="red">*</span></label>
                <select class="form-select select2" name="film_catg[]" multiple required>                    
                    @foreach ($film as $film_catg_items )
                        <option value="{{ $film_catg_items->id }}" 
                            {{ in_array($film_catg_items->id, json_decode($film_catg) ?? []) ? 'selected' : '' }}>
                            {{ $film_catg_items->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Playlist Section Non Flim <span class="red">*</span></label>
                <select class="form-select select2" name="non_film_catg[]" multiple required>                    
                    @foreach ($non_film as $film_catg_items )
                        <option value="{{ $film_catg_items->id }}" 
                            {{ in_array($film_catg_items->id,  json_decode($non_film_catg) ?? []) ? 'selected' : '' }}>
                            {{ $film_catg_items->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label>Playlist Section OTT <span class="red">*</span></label>
                <select class="form-select select2" name="ott_catg[]" multiple required>                    
                    @foreach ($ott_film as $film_catg_items )
                        <option value="{{ $film_catg_items->id }}" 
                            {{ in_array($film_catg_items->id,  json_decode($ott_catg) ?? []) ? 'selected' : '' }}>
                            {{ $film_catg_items->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

{{------------------------------------------------------------------------------------------------------}}

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
            <input class="form-control" type="text" id="meta_description" name="meta_description" value="{{ $meta_description }}" required>
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
    initValidate('#edit_home_form');

    $("#edit_home_form").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, responseHandler);
    });

    var responseHandler = function(response) {
        location.reload();
    }
});
</script>