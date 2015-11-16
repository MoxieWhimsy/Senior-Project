<style type="text/css">
	table td {
		white-space: nowrap;
	}
</style>


<?php 

	if(isset($_GET['teacher'])) {
		$teacher = clean_up($_GET['teacher']);
	}
	else {
		header('Location: ../reports.php');
	}
	$sql_lessons = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, te.first_name, te.last_name, el.tuition_due, el.tuition_paid, el.tuition_owed, el.instrument, el.duration FROM lessons el " .
					"JOIN students st ON el.student = st.student_key JOIN teachers te ON el.teacher = te.teacher_key WHERE te.teacher_key = $teacher";


?>



<div class="mainbox col-md-12" >
	
	<input type="button" class="btn btn-lg btn-primary" onclick="history.back();" value="Back">

	<div id="timesheet" class="table-responsive">  
		<h3>Timesheet</h3>
		<table class="table table-striped">

			<?php

				if ($results = $db->query($sql_lessons)) {
				} else {
					echo "$db->error";
					die();
				}

				$columns = array(
					"1.1" => "Student First Name", 
					"1.2" => "Student Last Name", 
					"2.1" => "Teacher First Name", 
					"2.2" => "Teacher Last Name",
					"6" => "Instrument",
					"7" => "Duration",
					3 => "Tuition Due", 
					4 => "Tuition Paid", 
					5 => "Tuition Owed");
				$fields = array(
					"1.1" => "student_first_name", 
					"1.2" => "student_last_name", 
					"2.1" => "first_name",
					"2.2" => "last_name",
					"6" => "instrument",
					"7" => "duration",
					3 => "tuition_due", 
					4 => "tuition_paid", 
					5 => "tuition_owed");

				echo '<thead><tr>';
				echo '<th></th>';
				foreach ($fields as $key => $value) {
					echo "<th>$columns[$key]</th>";
					# code...
				}
				echo '</tr></thead>';
                echo '<tbody>';
                //fill in rows with data
                while($row = $results->fetch_assoc()) {
                	echo '<tr>';
                	echo '<td></td>';
	                foreach ($fields as $key => $value) {
	                	echo "<td>$row[$value]</td>";
	                }
	                echo "</tr>";
	            }

	            $sumresult = $db->query("SELECT SUM(tuition_owed),SUM(tuition_due),SUM(tuition_paid) FROM `lessons` WHERE `teacher` = $teacher");
	            $sumrow = $sumresult->fetch_assoc();

				echo '<tr>';
            	echo '<td></td>';
                foreach ($fields as $key => $value) {
                	$tmp = "SUM($value)";
                	if ($key >= 3 and $key <= 5) {
                		echo "<td>". $sumrow[$tmp] ."</td>";	
                	} else {
                		echo "<td></td>";
                	}
                	
                }
                echo "</tr>";

	            echo "</tbody>";

			?>
		</table>

	</div>

	
</div>


