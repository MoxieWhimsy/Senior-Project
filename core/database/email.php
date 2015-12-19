<?php
	require '../init.php';
	if (!isset($_GET['option'])) {
	    header('Location: admin.php');
	      } else {
	          $option = clean_up($_GET['option']);
		    }
		     if (isset($_POST['selectbasic'])) {
		         $var = clean_up($_POST['selectbasic']);
			   }
			    if (isset($_POST['message'])) {
			        $msg = clean_up($_POST['message']);
				  }
				    else {
						
						  }
						    $mailto = "";

						     if($option === 'class') {
						      		$link = connectDB();
								      if($result = mysql_db_query("rowanprep", "SELECT * FROM class_link JOIN students ON student_key = student WHERE class_ref = '$var'")) {
								      		   while($row = mysql_fetch_assoc($result)) {
										   	       				    $mailto .= $row['student_email'].", ";
															    	       }
																         }
																	   if($result = mysql_db_query("rowanprep", "SELECT * FROM classes JOIN teachers ON teacher_key = teacher WHERE class_id = '$var'")) {
																	   	       	while($row = mysql_fetch_assoc($result)) {
																				     				 $mailto .= $row['email'].", ";
																								 	    		     $mailto .= $row['alternate_email'].", ";
																											     	      	}
																													  }
																													   }
																													     if($option === 'day') {
																													      		$link = connectDB(); // get lessons emails
																															      if($result = mysql_db_query("rowanprep", "SELECT * FROM lessons JOIN students ON student_key = student WHERE day = '$var'")) {
																															       		   while($row = mysql_fetch_assoc($result)) {
																																	    	      				    $mailto .= $row['student_email'].", ";
																																						    	       }
																																							         }
																																								   if($result = mysql_db_query("rowanprep", "SELECT * FROM lessons JOIN teachers ON teacher_key = teacher WHERE day = '$var'")) {
																																								   	       	while($row = mysql_fetch_assoc($result)) {
																																											     				 $mailto .= $row['email'].", ";
																																															 	    		     $mailto .= $row['alternate_email'].", ";
																																																		     	      	}
																																																				  }
																																																				    //get classes emails
																																																				     	  if($result = mysql_db_query("rowanprep", "SELECT * FROM classes JOIN class_link ON class_ref = class_id JOIN students ON student_key = student WHERE day = '$var'")) {
																																																					  	       while($row = mysql_fetch_assoc($result)) {
																																																						       		    				$mailto .= $row['student_email'].", ";
																																																													   }
																																																													     }
																																																													       if($result = mysql_db_query("rowanprep", "SELECT * FROM classes JOIN teachers ON teacher_key = teacher WHERE day = '$var'")) {
																																																													       		    while($row = mysql_fetch_assoc($result)) {
																																																															    	         			     $mailto .= $row['email'].", ";
																																																																				     	      			 $mailto .= $row['alternate_email'].", ";
																																																																								 	    }
																																																																									      }
																																																																									       }
																																																																									         if($option === 'orchestra') {
																																																																										  	    $link = connectDB();
																																																																											     	  if($result = mysql_db_query("rowanprep", "SELECT * FROM orchestra JOIN students ON student_key = student"))  {
																																																																												  	       while($row = mysql_fetch_assoc($result)) {
																																																																													       		    				$mailto .= $row['student_email'].", ";
																																																																																				   }
																																																																																				     }
																																																																																				      }
																																																																																				       if($option === 'band') {
																																																																																				        	  $link = connectDB();
																																																																																						   	if($result = mysql_db_query("rowanprep", "SELECT * FROM brass_band JOIN students ON student_key = student")) {
																																																																																								     while($row = mysql_fetch_assoc($result)) {
																																																																																								     		  			      $mailto .= $row['student_email'].", ";
																																																																																													      	       	 }
																																																																																															   }
																																																																																															    }
																																																																																															      if($option === 'student') {
																																																																																															       		 $link = connectDB();
																																																																																																	       if($result = mysql_db_query("rowanprep", "SELECT * FROM students")) {
																																																																																																	       		    while($row = mysql_fetch_assoc($result)) {
																																																																																																			    	         			     $mailto .= $row['student_email'].", ";
																																																																																																								     	      	}
																																																																																																										  }
																																																																																																										   }
																																																																																																										    if($option === 'teacher') {
																																																																																																										     	       $link = connectDB();
																																																																																																											             if($result = mysql_db_query("rowanprep", "SELECT * FROM teachers")) {
																																																																																																												     		  while($row = mysql_fetch_assoc($result)) {
																																																																																																														  	       				   $mailto .= $row['email'].", ";
																																																																																																																			   	      }
																																																																																																																				        }     
																																																																																																																					 }

																																																																																																																					 $subj = "Rowan Prep Email - DO NOT REPLY";
																																																																																																																					 mail($mailto, $subj, $msg, "From: Rowan Prep");
																																																																																																																					 	       header("Location: ../../admin.php");
																																																																																																																						       			 die();

?>
