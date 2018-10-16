@php
    $postHasImage = isset($post) && $post->image || isset($testimonial) && $testimonial->image;

    // dd($postHasImage);
@endphp

<div class="form-group" id="post-image-div" {{ $postHasImage ? 'style=display:none;' : '' }}>
    <label for="upload_image">Upload Image</label>
    <input id="upload_image" accept="image/jpeg,image/jpg" value="{{ old('upload_image') }}" name="upload_image" style="margin-bottom: 15px" class="form-control" type="file">
</div>

{{--<label id="upload-image-label" for="upload-image">upload photo</label>--}}

@if($postHasImage)
    <p id="image-message">Delete current image to upload a new one</p>
    <div class="admin-image__block">
        @isset($post)
            <img id="post-image" src="{{ asset('uploads/posts/' . $post->image->filename) }}" alt="">
        @endisset
        @isset($testimonial)
            <img id="post-image" src="{{ asset('uploads/testimonials/' . $testimonial->image->filename) }}" alt="">        
        @endisset
        <span id="remove-uploaded-image" class="img-remove">&times;</span>
        <img id="funeral-home-image-preview" src="#" alt="" style="display: none">
    </div>
@else
    <div class="admin-image__block">
        <img id="funeral-home-image-preview" src="#" alt="" style="display: none">
    </div>
@endif

