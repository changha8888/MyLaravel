<h1></h1>


<script src="//code.jquery.com/jquery.js">
</script>


<script type="text/javascript">
	
	setInterval(function(){
			$.ajax({
				type:'get',
				url:'ajax',
				data:{name:5 },
				success:function(data){
					// console.log(data);
					$('h1').html(data+'%');
				}
			});
		},7000);

</script>