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
		<script type="text/javascript" src="{{asset('js/grid.js')}}"></script>
<script type="text/javascript" src="{{asset('js/version.js')}}"></script>
<script type="text/javascript" src="{{asset('js/detector.js')}}"></script>
<script type="text/javascript" src="{{asset('js/formatinf.js')}}"></script>
<script type="text/javascript" src="{{asset('js/errorlevel.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bitmat.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datablock.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bmparser.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datamask.js')}}"></script>
<script type="text/javascript" src="{{asset('js/rsdecoder.js')}}"></script>
<script type="text/javascript" src="{{asset('js/gf256poly.js')}}"></script>
<script type="text/javascript" src="{{asset('js/gf256.js')}}"></script>
<script type="text/javascript" src="{{asset('js/decoder.js')}}"></script>
<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<script type="text/javascript" src="{{asset('js/findpat.js')}}"></script>
<script type="text/javascript" src="{{asset('js/alignpat.js')}}"></script>
<script type="text/javascript" src="{{asset('js/databr.js')}}"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<canvas id="canvas"></canvas>
<input type="file" id="file-input">

<button type="button" id="action" class="btn btn-default">button</button>
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

var imageURI = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAYAAABccqhmAAAWrUlEQ…uc0JH2cIILzU15+wrgKwCdlU9x7WGceE05Te7JBynvHQzgP0X+Fx/z4OTpAAAAAElFTkSuQmCC";

 function decodeImageFromBase64(data, callback){
                // set callback
                qrcode.callback = callback;
                // Start decoding
                qrcode.decode(data)
            }


            document.getElementById("action").addEventListener('click',function(){
                decodeImageFromBase64(imageURI,function(decodedInformation){
                    alert(decodedInformation);
                });
            },false);


</script>

		<!-- jQuery -->
		
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 	
	</body>
</html>