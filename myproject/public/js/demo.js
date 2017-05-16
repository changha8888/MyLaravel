
$(document).ready(function(){

	$('.cls_input').on('keyup',function(){

		test();

	});

	function test(){
		var value = $('#id_input').val();
		$.ajax({
			url: 'result',
			type : 'get',
			data :{name: value},

			success:function(data){
				console.log(data);
				$('.abc').html(data);
			}

		});

	}


});

