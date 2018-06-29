<?php

require 'db.php';	
session_start();


//insert topic into database
if($_SERVER['REQUEST_METHOD']=='POST')
{	if($_SESSION['logged_in'])
		{
			$cat = $_POST['category'];
			$topic = trim($_POST['topic']) ;
			
			$q= "Insert into topics(topic_subject,topic_cat,topic_by) Values('$topic',$cat,$_SESSION[id]);";
			
			$result=$mysqli->query($q);
			
		
		}
	else
	{ //user must be logged in to post a topic
	  header("location:index.php");
	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Gudea" rel="stylesheet">
	<title>	 DISCUSSION FORUM | INDORE PROFESSIONAL STUDIES  </title>
	 <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/main.css"/>
	
	<style>
		table th{ background-color:#4070de; padding: 5px; }
		table td{ background-color:#fff; padding: 5px; color:black }
	
	
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
					<li class="active"><a href= "#" >FORUM</a></li> 
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
</header>

<div class="main">
<div class="section">
	
			<h1> Forum </h1>
			
		

</div>
<section>
	<div class="categories"  >
		<table  class="table table-border table-condensed table-hover" cellspacing="50px" cellpadding="30px"	border="3px" >
				<tr>
				<th> <h3>Categories</h3> </th> <th> <h3>Last Active Post</h3></th>
				</tr>
				
				<?php 
				
				$q = 'Select * from categories' ;
				$result = $mysqli->query($q);
				
				
				
				
				foreach($result as $row)
				{
					echo '<tr>
					<td class="category">
					<a href="category.php?id='.$row['cat_name'].'"> <h4> '.$row['cat_name'].'</h4> </a> 
					  '.$row['cat_desc'].'</td>' ;
					
					//  q2 for getting last topic form each category  
					$q2 = 'Select topics.topic_id, topics.topic_subject , topics.topic_date , topics.topic_cat,
				      users.fullname
				      
				      from topics left join users 
					  on  topics.topic_by = users.id 
					  where topics.topic_cat ="'.$row['cat_id'].'" ORDER BY topics.topic_date DESC LIMIT 1 ;
				         ' ; 
					$result = $mysqli->query($q2) ;
					//getting single record
					$last_topic= $result->fetch_assoc();
					
					echo '<td class="last_topic"> <a href="topic.php?id='.$last_topic['topic_id'].'">'.$last_topic['topic_subject'].'</a> 
					 by <a href="members.php">'.$last_topic['fullname'].'</a>
					</td>
					</tr>';
				}
				
				?>
				
				
				
		</table>
	
	</div>
</section>
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