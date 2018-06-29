<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Gudea" rel="stylesheet">
	<title>	 DISCUSSION FORUM | INDORE PROFESSIONAL STUDIES  </title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link  href="css/main.css" rel="stylesheet">
	 <script src="js/validation.js"></script> 
	 
	 <style> .intro{ text-align:center; background-color:black; padding:100px; margin:0px;
	               height:400px;}</style>
</head>
 
<body> 
<?php
//user defined function test_input 
function test_input($data) {
  $data = trim($data);  //removes whitespace,tabs,newlines
  $data = stripslashes($data);  //removes backslashes
  $data = htmlspecialchars($data);//converts <> html sp char to &lt &gt
  return $data;
}
// define variables and set to empty values
$nameErr = $emailErr = $unameErr = $pswErr = $cpswErr="";
$name = $email = $uname ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  
   if (empty($_POST["uname"])) {
    $unameErr = "Username is required";
  } else {
    $uname = test_input($_POST["uname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
      $unameErr = "Only letters and white space allowed"; 
    }
  }  
 
}
?>

<header id="header">				
		<div class ="logo">
			<img src="images/ips6.png" width="600px	" >
						
		</div>		
</header>
				
	<nav id="nav">		
		<div class="row" >
			<div class="col-md-8">
				<ul id="navlist" >	
					<li class="active"><a href= "#" >HOME   </a> </li> 
					<li><a href= "forum.php" >FORUM</a></li> 
					<li><a href= "members.php" >MEMBERS </a></li>
					<li><a href= "about.php" >ABOUT </a></li> 
					<li><a href= "contact.php" >CONTACT </a></li> 
				</ul>
			</div>				
			
			<div class="col-md-4" 	>	
				<span class="user_avatar <?php if(!isset($_SESSION['logged_in'])) echo "hide" ?>" >
					<?php echo $_SESSION['username'];	
				
							if($_SESSION['logged_in'])
						{	
							echo '<img src="'.$_SESSION['image'].'" class="avatar1">';						
						}						
					
					?>
				<li><a href="logout.php"> Logout </a></li>
					
				</span>
					
				<ul  class=" <?php if(isset($_SESSION['logged_in'])) echo "hide" ?> ">
					<li>  <a href="index.php">SignUp/<span class="glyphicon glyphicon-user"></span> LogIn  </a></li>
				</ul>
				
			</div>
				
		</div>
	</nav>
		
	<div class="jumbotron">	
	
	</div>
				




 <div class="intro">
	<h1><a href="forum.php">EXPLORE FORUM</a><h1>
	<h2>{ Teach, Learn, Repeat }</h2>
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
			

	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>

	</body>

</html>