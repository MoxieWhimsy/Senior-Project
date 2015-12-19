<?php
	function logged_in() {
		return(isset($_SESSION['id'])) ? true : false;
	}

	function isAdmin() {
		$user_key = $_SESSION['id'];
		$results = mysql_db_query("rowanprep", "SELECT * FROM users WHERE user_key LIKE '$user_key' AND admin = 1 ");
		$rows = mysql_fetch_assoc($results);
		if(mysql_num_rows($results) === 0)
			return false;
		else
			return true;
	}

	function random_password($length) {
		    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		    $password = substr( str_shuffle( $chars ), 0, $length );
		    return $password;
		}

	function get_name($user_key) {
		$user_key = clean_up($user_key);
		$results = mysql_db_query("rowanprep", "SELECT username FROM users WHERE user_key ='$user_key'");
		$rows = mysql_fetch_assoc($results);
		return $rows['username'];
	}

	function user_exists($username) {
		$username = clean_up($username);
		$result = mysql_db_query("rowanprep", "SELECT * FROM users WHERE username = '$username'");
		if(empty($result))
			return false;
		else
			return true;
	}

	function get_user_id($username) {
		$username = clean_up($username);
		$result = mysql_db_query("rowanprep", "SELECT user_key FROM users WHERE username = '$username'");
		return $result;
	}

	function login($username, $password) {
		$user_key = get_user_id($username);
		$results = mysql_db_query("rowanprep", "SELECT user_key FROM users WHERE username = '$username' AND password = '$password'");
		if(empty($results))
			return false;
		else
			return $user_key;
	}

	function store_phone($data) {
		return str_replace("-", "", $data);
	}
	function display_phone($data) {
		return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $data);
	}
	function clean_up($data) {
		return mysql_real_escape_string($data);
	}
	function get_student_list($sort) {
		switch($sort) {
			case '1';
				return $results = mysql_db_query("rowanprep","SELECT * FROM students ORDER BY last_name");
			break;
			case '2':
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students ORDER BY first_name");
			break;
			case '3';
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students ORDER BY teacher");
			break;
			case '4':
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students ORDER BY instrument");
			break;
			case '5':
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students ORDER BY photo_release");
			break;

			default:
				return $results = mysql_db_query("rowanprep","SELECT * FROM students");
			break;
		}
	}
	function get_teacher_list($sort){
		switch($sort) {
			case 1: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM teachers ORDER BY last_name");
			break;
			case 2:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM teachers ORDER BY first_name");
			break;
			case 3: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM teachers ORDER BY instrument");
			break;
			default:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM teachers");
			break;
		}
	}
	function get_lessons_list($sort){
		switch($sort) {
			case 1: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN lessons les ON les.student = st.student_key ORDER BY last_name");
			break;
			case 2:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM teachers tea JOIN lessons les ON les.teacher = tea.teacher_key ORDER BY last_name");
			break;
			case 3: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM lessons ORDER BY instrument");
			break;
			case 4:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM lessons ORDER BY day");
			break;
			default:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM lessons");
			break;
		}
	}
	function get_orchestra_list($sort){
		switch($sort) {
			case 1: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN orchestra ryor ON ryor.student = st.student_key ORDER BY last_name");
			break;
			case 2:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN orchestra ryor ON ryor.student = st.student_key ORDER BY first_name");
			break;
			case 3: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN orchestra ryor ON ryor.student = st.student_key ORDER BY ryor.instrument");
			break;
			case 4:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN orchestra ryor ON ryor.student = st.student_key ORDER BY tuition_owed DESC");
			break;
			default:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN orchestra ryor ON ryor.student = st.student_key"); //"SELECT * FROM `orchestra`");			break;
		}
	}
	function get_band_list($sort){
		switch($sort) {
			case 1: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN brass_band bb ON bb.student = st.student_key ORDER BY last_name");
			break;
			case 2:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN brass_band bb ON bb.student = st.student_key ORDER BY first_name");
			break;
			case 3: 
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN brass_band bb ON bb.student = st.student_key ORDER BY bb.instrument");
			break;
			case 4:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN brass_band bb ON bb.student = st.student_key ORDER BY tuition_owed DESC");
			break;
			default:
				return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN brass_band bb ON bb.student = st.student_key"); //"SELECT * FROM `orchestra`");			break;
		}
	}
	function get_class_list() {
		return $results = mysql_db_query("rowanprep", "SELECT * FROM classes JOIN teachers ON teacher_key = teacher");

	}
	function get_class_student_list($key) {
		return $results = mysql_db_query("rowanprep", "SELECT * FROM class_link JOIN students ON student_key = student WHERE class_ref = '$key'");
	}
	function get_student_name($key){
		return $results = mysql_db_query("rowanprep", "SELECT last_name, first_name FROM students WHERE student_key =  '$key'");
	}
	function get_teacher_name($key){
		return $results = mysql_db_query("rowanprep", "SELECT last_name, first_name FROM teachers WHERE teacher_key =  '$key'");
	}
	function get_student_info($key){
		return $results = mysql_db_query("rowanprep", "SELECT last_name, first_name, student_email, parent_email 
										FROM students WHERE student_key =  '$key'");
	}
	function get_student_lessons($key) {
		return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN lessons el ON el.student = st.student_key WHERE st.student_key = '$key'"); 
	}
	function get_teacher_lessons($key) {
		return $results = mysql_db_query("rowanprep", "SELECT * FROM students st JOIN lessons el ON el.teacher = te.teacher_key WHERE te.teacher_key = '$key'"); 
	}
	function get_lesson_payments($key) {
		return $results = mysql_db_query("rowanprep", "SELECT * FROM payments ps JOIN lessons el ON ps.lesson = el.lesson_key WHERE el.lesson_key = '$key'"); 
	}
	function get_teacher_payments($key) {
		return $results = mysql_db_query("rowanprep", "SELECT st.first_name AS student_first_name, st.last_name AS student_last_name,ps.payment_date,ps.amount_paid FROM lessons el JOIN payments ps ON el.lesson_key = ps.lesson JOIN students st ON st.student_key = el.student WHERE el.teacher = '$key'"); 
	}
	function get_student_payments($key) {
		return $results = mysql_db_query("rowanprep", "SELECT st.first_name AS student_first_name, st.last_name AS student_last_name,ps.payment_date,ps.amount_paid FROM lessons el JOIN payments ps ON el.lesson_key = ps.lesson JOIN students st ON st.student_key = el.student WHERE el.student = '$key'"); 
	}

	function get_payment($option, $key) {	
		return $results = mysql_db_query("rowanprep", "SELECT * FROM payments WHERE id = '$key' AND type = '$option'");		
	}
	//TODO not working!!
	function get_class_payment($option, $key, $student_key) {	
		return $results = mysql_db_query("rowanprep", "SELECT * FROM payments pm JOIN class_link cl ON cl.class_ref = pm.id WHERE type = '$option' AND pm.student = '$student_key'");
	}
	function get_teacher_timesheet($teacher)
	{
		// $sql_lessons = 	"SELECT st.first_name AS student_first_name, st.last_name AS student_last_name, te.first_name, te.last_name, el.tuition_due, el.tuition_paid, el.tuition_owed, el.instrument, el.duration FROM lessons el " .
		// 		"JOIN students st ON el.student = st.student_key JOIN teachers te ON el.teacher = te.teacher_key JOIN payments ps ON ps.lesson = el.lesson_key WHERE el.lesson_key = '$key'";
		$sql_lessons = 	"SELECT concat(st.first_name, ' ', st.last_name) AS student_name, concat(el.total_lessons, ' x ', el.pay_rate) AS total_lessons_formatted, el.total_lessons AS total_lessons, el.pay_rate AS pay_rate FROM lessons el " .
					"JOIN students st ON el.student = st.student_key JOIN teachers te ON el.teacher = te.teacher_key WHERE te.teacher_key = $teacher";

		return $results = mysql_db_query("rowanprep", $sql_lessons); 
	}


?>
