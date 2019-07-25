$(document).ready(function(){
    $(document).on('change', '#multi_image', function(e){
        e.preventDefault();
        var files = e.target.files,
        filesLength = files.length;
       for(var i = 0; i < filesLength; i++){
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e){
                var image_path = e.target.result;
                $('#preview_multi_images').append(''
                    +'<span class="pip">' 
                        +'<img src= "'+image_path+'" alt="Banner Images" style="width:130px; height:100px"/>'
                        +'<input type="hidden" name="banner_images[]" id="banner_images" value="'+image_path+'">'
                        +'<span class="remove">Remove</span>'
                    +'</span>'
                +'');

                $('.remove').click(function(){
                    $(this).parent('').remove();
                });
            });

            fileReader.readAsDataURL(f);
        }
    });

    $(document).on('click', '#remove_product_image', function(){
        $('.remove_'+$(this).attr('data-id')).remove();
    });
});