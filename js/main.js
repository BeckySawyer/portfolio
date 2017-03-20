function readURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (url && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {

          $('#projectThumbnail').attr('src', url);

        }else{
         $('#projectThumbnail').attr('src', 'img/place-holder.png');
       }
     }