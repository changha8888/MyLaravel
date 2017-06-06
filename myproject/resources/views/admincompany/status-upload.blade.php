@extends('master')
	@section('content')

	<div class="container">

	<input type="hidden" class="id" value="{{$id}}">
	<input type="hidden" class="without_extension" value="{{$without_extension}}">
	<h2>Status process</h2>

	<h3>0%</h3>

		<!-- <script src="//code.jquery.com/jquery.js"></script> -->


			<script type="text/javascript">
					
				setInterval(function(){
					var id = $('.id').val();
					var file_name = $('.without_extension').val();
					$.ajax({
						type:'get',
						url:'getstatus',
						data:{id:id,file_name:file_name},

						success:function(data){
							console.log(data);
							$('h3').html(data+'%');
						}
					});
				},10000);

			</script>

		<a  href="{{route('admin_company',$id) }}" class="btn btn-info"> OK </a>	
	</div>

@endsection