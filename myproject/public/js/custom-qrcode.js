$(function() {
    $('#file-input').change(function(e) {
        var file = e.target.files[0],
            imageType = /image.*/;

        if (!file.type.match(imageType))
            return;

        var reader = new FileReader();
        reader.onload = fileOnload;
        reader.readAsDataURL(file);
    });

    function fileOnload(e) {
        var $img = $('<img>', { src: e.target.result });
        $img.load(function() {
            var canvas = $('#canvas')[0];
            var context = canvas.getContext('2d');

            canvas.width = this.naturalWidth;
            canvas.height = this.naturalHeight;
            context.drawImage(this, 0, 0);
        });
        setTimeout(function() {
      
            var canvas = $('#canvas')[0];
            var dataURL = canvas.toDataURL();

            function decodeImageFromBase64(data, callback){
                // set callback
                qrcode.callback = callback;
                // Start decoding
                qrcode.decode(data)
            }

            decodeImageFromBase64(dataURL,function(decodedInformation){
                // alert(decodedInformation);
                $('#send').val(decodedInformation);

            });

        });
    } 

});