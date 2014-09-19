<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

$new_member = new Access_user;
// $new_member->language = "de"; // use this selector to get messages in other languages

if (isset($_POST['Submit'])) { // the confirm variable is new since ver. 1.84
	// if you don't like the confirm feature use a copy of the password variable
	$new_member->register_user($_POST['login'], $_POST['password'], $_POST['confirm'], $_POST['name'], $_POST['info'], $_POST['email']); // the register method
} 
$error = $new_member->the_msg; // error message

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sign up</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
 -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sign up</title>
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
    <h2>Sign up</h2>
    <br>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<!--       
      <input type="text" name="login" placeholder="User name" size="50" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : ""; ?>">
      <input type="password" name="password" placeholder="Password" size="50" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ""; ?>">
      <input type="password" name="confirm" placeholder="Confirm password" size="50" value="<?php echo (isset($_POST['confirm'])) ? $_POST['confirm'] : ""; ?>">
      <input type="text" name="name" placeholder="Real name" size="50" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ""; ?>">
      <br>
      <input type="text" name="email" placeholder="Email address" size="50" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>">
      <br>
 -->

<!--         
        <input name="name" placeholder="First name" size="50" type="text">
        <br>
        <input name="name" placeholder="Last name" size="50" type="text">
        <br>
 -->        
        <input name="name" placeholder="Full name" size="50" type="text" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ""; ?>">
        <br> 
        <input name="login" placeholder="User name" size="50" type="text" value="<?php echo (isset($_POST['login'])) ? $_POST['login'] : ""; ?>">
        <br>
        <input name="password" placeholder="Password" size="50" value="" type="password" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : ""; ?>">
        <br>
        <input name="confirm" placeholder="Confirm password" size="50" value="" type="password" value="<?php echo (isset($_POST['confirm'])) ? $_POST['confirm'] : ""; ?>">
        <br>        
        <input name="email" placeholder="Email address" size="50" type="text" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>">
        <br>
        <br>

      <input type="submit" name="Submit" value="Submit">
    </form>
    <p><b><?php echo (isset($error)) ? $error : "&nbsp;"; ?></b></p>
    <p>&nbsp;</p>

    <!-- Notice! you have to change this links here, if the files are not in the same folder -->
    <!-- <p><a href="<?php echo $new_member->login_page; ?>">Login</a></p> -->

  </div>
</div>
</body>
</html>
