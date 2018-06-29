<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Gudea" rel="stylesheet">
	<title>	 DISCUSSION FORUM | INDORE PROFESSIONAL STUDIES  </title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	
	<style>
			.box1{font-size:4em;  float:left; margin:50px;}
			
			.box2{ float:right;  margin:50px ;}
			input,textarea { display:block; width:400px; margin:10px;}
			.row{margin:auto;}
			.box2 p{margin:10px; font-size:2em;}
			button{margin-left:190px; margin-top:-30px; padding:5px 20px;}
	</style>
</head>
 
<body> 

<header>

	<header id="header">				
		<div class ="logo">
			<img src="images/ips6.png" width="600px	" >
						
		</div>		
</header>
				
	<nav id="nav">		
		<div class="row" >
			<div class="col-md-8">
				<ul id="navlist" >	
					<li><a href= "home.php" >HOME   </a> </li> 
					<li><a href= "forum.php" >FORUM</a></li> 
					<li><a href= "members.php" >MEMBERS </a></li>
					<li><a href= "about.php" >ABOUT </a></li> 
					<li class="active"><a href= "#" >CONTACT </a></li> 
				</ul>
			</div>				
			
			
				
		</div>
	</nav>
	
</header>

<div class="main">

	<div class="row">
		<div class="box1">
				<p>
				Have something<br>
				to say?<br>
				Contact us!<br>
				
				</p>
		
		</div>
		<div class="box2">
			<p> Send us a message</p>
			
			<form action="" method="">
			<input type="text" placeholder="Name*" name="name" required >
			<input type="text" placeholder="E-mail*" name="email" required>
			<input type="text" placeholder="Subject" name="subject" required>
			<textarea placeholder="Message*" cols="" rows="6" required>
			</textarea>
			<button class="btn btn-primary" type="submit"> Send</button>
			</form>
		
		</div>
	</div>


</div>


<footer> 
<center>	<div class="footer" >	
					<a href= "home.php" >HOME   |</a> 
					<a href= "forum.php" >  FORUM   |</a> 
					<a href= "members.php" >MEMBERS   | </a>
					<a href= "about.php" >ABOUT   |</a>
					<a href= "contact.php" >CONTACT </a>
				</div>
			<center>
</footer>

	<script src="js/bootstrap.min.js"></script>

	</body>

</html>