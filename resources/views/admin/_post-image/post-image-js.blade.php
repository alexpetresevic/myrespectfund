<script>
    $('#upload_image').on('change', function (){
        var reader = new FileReader();
        reader.onload = function (ev){
            $('#funeral-home-image-preview').attr('src', ev.target.result).css('display', 'block');
            $('#funeral-home-image-preview').after('<span id="img-remove"  class="img-remove">&times;</span>');
        };
        reader.readAsDataURL(this.files[0]);
    });
    
    $(document).on("click", "#img-remove", function (){
        $('#funeral-home-image-preview').hide();
        $('#funeral-home-image-preview').attr('src', '');
        $('#upload_image').val('');
        $('#img-remove').remove();
    });

</script>