@extends('master')

	@section('content')

		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-4">

					<div id="qrcode"></div>

				</div>	
			</div>		
		</div>		

		<input type="hidden" id="qrcode_" value="{{$qrcode
}}">

		<script type="text/javascript">
			
			var qrcode = $('#qrcode_').val();
;
			jQuery('#qrcode').qrcode({
				text	: qrcode
			});		

		</script>

	@endsection