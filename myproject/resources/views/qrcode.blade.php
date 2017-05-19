@extends('master')

	@section('content')

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-4">

					<div id="qrcode"></div> <br>

					<a class="btn btn-warning" download > Download Qr Code </a>
				</div>	
			</div>		
		</div>		

		<input type="hidden" id="qrcode_" value="{{$qrcode}}">
		

		

		<script type="text/javascript">
			
			var qrcode = $('#qrcode_').val();

			$('#qrcode').qrcode({
				text	: qrcode
			});		

			$( "canvas" ).addClass( "canvas" );

			var canvas = $('.canvas')[0];
            var dataURL = canvas.toDataURL();

            $(".btn").attr("href", dataURL);


		</script>

	@endsection