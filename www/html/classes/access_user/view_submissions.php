<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/ext_submission.php"); 
error_reporting (E_ALL); // I use this only for testing

// $update_profile = new Users_profile(false); // need to be false otherwise the redirect to this page will not work
// $update_profile->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // protect this page too.
$view_submission = new Submission(false, false, VIEW_SUBMISSIONS); // protect this page too.

if (isset($_POST['Submit'])) { 
  if (1 < $view_submission->count) {
  	$i = 0;
    $sel_count = 0;
    while ($i < $view_submission->count) {
      // Unckecked checkboxes are not posted
      // http://stackoverflow.com/questions/12115373/detect-unchecked-checkbox-php
      if (isset($_POST['selected'.$i])) {
      	$sel_count++;
      }
      $i++;
    }    

    if (3 < $sel_count) {
      // Too many selected submissions, warn the user and don't save changes.
      echo '<script type="text/javascript">';
      echo 'window.alert("Please select no more than three findings for final evaluation!")';
      echo '</script>';
    } else {
      $i = 0;
      while ($i < $view_submission->count) {
        if (isset($_POST['selected'.$i])) {
          $view_submission->select_submission($i);
        } else {
          $view_submission->deselect_submission($i);
        }
        $i++;
      }
    }
  }
}  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Submissions</title>
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
	<h2>Submissions</h2>
	<br>
<!-- 	<p>This forms is an example how to update the user and user-profile information, 
	fields with a * are required and keep the password field(s) empty if you don't want to change it.</p>
	<p style="color:#FF0000;font-weight:bold;"><?php echo $update_profile->the_msg; ?>&nbsp;</p>
 -->	
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	  
	  <?php
      if ($view_submission->count == 0) {
          echo '<p>Nothing sumbitted yet...</p>';
          return;
      }       
      if (3 < $view_submission->count) {
        echo '<p>You can select up to 3 submissions to be evaluated by the jury, please select using checkboxes.</p>';
        echo '<br>';
      }

      echo '<table>';
      echo '<tr>';
      $i = 0;     
      if (3 < $view_submission->count) echo '<th>SELECTED</th>';
      echo '<th>DATASET</th>';
      echo '<th>VARIABLE 1</th>';
      echo '<th>VARIABLE 2</th>';
      echo '<th>RANGES</th>';
      echo '</tr>';
     
      while ($i < $view_submission->count) {
        echo '<tr>';
        if (3 < $view_submission->count) {
          $checked = '';
          if ($view_submission->selected_array[$i]) {
            $checked = 'checked';
          }
          echo '<td><input type="checkbox" name="selected'.$i.'" '.$checked.'/></td>';
        }
        echo '<td>'.$view_submission->db_array[$i].'</td>';
        echo '<td>'.$view_submission->var1_array[$i].'</td>';
        echo '<td>'.$view_submission->var2_array[$i].'</td>';
        echo '<td>'.str_replace("\n", "<br>", $view_submission->ranges_array[$i]).'</td>';
        echo '</tr>';
        $i++;
      }
      echo '</table>';
	  ?>

    <br>
    <div name="menu">
    <?php
      if (3 < $view_submission->count) {
	      echo '<input type="submit" name="Submit" value="Update">';
      }
    ?>    	  
	  </div>

    <a href="<?php echo $view_submission->main_page; ?>">Go back</a>
    <!-- <p><a href="<?php echo $view_submission->main_page; ?>">Go back</a></p> -->

<!-- 	  <div>
		<label for="Submit">&gt;&gt;</label>
		<input type="hidden" name="id" value="<?php echo  $update_profile->profile_id; ?>">
		<input type="submit" name="Submit" value="Update">
	  </div> -->
	</form>
 </div>



</div>
</body>

</html>
