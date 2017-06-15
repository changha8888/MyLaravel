<html>
<head>
<meta charset="utf-8">
<title>Makes "field" required and a decimal number only.</title>
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
 
</head>


<body>

<input class="left" id="field" name="field">

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



<script>

$('#field').keyup(function(event){

	console.log(event.keyCode);
	if(event.keyCode <=57 && event.keyCode >=48){
		console.log('here');
	}

	
});


</script>
</body>
</html>
