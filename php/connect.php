<?php

$con = mysqli_connect('localhost','root');

if($con) 
{
	echo "connection successful";
	
}
else 
	echo"connection failed";

mysqli_select_db($con,'forumv2');



?>