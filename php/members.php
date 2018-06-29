<?php
include 'connect.php';

$result=  mysqli_query($con,'select * from users;' );

//$row= mysqli_fetch_array($result);

foreach($result as $row)
{	
	echo $row['user_id'].' '.$row['username'].' '.$row['full_name'] ;
	
}

?>