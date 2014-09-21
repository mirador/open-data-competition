<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

$my_access = new Access_user(false);


// $my_access->language = "de"; // use this selector to get messages in other languages
if (isset($_GET['activate']) && isset($_GET['ident'])) { // this two variables are required for activating/updating the account/password
	$my_access->auto_activation = true; // use this (true/false) to stop the automatic activation
	$my_access->activate_account($_GET['activate'], $_GET['ident']); // the activation method 
}
if (isset($_GET['validate']) && isset($_GET['id'])) { // this two variables are required for activating/updating the new e-mail address
	$my_access->validate_email($_GET['validate'], $_GET['id']); // the validation method 
}
if (isset($_POST['Submit'])) {
	$my_access->save_login = (isset($_POST['remember'])) ? $_POST['remember'] : "no"; // use a cookie to remember the login
	$my_access->count_visit = false; // if this is true then the last visitdate is saved in the database (field extra info)
	$my_access->login_user($_POST['login'], $_POST['password']); // call the login method
} 
$error = $my_access->the_msg; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sign in</title>
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
    <h2>Sign in</h2>
    <br>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<!--       
      <input type="text" name="login" placeholder="User name" size="50" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : $my_access->user; ?>">
      <br>
      <input type="password" placeholder="Password" size="50" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
      <br>
      <br>
 -->

      <input name="login" placeholder="User name" size="50" type="text" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : $my_access->user; ?>">
      <br>
      <input name="password" placeholder="Password" size="50" value="" type="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
      <br>
      <br>
      
      <input type="submit" name="Submit" value="submit">
    </form>
    <p><b><?php echo (isset($error)) ? $error : "&nbsp;"; ?></b></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <!-- Notice! you have to change this links here, if the files are not in the same folder -->
    <p>Not registered yet? <a href="./register.php">Click here.</a></p>
    <p><a href="./forgot_password.php">Forgot your password?</a></p>
    <!-- <p><a href="login_local.php">Login with messages according user's language settings </a><br>(only for users with a profile)</p> -->

  </div>
</div>
</body>
</html>
