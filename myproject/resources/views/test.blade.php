<h1>0%</h1>


<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 0.125%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>
<body>

<h2>JS P B</h2>

<div id="myProgress">
  <div id="myBar">0%</div>
</div>

<br>
<button onclick="move()">Click Me</button> 


<script src="//code.jquery.com/jquery.js">
</script>


<script type="text/javascript">
	
	var interval_ajax = setInterval(getajax,3000);

	function getajax(){
			$.ajax({
				type:'get',
				url:'ajax',
				data:{name:5 },
				success:function(data){
					console.log(data);
					$('h1').html(data+'%');

						if(data < 100){

					      $("#myBar").css("width", data + '%');    
					      $("#myBar").html(data  + '%');

					     }if(data == 100){
					     	$("#myBar").css("width", data + '%');    
					      	$("#myBar").html(data  + '%');
					     	clearInterval(interval_ajax);
					     }

					// var id = setInterval(frame, 1000);

					//  function frame() {
					//     if (data >= 100) {
					//       clearInterval(interval_ajax);
					//       clearInterval(id);
					//     } else {

					//       $("#myBar").css("width", data + '%');    
					//       $("#myBar").html(data  + '%');
					//     }
					//   }


				}
			});
		}


// function move() {
//   var elem = $("#myBar")[0];   

//   var width = 10;
//   var id = setInterval(frame, 500);
//   function frame() {
//     if (width >= 100) {
//       clearInterval(id);
//     } else {
//       width++; 
//       $("#myBar").css("width", width + '%');    
//       $("#myBar").html(width  + '%');
//     }
//   }
// }

</script>