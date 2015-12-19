<?php
	require 'core/init.php';
	if(!logged_in())
		header("Location: index.php");
	if(!isAdmin())
		header("Location: index.php");
	
	include 'templates/header.php';	
    	if (!isset($_GET['tab'])) {
	    header('Location: admin.php?tab=users');
	      } else {
	          $tab = clean_up($_GET['tab']);
		    }
	include 'templates/navbar-logged-in.php';
    	include 'templates/admin-content.php';
    	include 'templates/footer.php';
?>
