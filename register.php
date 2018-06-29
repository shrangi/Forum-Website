<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['fullname'] = $_POST['fullname'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['gender'] = $_POST['gender'];

		$_SESSION['image']= "profile pics/";
	

// Escape all $_POST variables to protect against SQL injections
$fullname = $mysqli->escape_string($_POST['fullname']);
$username = $mysqli->escape_string($_POST['username']);
$gender = $mysqli->escape_string($_POST['gender']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
if($gender==1){$imagesrc='profile pics/male.png'; }
if($gender==0){$imagesrc='profile pics/female.png'; }      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}

$result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error());

// We know username is taken if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'Username is already taken! Please try another.';
    header("location: error.php");
}

else  { // Email,username doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (fullname, username,gender, email, password, hash,image) " 
            . "VALUES ('$fullname','$username','$gender','$email','$password', '$hash','$imagesrc')";

    // Add user to the database
    if ( $mysqli->query($sql) ){
		$_SESSION['image']=$imagesrc;
        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] = 
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification ( socforum.com )';
        $message_body = '
        Hello '.$fullname.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: home.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}