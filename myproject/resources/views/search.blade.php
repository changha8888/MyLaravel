<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

<script src="js/demo.js" type="text/javascript"></script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<style type="text/css">
			h2{
				/*background: blue;*/
				display: inline-block;
				margin: 50px;
				padding: 20px;
				color:#000;

			}
			.hien{
				background: blue;
				color:#fff;
			}


		</style>
	</head>
	<body>
		
		<!-- <form action="{{url('result')}}" method="POST" role="form">
			<legend>Form title</legend>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field" name="linh">
			</div>
		
			{{csrf_field()}}
		
			<button type="submit" class="btn btn-primary">Submit</button>
		</form> -->

			<h2>{{ __('language.name') }}</h2>
			
	<div class="container-fluid">
		<br><br><br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
				<input type="text" name="name_input" id="id_input" class="cls_input form-control">
			</div>
		</div>
		<div class="abc">

		</div>

	</div>



<form method="get" id='testlang' action="{{route('testlang')}}">

	<select name="lang" id="lang" class="lang" required="required" onchange="$('#testlang').submit();">
		<option @if (App::getLocale() == 'en') selected="selected" @endif value="en">EN</option>

		<option @if (App::getLocale() == 'jp') selected="selected" @endif value="jp">JP</option>
	</select>

</form>	


<h2>{{App::getLocale()}}</h2>

<?php $a = 5; ?>

<!-- <a class="btn btn-default" href="{{route('button',['data'=>$a])}}" role="button">button</a>

<p class="click">hover </p>

<h2 class="hi"> test </h2> -->


		<!-- jQuery -->
		

		<script type="text/javascript">

		// $('.cls_input').keyup(function(){

		// 	var data = $('.cls_input').val();

		// 	console.log(data);

		// });



// $('.lang').click(function(){

// 	var abc = $('.lang').val();
// 	// console.log(abc);
// 	$.ajax({
// 		type:'get',
// 		url:'testlang',
// 		data: {'lang_ajax':abc},
// 		success:function(data){
// 			console.log(data);
// 		}
// 	});
// });



// $('.click').hover(
// 	function(){
// 		// alert('fasdfasd');
// 		$('.hi').addClass("hien");
		
// 	},
// 	function(){
// 		$('.hi').removeClass("hien");
		
// 	}


// 	);




		// $(document).ready(function(){

		// 	$('#id_input').on('keyup',function(){
		// 		search();
		// 	});
		// });

		// function search(){
		// 	var value = $('#id_input').val();
		// 	$.ajax({
		// 		type :'get',
		// 		url  :'result',
		// 		data : {'name':value},
		// 		success:function(data){
		// 			console.log(data);
		// 			$('.abc').html(data);
		// 		}


		// 	});

		// }
			
			// $('#input').on('keyup',function(){
			// 	var value = $(this).val();

			// 	$.ajax({
			// 		type : 'get',
			// 		url  : 'result',
			// 		data : {'name':value},
						
					
			// 		success:function(data){
			// 		console.log(data);
			// 		if(value){
			// 		$('.abc').html(data);
			// 	}
			// 		}
			// 	});
			// });
		</script>
<!-- 		<script type="text/javascript">
				var path = "{{route('result')}}";
				$('input.typeahead').typeahead({
					source: function (query, process){
						return $.get(path,{query:query},function(data){
							return process(data);
						})
					}
				});

		</script> -->


		<!-- Bootstrap JavaScript -->
		
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		
	</body>
</html>