$(function() {
    const imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            const filesAmount = input.files.length;

            for (let i = 0; i < filesAmount; i++) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#gallery-photo-add').on('change', function() {
        $('.gallery img').each(function(){
            $(this).remove()
        });
        imagesPreview(this, 'div.gallery');
    });
});