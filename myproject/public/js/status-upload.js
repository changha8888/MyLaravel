
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
