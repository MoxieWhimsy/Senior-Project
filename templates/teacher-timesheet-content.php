<style type="text/css">
	table td {
		white-space: nowrap;
	}
</style>

<script type="text/javascript">
	function function_name (which_one, pay_rate) {
		var othernumber = document.getElementById('select_'+which_one).value;
		document.getElementById('content_'+which_one).innerHTML = othernumber * pay_rate;
	}
	
</script>


<?php 
	$db = connectDB();
	if(isset($_GET['teacher'])) {
		$teacher = clean_up($_GET['teacher']);
	}
	else {
		header('Location: ../reports.php');
	}
	// $sql_lessons = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, te.first_name, te.last_name, el.tuition_due, el.tuition_paid, el.tuition_owed, el.instrument, el.duration FROM lessons el " .
	// 				"JOIN students st ON el.student = st.student_key JOIN teachers te ON el.teacher = te.teacher_key WHERE te.teacher_key = $teacher";

	


?>



<div class="mainbox col-md-12" >
	
	<!-- <input type="button" class="btn btn-lg btn-primary" onclick="history.back();" value="Back"> -->

	<div id="timesheet" class="table-responsive">  
		<h3>Timesheet</h3>
		<h4>
		<?php
			$temp = get_teacher_name($teacher);

			$temp = mysql_fetch_assoc($temp);

			echo $temp['first_name']," ", $temp['last_name'];
		?></h4>
		<table class="table table-striped">

			<?php

				if ($results = get_teacher_timesheet($teacher)) {
				} else {
					echo mysql_error ();
					die();
				}

				$columns = array(
					1 => "Student", 
					2 => "Total Lessons",
					4 => "Payout Now",
					5 => "Total");
					
				$fields = array(
					1 => "student_name", 
					2 => "total_lessons_formatted");

				$pay_fields = array(
					1 => "student_first_name", 
					2 => "student_last_name", 
					8 => "amount_paid");

				echo '<thead><tr>';
				echo '<th></th>';
				foreach ($columns as $key => $value) {
					echo "<th>$columns[$key]</th>";
					# code...
				}
				echo '</tr></thead>';
                echo '<tbody>';
                //fill in rows with data
                while($row = mysql_fetch_assoc ( $results )) {
                	echo '<tr>';
                	echo '<td></td>';
	                foreach ($fields as $key => $value) {
	                	echo "<td>$row[$value]</td>";
	                }
	                echo '<td><select id="select_', $row['student_name'] ,'" onchange="function_name( \'', $row['student_name'] ,"',",$row['pay_rate'] ,') " name="total_lessons" class="form-control">';
                      // TODO: subtract payouts.
                      for ($tmp_int=1; $tmp_int <= $row['total_lessons']; $tmp_int++) { 
                      	if($row['total_lessons'] === $tmp_int) {
			             echo '<option value="', $tmp_int,'" selected>', $tmp_int,'</option>';
			            }
			            else {
			             echo '<option value="', $tmp_int,'">', $tmp_int,'</option>';
			            }
                      }
			        echo '</select></td>';
			        echo '<td><div id="content_', $row['student_name'],'"></div></td>';
	                echo "</tr>";
	            }

	   //          $sumresult = mysql_query("SELECT SUM(el.tuition_due),SUM(ps.amount_paid) FROM lessons el JOIN payments ps ON el.lesson_key = ps.lesson WHERE el.teacher = $teacher");
	            
	   //          $sumrow =  mysql_fetch_assoc($sumresult);

				// echo '<tr>';
    //         	echo '<td></td>';
    //             foreach ($fields as $key => $value) {
    //             	$tmp = "SUM($value)";
    //             	if ($key >= 7 and $key <= 9) {
    //             		echo "<td>". $sumrow[$tmp] ."</td>";	
    //             	} else {
    //             		echo "<td></td>";
    //             	}
                	
    //             }
    //             echo "</tr>";

	            echo "</tbody>";

			?>
		</table>

	</div>

	
</div>


