<?php
session_start();
require 'db.php';
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
	 <link rel="stylesheet" href="css/main.css">
	  
	<style>
			.members{float:left; width:60%; font-size:30px; margin-left:40px}
			.search{float:left; width:30%px; padding:5px; }
			
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
					<li class="active"><a href= "#" >MEMBERS </a></li>
					<li><a href= "about.php" >ABOUT </a></li> 
					<li><a href= "contact.php" >CONTACT </a></li> 
				</ul>
			</div>				
			
			<div class="col-md-4" >	
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
	

</header>


<div class="main">
	<div class="wrapper">
		<p class="members"> Members </p>
		<div class="search">
		<span class="glyphicon glyphicon-search disabled" >
		</span><input class="" type="text"/>
		</div>
		
	</div>
	
	<div class="clearfix row">
		<?php 
			
		
			$q = "Select * from users";
			$result = $mysqli->query($q);
			if($result->num_rows >0)
		    {
				foreach($result as $row)
				{	echo'<div class="box"> 
					<div class="username">'.$row['username'].' </div>
					<div class="image"><img src="'.$row['image'].'" width=200px/> </div>';
					
					$topics = "SELECT * from topics left join users on 
					topics.topic_by=users.id where users.id=".$row['id']."";
					$total_topics = $mysqli->query($topics);
					$total_topics = $total_topics->num_rows;	
					
					$replies = "SELECT * from posts left join users on 
					posts.post_by=users.id where users.id=".$row['id']."";
					$total_posts = $mysqli->query($replies);
					$total_posts = $total_posts->num_rows;	
					
					echo '<div class="stats">  <p> Topics('.$total_topics.')  |  Replies('.$total_posts.')</p>  </div>
					</div>';
				}
			}
		
		
	
		?>
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
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="member.js"></script>
   
	</body>

</html>