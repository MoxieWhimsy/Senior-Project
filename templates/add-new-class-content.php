<?php

	if(isset($_GET['class'])) {
		$class_id = clean_up($_GET['class']);
    $addnew = false;
	}
	else {
    $class_id = "new";
    $addnew = true;
	}
	
  $link = connectDB();
  $result = mysql_db_query("rowanprep", "SELECT * FROM classes WHERE class_id LIKE '$class_id'");
  $num_rows = mysql_num_rows($result);
  if ($num_rows === 0) {

  } else {
    $row = mysql_fetch_assoc($result);
  }

?>

<form action="core/database/add-edit-class.php?class=<?php echo $row['class_id']?>" class="form-horizontal" method="post" onsubmit="validate()">
<fieldset>

	<legend><div class="row text-center">Add a New Class</div></legend>

	<form class="form-horizontal">
  <fieldset>

   <div class="form-group">
    <label class="col-md-4 control-label" for="textinput">Class Name</label>
    <div class="col-md-5">
    <input id="textinput" name="class_name" type="text" placeholder="Name That Class!" class="form-control input-md" required="">

    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="selectbasic">Teacher</label>
    <div class="col-md-5">
      <select id="selectbasic" name="teacher" class="form-control">
        <?php 
         if($addnew) {
            echo '<option value="0"> - Select Teacher</option>';
          }
          $teacher_list = get_teacher_list();
          while($teacher_identity = mysql_fetch_assoc($teacher_list)) {
            if($teacher_identity['teacher_key'] === $row['teacher']) {
             echo '<option value="', $teacher_identity['teacher_key'],'" selected>', $teacher_identity['last_name'], ', ', $teacher_identity['first_name'], '</option>';
            }
            else {
             echo '<option value="', $teacher_identity['teacher_key'],'">', $teacher_identity['last_name'], ', ', $teacher_identity['first_name'], '</option>';
            }
          }
        ?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-4 control-label" for="selectbasic">Semester</label>
    <div class="col-md-5">
      <select id="selectbasic" name="semester" class="form-control">
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="textinput">Year</label>
    <div class="col-md-5">
    <select id="selectbasic" name="year" class="form-control">
      <option value="-1">- Select Year</option>
       <?php $int_year = 2000; 
             while($int_year != 2100) {
                if($int_year == $row['year']) {
                  echo '<option value="', $int_year,'" selected>', $int_year, '</option>';
                }
                else {
                echo '<option value="', $int_year,'">', $int_year, '</option>';
                }
                $int_year++;
             }
       ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="selectbasic">Number of Lessons</label>
    <div class="col-md-5">
      <select id="selectbasic" name="total_lessons" class="form-control">
        <?php 
          if($addnew) {
            echo '<option value="0"> - Select a Value</option>';
          }
          for ($tmp_int=1; $tmp_int < 100; $tmp_int++) { 
            if($row['total_lessons'] === $tmp_int) {
              echo '<option value="', $tmp_int,'" selected>', $tmp_int,'</option>';
            }
            else {
              echo '<option value="', $tmp_int,'">', $tmp_int,'</option>';
            }
            
          }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="textinput">Day</label>
    <div class="col-md-5">
    <select id="selectbasic" name="day" class="form-control">
      <?php if($addnew === true) { ?>
        <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
      <?php } else { ?>
        <option value="Sunday"<?php echo (($row['day']=='Sunday')?"selected>":">");?>Sunday</option>
        <option value="Monday"<?php echo (($row['day']=='Monday')?"selected>":">");?>Monday</option>
        <option value="Tuesday"<?php echo (($row['day']=='Tuesday')?"selected>":">");?>Tuesday</option>
        <option value="Wednesday"<?php echo (($row['day']=='Wednesday')?"selected>":">");?>Wednesday</option>
        <option value="Thursday"<?php echo (($row['day']=='Thursday')?"selected>":">");?>Thursday</option>
        <option value="Friday"<?php echo (($row['day']=='Friday')?"selected>":">");?>Friday</option>
        <option value="Saturday"<?php echo (($row['day']=='Saturday')?"selected>":">");?>Saturday</option>
      <?php }?>
        
      </select>
    </div>
  </div>


  <?php
    for ($ix=0; $ix < 7; $ix++) { 
      echo "<br />";
    }
  ?>
 
   <div class="row text-center">
    <input type="submit" class="btn btn-primary" value="Add" />
     <a type="button" class="btn btn-primary" href="reports.php?tab=lessons" value="Back">Back</a>
  </div>

  
</fieldset>
</form>