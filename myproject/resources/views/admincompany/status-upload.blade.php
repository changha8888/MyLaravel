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

	.error{
		color:red;
	}
</style>

<div class="container">
	<div class="col-md-9">
		<input type="hidden" class="id" value="{{$id_company}}">
		<input type="hidden" class="file_name" value="{{$file_name}}">
		<input type="hidden" class="current_user" value="{{$current_user}}">
		<input type="hidden" class="test" value="">
		<h2>Status process</h2>

		<h3></h3>

		<p class="done"></p>

		<div id="log">

		</div>

		<!-- <div id="myProgress">
			<div id="myBar">0%</div>
		</div><br> -->

		<script type="text/javascript">

			var $log = $( "#log" );
			var interval = setInterval(GetStatus,2000);

			function GetStatus(){
				var id = $('.id').val();
				var file_name = $('.file_name').val();
				var current_user = $('.current_user').val();
				var test = $('.test').val();

				$.ajax({
					type:'get',	
					url:'../getstatus',
					data:{

						id:id,
						file_name:file_name,
						current_user:current_user,
						test:test
					},

					success:function(data){
						var parsed_data = JSON.parse(data);
						console.log(parsed_data);

					$('.test').val(parsed_data.test);

						$('h3').html('Processing...');

						if(parsed_data.percent < 100){


							$('.done').html('User imported : '+ parsed_data.new + ' user');

							if(parsed_data.err.length != 0){


								$.each(parsed_data.err, function( index, value ) {

									var html = $.parseHTML('<p class="error"><span> ERROR : line </span> '+ value.id_excel_file+' --- '+value.status +'</p>' );

									$log.append( html);

								});
							}	
								
						}if(parsed_data.percent == 100){
							
							$('h3').html('DONE !!! ');	
							$('h3').css("color", 'green');   
							$('.done').html('Total user imported : '+ parsed_data.new + ' user');

							if(parsed_data.err.length != 0){


								$.each(parsed_data.err, function( index, value ) {

									var html = $.parseHTML('<p class="error"><span> ERROR : line </span> '+ value.id_excel_file+' --- '+value.status +'</p>' );

									$log.append( html);

								});
							}	

							clearInterval(interval);

						}
					}
				});

			}

		</script>

		

		<a  href="{{route('admin_company',['id'=>$id_company,'filename'=>$file_name]) }}" class="btn btn-info"> OK </a>	
	</div>	
</div>

@endsection