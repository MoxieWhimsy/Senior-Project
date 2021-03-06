<style type="text/css">
	table td {
		white-space: nowrap;
	}
</style>

<?php 

	$student = $_GET['student'];
	$sql_lessons = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, te.first_name, te.last_name, el.tuition_due, el.tuition_paid, el.tuition_owed FROM lessons el " .
					"JOIN students st ON el.student = st.student_key JOIN teachers te ON el.teacher = te.teacher_key WHERE st.student_key = $student";
	$sql_ryo = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, ryor.tuition_due, ryor.tuition_paid, ryor.tuition_owed FROM orchestra ryor " .
				"JOIN students st ON ryor.student = st.student_key WHERE st.student_key = $student";
	$sql_total = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, ryor.tuition_due, ryor.tuition_paid, ryor.tuition_owed FROM orchestra ryor " .
					"JOIN students st ON ryor.student = st.student_key WHERE st.student_key = $student UNION" .
					"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, el.tuition_due, el.tuition_paid, el.tuition_owed FROM lessons el " .
					"JOIN students st ON el.student = st.student_key WHERE st.student_key = $student";
	
	$mytabs = array('#lessons' => 'Lessons','#youth_orchestra' => 'Orchestra', '#total' => 'Aggregate' );
?>



<div class="mainbox col-md-12" >
	
	<div class="row">
		<a type="button" class="btn btn-lg btn-primary" onclick="history.back();" value="Back">Back</a>
	    <!-- Simple jQuery calls to switch out divs -->
		<!-- <a type="button" class="btn btn-primary" href="#" onClick="<?php make_swap_code('#lessons',$mytabs); ?>">Lessons</a> -->
	    <!-- <a type="button" class="btn btn-primary" href="#" onClick="<?php make_swap_code('#youth_orchestra',$mytabs); ?>">Rowan Youth Orchestra</a> -->
	    <!-- <a type="button" class="btn btn-primary" href="#" onClick="<?php make_swap_code('#total',$mytabs); ?>">Aggregate</a> -->
	    <!-- <a type="button" class="btn btn-primary" href="#" onClick="<?php make_show_all_tabs_code($mytabs); ?>">Show All</a> -->
	</div>
	<!-- TODO: FIX this bit. -->

	<div id="lessons" class="table-responsive">  
		<h3>Lessons</h3>
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
					3 => "Tuition Due", 
					4 => "Tuition Paid", 
					5 => "Tuition Owed");
				$fields = array(
					"1.1" => "student_first_name", 
					"1.2" => "student_last_name", 
					"2.1" => "first_name",
					"2.2" => "last_name",
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
	                	# code...
	                }
	                echo "</tr>";
	            }
	            echo "</tbody>";

			?>
		</table>

	</div>

	<div id="youth_orchestra" class="table-responsive">  
		<h3>Orchestra</h3>
		<table class="table table-striped">

			<?php

				if ($results = $db->query($sql_ryo)) {
				} else {
					echo "$db->error";
					die();
				}
				$columns = array(
					"1.1" => "Student First Name", 
					"1.2" => "Student Last Name", 
					3 => "Tuition Due", 
					4 => "Tuition Paid", 
					5 => "Tuition Owed");
				$fields = array(
					"1.1" => "student_first_name", 
					"1.2" => "student_last_name", 
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
	                	# code...
	                }
	                echo "</tr>";
	            }
	            echo "</tbody>";

			?>
		</table>

	</div>

	<div id="total" class="table-responsive">  
		<h3>Aggregate</h3>
		<table class="table table-striped">

			<?php

				if ($results = $db->query($sql_ryo)) {
				} else {
					echo "$db->error";
					die();
				}
				$columns = array(
					"1.1" => "Student First Name", 
					"1.2" => "Student Last Name", 
					3 => "Tuition Due", 
					4 => "Tuition Paid", 
					5 => "Tuition Owed",
					6 => "Type");
				$fields = array(
					"1.1" => "student_first_name", 
					"1.2" => "student_last_name", 
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
	                	# code...
	                }
	                echo "</tr>";
	            }
	            echo "</tbody>";

			?>
		</table>

	</div>
</div>


