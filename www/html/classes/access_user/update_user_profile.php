<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/ext_user_profile.php"); 
error_reporting (E_ALL); // I use this only for testing

$update_profile = new Users_profile(false); // need to be false otherwise the redirect to this page will not work
$update_profile->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // protect this page too.



if (isset($_POST['Submit'])) {
	// if ($_POST['user_email'] == "" || $_POST['address'] == "" || $_POST['postcode'] == "" || $_POST['city'] == "") {
	// 	$update_profile->the_msg = "Please fill the required fields.";
	// } else { 
		$update_profile->update_user($_POST['password'], $_POST['confirm'], $_POST['user_full_name'], "", $_POST['user_email']); // the update method
	
		// $eu_date_field = (!empty($_POST['field_two'])) ? $_POST['field_two']."##eu_date" : $_POST['field_two']; 
		// add the eu date field information ONLY if the field is not empty
		
		// $update_profile->save_profile_date($_POST['id'], $_POST['language'], $_POST['address'], 
		//                                    $_POST['postcode'], $_POST['city'], $_POST['country'], "", "", 
		//                                    $_POST['homepage'], $_POST['notes'], $_POST['field_one'], $eu_date_field, $_POST['field_three']); 
		$update_profile->save_profile_date($_POST['id'], "", $_POST['address'], 
		                                   $_POST['postcode'], $_POST['city'], $_POST['country'], "", "", 
		                                   $_POST['homepage'], "", "", "", ""); 

	// }
}  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>User profile</title>
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
	<h2>Profile for <?php echo $update_profile->user; ?></h2>
<!-- 	<p>This forms is an example how to update the user and user-profile information, 
	fields with a * are required and keep the password field(s) empty if you don't want to change it.</p>
 -->	
    <!-- <p style="color:#FF0000;font-weight:bold;"><?php echo $update_profile->the_msg; ?>&nbsp;</p> -->
	
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <!-- <div>
		<label for="login">Login:</label>
	 -->	
	 <!-- <input type="text" disabled="disabled" size="10" value="<?php echo $update_profile->user; ?>" style="font-weight:bold;"> -->

<!-- 	  </div>
	  <div>
		<label for="password">Password:</label>
 -->		
     <input name="password" placeholder="New password" size="50" value="" type="password" value="">
     <br>
<!-- 	  </div>
	  <div>
		<label for="confirm">Confirm password:</label>
 -->
 	 <input name="confirm" placeholder="Confirm password" size="50" value="" type="password" value="">
 	 <br>
<!-- 		*
	  </div>
 -->	  
      <?php 
	  echo "<div>".$update_profile->create_form_field_simple("user_full_name", "Full name")."</div>";
	  echo "<div>".$update_profile->create_form_field_simple("user_email", "Email address")."</div>";
	  echo "<div>".$update_profile->create_form_field_simple("homepage", "Homepage")."</div>";
	  // echo "<div>".$update_profile->create_form_field("user_info", "Extra info:", 20)."</div>";
	  // start fields from the profile table
	  // echo "<div>".$update_profile->create_form_field("field_one", "Company name <br>(user field 1")."</div>";
	  echo "<div>".$update_profile->create_form_field_simple("address", "Address")."</div>";
	  echo "<div>".$update_profile->create_form_field_simple("postcode", "Postal code")."</div>";
	  echo "<div>".$update_profile->create_form_field_simple("city", "City")."</div>";
	  echo "<div>".$update_profile->create_country_menu("Country")."</div>";
	  
	  // echo "<div>".$update_profile->create_text_area("notes", "Signature or comment...")."</div>";
	  // You have to use the same field like the variable in the class 
	  // echo "<div>".$update_profile->create_form_field("field_two", "Euro Date dd/mm/yyyy<br>(user field 2)", 10, false, false, true)."</div>";
	  // echo "<div>".$update_profile->create_form_field("field_three", "US Date yyyy-mm-dd<br>(user field 3)", 10)."</div>";
	  // echo "<div>".$update_profile->language_menu("Language")."</div>";
	  ?>
	  <div name="menu">
		<!-- <label for="Submit">&gt;&gt;</label> -->
		<br>
		<input type="hidden" name="id" value="<?php echo  $update_profile->profile_id; ?>">
		<input type="submit" name="Submit" value="Update">
	  </div>
	  <br>
	  <a href="<?php echo $update_profile->main_page; ?>"><div class="user-account secondary">Go back</div></a>
	</form>
 </div>

 

</div>
</body>

</html>
