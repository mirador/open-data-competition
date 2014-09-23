<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

$renew_password = new Access_user;

if (isset($_POST['Submit'])) {
	$renew_password->forgot_password($_POST['email']);
} 
$error = $renew_password->the_msg;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Password recovery</title>
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
    <h2>Forgot your password/login?</h2>
    <p>Please enter the email address what you have used during registration.</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input name="email" placeholder="Email address" size="50" type="text" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>">
      <input type="submit" name="Submit" value="Submit">
    </form>
    <p><b><?php echo (isset($error)) ? $error : "&nbsp;"; ?></b></p>
    <p>&nbsp;</p>
    <!-- Notice! you have to change this links here, if the files are not in the same folder -->
    <a href="<?php echo $renew_password->login_page; ?>"><div class="user-account secondary">Back</div></a>
  </div>
</div>
</body>
</html>
