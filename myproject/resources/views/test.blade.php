<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<script src="//code.jquery.com/jquery.js"></script>

		
		<!-- <script src="{{asset('js/WebCodeCam.js')}}"></script> -->
		<script src="{{asset('js/qrcodelib.js')}}"></script>
		<!-- <script src="{{asset('js/DecoderWorker.js')}}"></script> -->
		<!-- <script src="{{asset('js/WebCodeCam.js')}}"></script> -->




	</head>
	<body>
	
<form role="form">
	<legend>Form title</legend>

<input type="text" id="send" name="code">

	{{ csrf_field() }}

	<button type="submit" class="btn btn-primary">Submit</button>
</form>

		<canvas id="canvas"></canvas>
<input type="file" id="file-input">

<!-- <button type="button" class="btn btn-default">button</button> -->

<script>
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
    }

    

});

    $('.btn').click(function(){

        var canvas = document.getElementById('canvas');
        var dataURL = canvas.toDataURL();


          function decodeImageFromBase64(data, callback){
                        // set callback
                        qrcode.callback = callback;
                        // Start decoding
                        qrcode.decode(data)
                    }

             decodeImageFromBase64(dataURL,function(decodedInformation){
                // alert(decodedInformation);
                // $('#send').val(decodedInformation);

             function test(){

                var value = decodedInformation;
                $.ajax({
                    url: 'qrcodelogin',
                    type : 'get',
                    data :{code: value},

                    success:function(data){
                        console.log(data);
                        $('.abc').html(data);
                    }

                });

    }

    test();


             });
    });



</script>




		<!-- jQuery -->
		
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 	
	</body>
</html>