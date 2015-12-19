<?php
  require '../init.php';
  $addnew = true;
  if (isset($_GET['class'])) {
    $class_id = clean_up($_GET['class']);
    if($result = mysql_db_query("rowanprep", "SELECT * FROM classes WHERE class_id_key LIKE '$class_id'")) {
      $row = mysql_fetch_assoc($result);
      if (mysql_num_rows($result) !== 0) {
        $addnew = false;  
      }
    }
  }
  $class_name = clean_up($_POST["class_name"]);
  $teacher = clean_up($_POST["teacher"]);
  $pay_rate = clean_up($_POST["pay_rate"]);
  $day = clean_up($_POST["day"]);
  $semester = clean_up($_POST["semester"]);
  $year = clean_up($_POST["year"]);
  $total_number = clean_up($_POST["total_number"]);
  
  if ($addnew) {
    $sql = "INSERT INTO classes (class_name, teacher, pay_rate, day, semester, year, total_number) VALUES ('$class_name', '$teacher', '$pay_rate', '$day', '$semester', '$year', '$total_number')";
  } else {
      $sql = "UPDATE classes SET class_name='$class_name', teacher='$teacher', pay_rate='$pay_rate', day='$day', semester='$semester', year='$year', total_number='$total_number' WHERE class_id = '$class_id'";
  }
  $link = connectDB();
   $results = mysql_db_query("rowanprep", $sql);
   if(!$results) {
    echo 'Input failed...<br>';
    echo mysql_errno($link) . ": " . mysql_error($link). "\n";
   }
   else {
    header("Location:../../reports.php?tab=classes");
   }
?>