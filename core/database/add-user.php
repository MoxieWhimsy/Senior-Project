<?php
	require '../init.php';
	if(!isAdmin($_SESSION['id']))
		header ("../../index.php");

	$username = $_POST["username"];
	$email = $_POST["email"];
	$admin = $_POST["admin"];
	$password = random_password(10);
	/* Prepared statement, stage 1: prepare */
	$link = connectDB();
	if($result = mysql_db_query("rowanprep", "INSERT INTO users (username, password, email, admin) VALUES ('$username', '$password', '$email', '$admin')")) 
	{
		$msg = "An account has been registered with this email address at elvis.rowan.edu/rowanprep.";
		$msg .= "\nPlease sign in using your username.\nAuto-generated password: " . $password;
		$msg .=	 "\n\n\nContact Anna at Rowan Prep if you have troubles signing in. Thanks,\nRowan Prep";
		$subj = "Rowan Prep User Information - DO NOT REPLY";

		mail($email, $subj, $msg, "From: Rowan Prep");
			header("Location: ../../admin.php");
			die();
	}
	else {
		echo "insert failed.". $db->error;
	}
	
?>

