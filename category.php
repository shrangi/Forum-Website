<?php
session_start();
require 'db.php';

if(!isset($_GET['id'])) header("location:forum.php ");
$cat_name = $mysqli->escape_string($_GET['id']);

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
		table td{ background-color:#fff; padding: 5px; }
	
	
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
					<li ><a href= "forum.php" >FORUM</a></li> 
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
	
			<h1 class="lfloat"> Forum / <?php echo $cat_name; ?> </h1> 
			<button type="button" class="rfloat btn btn-primary" data-toggle="modal" data-target="#myModal"> 
			Create a topic </button>
			
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Start a discussion</h4>
				  </div>
				  <div class="modal-body">
					<form method="POST" action="forum.php">
						<label for="category">Select Folder	</label>
						<select name="category">
							<?php			$q = 'Select * from categories' ;
								
								$result = $mysqli->query($q);
								
								foreach($result as $row)
								{
									echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>'; 								
								}
							?>	
						</select>
						<br>
						<br>
						<textarea cols="70" rows="5" name="topic" placeholder="write your topic" maxlength="255" minlength="10" required> 
						</textarea>
						
					  </div>
					  <div class="modal-footer">
						<button type="submit" class="btn btn-danger">Submit </button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
				  </form>
				</div>

			  </div>
			</div>
					
		

</div>
<section>
	<div class="categories"  >
		<table  class="table table-border table-condensed table-hover" border="2px" >
				<tr>
				<th> <h3>Topic </h3> </th> <th> <h3>Posted by </h3></th> <th> <h3>Date-Time </h3></th>
				</tr>
				
				<?php 
				//selecting id of opened category ..only single record..storing in $cat_id
			    $cat_id = $mysqli->query("Select cat_id from categories where cat_name='$cat_name' limit 1;");
				$category = $cat_id->fetch_assoc();
				
				$cat_id= $category['cat_id'];
				$q = 'Select topics.topic_id, topics.topic_subject , topics.topic_date , topics.topic_cat,
				      users.fullname
				      
				      from topics left join users 
					  on  topics.topic_by = users.id 
					  where topics.topic_cat ="'.$cat_id.'" ;
				         ' ;
				
				$result = $mysqli->query($q);
				
				if ( $result->num_rows == 0 )
				{ 
					echo '<tr>
					<td class="topic">  No topics </td> 	
					<td class="topic_by">	-</td>
					<td class="date"> -  </td>
					</tr>';
				}else
				foreach($result as $row)
				{
					echo '<tr>
					<td class="topic">  <a href="topic.php?id='.$row['topic_id'].'"> '.$row['topic_subject'].'</td> 	
					<td class="posted_by"> <a href="members.php?id="> '.$row['fullname'].'</td>
					<td class="date"> '.date('d-m-Y, h:i a' ,strtotime($row['topic_date'])).'  </td>
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