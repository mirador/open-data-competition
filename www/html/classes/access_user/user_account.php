<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

$page_protect = new Access_user;
// $page_protect->login_page = "login.php"; // change this only if your login is on another page
$page_protect->access_page(); // only set this this method to protect your page
$page_protect->get_user_info();
$hello_name = ($page_protect->user_full_name != "") ? $page_protect->user_full_name : $page_protect->user;

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	$page_protect->log_out(); // the method to log off
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Account page</title>
<link rel="stylesheet" type="text/css" href="/css/main.css"/>
</head>

<body>
<div id="main-con">
  <div id="header-con">
    <div id="img"></div>
    <div id="title"><h1>mirador</h1></div>
  </div>
  <div id="intro" class="basic">
  </div>  
  <div id="body-con" class="basic">
    <h2><?php echo "Hello ".$hello_name."!"; ?></h2>
    <br>

    <p>You are currently logged in.</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- Notice! you have to change this links here, if the files are not in the same folder -->
    <!-- <p><a href="./update_user.php">Update user account</a></p> -->
    <a href="./update_user_profile.php"><div class="user-account">Update user profile</div></a>
    <a href="./view_submissions.php"><div class="user-account">View submissions</div></a>
    <!-- <p><a href="/classes/access_user/test_access_level.php">test access level </a>(level 5 is used) </p> -->
    <!-- <p><a href="/classes/access_user/admin_user.php">Admin page (user / access level update) </a>(only access for admin accounts with level: <?php echo DEFAULT_ADMIN_LEVEL; ?>) </p> -->
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=log_out"><div class="user-account">Click here to log out.</div></a>

  </div>
</div>
</body>

</html>

