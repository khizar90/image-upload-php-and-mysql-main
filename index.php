<!DOCTYPE html>
<html>
<head>
	<title>Image Upload Using PHP</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
		form{
			width: 260px;
			height: 380px;
			background: linear-gradient(to top, rgba(0, 0, 0,0.5)50%, rgba(0, 0, 0,0.5)50%);
			position: absolute;
			top: 100px;
			left: 30%;
			border-radius: 10px;
			padding: 25px;
		}
		input{
			width: 240px;
			height: 40px;
			background: white;
			border: none;
			color: black;font-size: 15px;
			letter-spacing: 1px;
			margin-top: 10px;
			font-family: sans-serif;
}
.a{
	width: 240px;
			height: 40px;
			background: white;
			border: none;
			color: black;font-size: 15px;
	letter-spacing: 1px;
	margin-top: 10px;
	font-family: sans-serif;
}.t{
	background : transparent;
}
	</style>
</head>
<body>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">

           <input type="file" 
                  name="my_image" class="t">

          <br>
	<lable>Name</lable>
	<input type="text" name="name"></input><br>
	<lable>Decription</lable><br>
	<textarea type="textarea" name="discription" class="a"></textarea><br>
	<input type="submit" 
                  name="submit"
                  value="Upload">
	</input>
     </form>
</body>
</html>