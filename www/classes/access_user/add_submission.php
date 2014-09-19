<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/ext_submission.php"); 
error_reporting (E_ALL); // I use this only for testing

$add_submission = new Submission(false, false); // need to be false otherwise the redirect to this page will not work
//$add_submission->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // protect this page too.


if (isset($_POST['Submit'])) {
		
		
		
		$add_submission->user = $_POST['login'];
			$add_submission->user_pw = md5($_POST['password']);
			if ($add_submission->check_user()) {
				$_SESSION['user'] = $add_submission->user;
				$_SESSION['pw'] = $add_submission->user_pw;
				$user_id = $add_submission->getID();
					
				// $add_submission->login_saver();
				
				//echo "HOORAY";

				// if ($add_submission->count_visit) {
					// $add_submission->reg_visit($user, $this->user_pw);
				//}
				// $add_submission->set_user(false);
				// $add_submission->the_msg = $add_submission->messages(10);
			} else {
				$add_submission->the_msg = $add_submission->messages(10);
			}
		
		
		
	//	$add_submission->login_user($_POST['login'], $_POST['password']);	
		$add_submission->add_submission($user_id, $_POST['db'], $_POST['var1'], $_POST['var2'], $_POST['ranges'], $_POST['history']); 
	
	
	
}  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Add submission</title>
<style type="text/css">
<!--
body {
	font:0.85em Arial, Helvetica, sans-serif;
	text-align:center;
	margin:0;
}
label {
	display: block;
	float: left;
	width: 160px;
	margin-right:5px;
}
form div {
	clear:both;
	padding-top:5px;
}
#container {
	padding:5px 10px;
	text-align:left;
	margin:10px auto;
	width:640px;
	border:1px solid #CCCCCC;
}
-->
</style>
</head>

<body>
  <div id="container">
	<h2>Add submission:</h2>
	<p>A dummy form for entry into the submissions table. Login required to access this page.</p>
	<p style="color:#FF0000;font-weight:bold;"><?php echo $add_submission->the_msg; ?>&nbsp;</p>
	
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <label for="login">Login:</label>
    <input type="text" name="login" size="20" ><br>
    <label for="password">Password:</label>
    <input type="password" name="password" size="8" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br>

	  <?php 
	  // echo $add_submission->create_form_field("login", "Login:");
	  // echo $add_submission->create_form_field("password", "Password:");
	  echo $add_submission->create_form_field("db", "Database:");
	  echo $add_submission->create_form_field("var1", "Variable 1:");
	  echo $add_submission->create_form_field("var2", "Variable 2:");
  	  echo $add_submission->create_form_field("ranges", "Ranges:");
	  echo $add_submission->create_form_field("history", "History:");
	  ?>
	  
	  <label for="Submit">Submit</label>
	  <input type="submit" name="Submit" value="Update">
	  
	</form>
 </div>
 <p><a href="<?php echo $add_submission->main_page; ?>">Main</a></p>
</body>
</html>
