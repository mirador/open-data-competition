<?php 
require($_SERVER['DOCUMENT_ROOT']."/classes/access_user/db_config.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Log out page</title>
<link rel="stylesheet" type="text/css" href="/css/main.css"/>
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<div id="main-con">
  <div id="header-con">
    <div id="img"></div>
    <div id="title"><h1>mirador</h1></div>
  </div>
  <div id="intro" class="basic">
  </div>  
  <div id="body-con" class="basic">
    <h3>Logged out!</h3>
    <a href="<?php echo LOGIN_PAGE; ?>"><div class="user-account">Login (again)</div></a>
  </div>
</div>
</body>

</html>
