@extends('master')
	@section('content')
	<style>
		#myProgress {
		  width: 100%;
		  background-color: #ddd;
		}

		#myBar {
		  width: 0%;
		  height: 30px;
		  background-color: #4CAF50;
		  text-align: center;
		  line-height: 30px;
		  color: white;
		}
	</style>

	<div class="container">
	<div class="col-md-9">
		<input type="hidden" class="id" value="{{$id}}">
		<input type="hidden" class="without_extension" value="{{$without_extension}}">
		<h2>Status process</h2>

		<h3>0%</h3>

		<div id="myProgress">
		  <div id="myBar">0%</div>
		</div><br>

			<!-- <script src="//code.jquery.com/jquery.js"></script> -->


			<script type="text/javascript">
					
			var interval = setInterval(GetStatus,10000);

			function GetStatus(){
				var id = $('.id').val();
				var file_name = $('.without_extension').val();
				$.ajax({
					type:'get',
					url:'getstatus',
					data:{id:id,file_name:file_name},

					success:function(data){
						console.log(data);
						$('h3').html(data+'%');

						if(data < 100){

					      	$("#myBar").css("width", data + '%');    
					      	$("#myBar").html(data  + '%');

					    }if(data == 100){
					     	$("#myBar").css("width", data + '%');    
					      	$("#myBar").html(data  + '%');
					     	clearInterval(interval);
					    }
					}
				});
			}

			</script>

			<a  href="{{route('admin_company',$id) }}" class="btn btn-info"> OK </a>	
		</div>	
	</div>

@endsection