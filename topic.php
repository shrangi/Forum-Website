<?php
session_start();
require 'db.php';

if(!isset($_GET['id'])) header("location:forum.php ");
$topic_id = $mysqli->escape_string($_GET['id']);

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
		.hrule{height:2px; width:95%; background-color:#bbb; margin: auto; border-radius:50%;}
		.vrule{height:80%; width:4px; background-color:#bbb; margin:30px auto; border-radius:50%; float:left;}
		
		.topic { background-color:white; color:white; margin:20px; padding:10px; border-radius:10px; box-shadow:5px 5px 5px black; overflow:hidden;  }
		 
		.box{  border-radius:10px;float:left;width:20%; height:auto; padding:10px;	}
		.box>.username { background-color:black; padding:5px; width:100px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;}
		.box>.stats { color : #222 ; text-align:center;}
		
		.topic_display { font-size:22px; margin:10px auto;  float:left; width:70%; height:auto;}
	    .topic_date { color:#555;}
		.topic_subject{ padding-top:10px; color:black;}
		
		.reply-btn { text-align:right; margin-right:50px; margin-top:10px;}
		.wrapper{}
		
	</style>
	
</head>
 
<body> 

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
			
			<div class="col-md-4">	
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
<div class="">
		<div class="">
			<h2 class="lfloat"> Forum / <?php echo $topic_id ?> </h2> 	
		</div>
		
	<div class="clearfix"> </div>
<section>
	<div class="topic row">
		
				
				<?php 
			    //query to get the details of topic and user who submitted it
				$q = 'Select topics.topic_id, topics.topic_subject , topics.topic_date , topics.topic_cat,
				      users.fullname, users.image, users.id, users.username
				      
				      from topics left join users 
					  on  topics.topic_by = users.id 
					  where topics.topic_id ="'.$topic_id.'" ;
				         ' ;
				
				$result = $mysqli->query($q);
				$result = $result->fetch_assoc();
				
				echo'<div class="box"> 
					
					<div class="image"><img src="'.$result['image'].'" width=100px/> </div>
					<div class="username">'.$result['fullname'].' </div>
					<div class="stats">  </div>
					</div>';
					
				echo '<div class="topic_display"> 
						<div class="topic_username"> <h2><a href=""># '.$result['username'].'</a>	</h2></div>
						<div class="topic_date">'.strtoupper(date("M d, Y   h:i a",strtotime($result['topic_date']))).' </div>
							
						<div class="topic_subject">'.$result['topic_subject'].'	</div>	
					  </div> 
				
				<div class="hrule clearfix">   </div>
				
				<div class="reply-btn ">
					<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal2">
					<span class="glyphicon glyphicon-send"> </span> Reply </button>
				</div> ';
				?>
	</div>

<!-- for replies -->
	
		
				
		<?php
			    //query to get all posts on that topic 
				 $q = 'Select posts.post_id, posts.post_content , posts.post_date , posts.post_topic, posts.post_by,
				      users.fullname, users.image, users.id, users.username
				      
				      from posts left join users 
					  on  posts.post_by = users.id 
					  where posts.post_topic ="'.$topic_id.'" ;
				         ' ;
				
				$result = $mysqli->query($q);
				if($result->num_rows==0){
					
				}else
				{
				
				
				
				foreach($result as $result)
				{
				echo '
						<div class="topic row">
							<div class="box"> 
								
								<div class="image"><img src="'.$result['image'].'" width=100px/> </div>
								<div class="username"'.$result['fullname'].' </div>
								<div class="stats">   </div>
							</div>
							</div>	
							<div class="topic_display"> 
								<div class="topic_username"> <h2><a href=""># '.$result['username'].'</a>	</h2></div>
								<div class="topic_date">'.strtoupper(date("M d, Y   h:i a",strtotime($result['post_date']))).' </div>	
								<div class="topic_subject">'.$result['post_content'].'	</div>	
							</div> '  ;
							
					echo'<div class="hrule clearfix">   </div>
							
							<div class="reply-btn ">
								<button  type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal2">
								<span class="glyphicon glyphicon-send"> </span>   Reply </button>
							</div>
					
						</div>
						</div>';
				}
				}
	?>
	
				
			
			<div id="myModal2" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				
				<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Reply</h4>
					  </div>
					  <div class="modal-body">
					  
				<?php	echo'<form method="POST" action="topic.php?id='.$topic_id.'">'; ?>

							
							<br>	
							 <input type="hidden" value=""> 
							<textarea cols="80" rows="15" name="post_content" placeholder="write here.." maxlength="2000" minlength="4" required> 
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


			
</section>
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

	<?php
	if($_SERVER['REQUEST_METHOD']=='POST')
{	if($_SESSION['logged_in'])
		{
			$post_topic = $_GET['id'];
			$topic = trim($_POST['post_content']) ;
			
			$q= "Insert into posts(post_content,post_by,post_topic) Values('$topic',$_SESSION[id],$post_topic);";
			
			$result=$mysqli->query($q);
			
		   
		}
	else
	{ //user must be logged in to post a reply
	  header("location:index.php");
	
	}
}
	
	?>
     

	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>

	</body>

</html>  