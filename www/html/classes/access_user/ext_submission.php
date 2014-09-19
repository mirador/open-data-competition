<?php 
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 

class Submission extends Access_user {
	
	var $profile_tbl_name =  SUBMISSIONS_TABLE;
	// var $profile_upd_page = ADD_SUBMISSION;
	
	var $avail_lang = array("nl", "de", "en", "fr");
	
	// var $profile_id;
	// var $address;
	// var $postcode;
	// var $city;
	// var $country;
	// var $phone;
	// var $fax;
	// var $homepage;
	// var $notes;
	// var $field_one;
	// var $field_two;
	// var $field_three;
	// var $field_four;
	
	var $selected;
	var $id;
	var $user_id; //not sure if i'll need these IDs
	var $db;
	var $var1;
	var $var2;
	var $ranges;
	var $history;
	
	var $count;
	var $selected_array;
	var $id_array;
	var $user_id_array;
	var $db_array;
	var $var1_array;
	var $var2_array;
	var $ranges_array;
	var $history_array;

	function Submission($check_profile = true, $redirect = true, $profile_upd_page = ADD_SUBMISSION) {
		$this->connect_db();
		if (empty($_SESSION['logged_in'])) {
			$this->login_reader();
			if ($this->is_cookie) {
				$this->set_user($redirect);
			}
		}
		if (isset($_SESSION['user'], $_SESSION['pw'])) {
			$this->user = $_SESSION['user'];
			$this->user_pw = $_SESSION['pw'];
			

			$get_profile = $this->get_profile_data();
			$this->get_submission_data();
			if ($check_profile && !$get_profile) {
				// header("Location: ".$this->profile_upd_page);
				header("Location: ".$profile_upd_page);
				exit;
			} else {
				if (empty($_SESSION['user_id'])) $_SESSION['user_id'] = $this->id;
			}
		}
	}

	function add_submission($user_id="", $db = "", $var1 = "", $var2 = "", $ranges = "", $history = ""){		
		$sql = sprintf("INSERT INTO %s (id, user_id, db, var1, var2, ranges, history) VALUES (NULL, %d, '%s', '%s', '%s', '%s','%s')",
		SUBMISSIONS_TABLE, $user_id, $db, $var1, $var2, $ranges, $history);
        mysql_query($sql) or die (mysql_error()); 
	}

    function select_submission($index) {
    	$this->selected_array[$index] = 1;
        $sid = $this->id_array[$index];
        $uid = $this->user_id_array[$index];
        $sql = sprintf("UPDATE %s SET selected='1' WHERE id='%d' AND user_id='%d'", SUBMISSIONS_TABLE, $sid, $uid);
        mysql_query($sql) or die (mysql_error()); 
    }

    function deselect_submission($index) {
    	$this->selected_array[$index] = 0;
        $sid = $this->id_array[$index];
        $uid = $this->user_id_array[$index];
        $sql = sprintf("UPDATE %s SET selected='0' WHERE id='%d' AND user_id='%d'", SUBMISSIONS_TABLE, $sid, $uid);
        mysql_query($sql) or die (mysql_error()); 
    }

	function create_form_field($formelement, $label, $length = 25, $required = false, $disabled = false, $euro_date = false) {
		$form_field = "<label for=\"".$formelement."\">".$label."</label>\n";
		$form_field .= "  <input name=\"".$formelement."\" type=\"text\" size=\"".$length."\" value=\"";
		if (isset($_REQUEST[$formelement])) {
			$form_field .= $_REQUEST[$formelement];
		} elseif (isset($this->$formelement) && !isset($_REQUEST[$formelement])) {
			$form_field .= ($euro_date && $this->$formelement != "") ? strftime("%d/%m/%Y", strtotime($this->$formelement)) : $this->$formelement;
		} else {
			$form_field .= "";
		}
		$form_field .= ($disabled) ? "\" disabled>" : "\">";
		$form_field .= ($required) ? "*<br>\n" : "<br>\n";
		return $form_field;		
	}

	function get_submission_data() {
		$this->get_user_info();
		$sql = sprintf("SELECT id, user_id, db, var1, var2, ranges, history, selected FROM %s WHERE user_id = %d", SUBMISSIONS_TABLE, $this->id);
		$result = mysql_query($sql) or die (mysql_error());
		if (mysql_num_rows($result) == 0) {
			$this->the_msg = $this->extra_text(1);
			return false;
		} else {

	        $this->count = mysql_num_rows($result);
	        $this->selected_array = array();
	        $this->id_array = array();
	        $this->user_id_array = array();
	        $this->db_array = array();
	        $this->var1_array = array();
	        $this->var2_array = array();
	        $this->ranges_array = array();
	        $this->history_array = array();

			$_SESSION['is_rec'] = true;
			while ($obj = mysql_fetch_object($result)) {
				array_push($this->selected_array, $obj->selected);
                array_push($this->id_array, $obj->id);
                array_push($this->user_id_array, $obj->user_id);
                array_push($this->db_array, $obj->db);
                array_push($this->var1_array, $obj->var1);
                array_push($this->var2_array, $obj->var2);
                array_push($this->ranges_array, $obj->ranges);
                array_push($this->history_array, $obj->history);
			}
			return true;
		}
	}

	function get_profile_data() {
		$this->get_user_info();
		$sql = sprintf("SELECT id, language, address, postcode, city, country, phone, fax, homepage, notes, %s AS field_one, %s AS field_two, %s AS field_three, %s AS field_four FROM %s WHERE users_id = %d", TBL_USERFIELD_1, TBL_USERFIELD_2, TBL_USERFIELD_3, TBL_USERFIELD_4, PROFILE_TABLE, $this->id);
		$result = mysql_query($sql) or die (mysql_error());
		if (mysql_num_rows($result) == 0) {
			$this->the_msg = $this->extra_text(1);
			return false;
		} else {
			$_SESSION['is_rec'] = true;
			while ($obj = mysql_fetch_object($result)) {
				$this->profile_id = $obj->id;
				$this->language = $obj->language;
				$this->address = $obj->address;
				$this->postcode = $obj->postcode;
				$this->city = $obj->city;
				$this->country = $obj->country;
				$this->phone = $obj->phone;
				$this->fax = $obj->fax;
				$this->homepage = $obj->homepage;
				$this->notes = $obj->notes;
				// remember the constants in the db_config file
				$this->field_one = $obj->field_one; 
				$this->field_two = $obj->field_two;
				$this->field_three = $obj->field_three;
				$this->field_four = $obj->field_four;
			}
			return true;
		}
	}

	function extra_text($msg_num) {
		switch ($this->language) {
			case "nl":
			$extra_msg[1] = "Op het moment is geen profiel data aanwezig.";
			$extra_msg[2] = "De profiel data is gewijzigd.";
			$extra_msg[3] = "Er is een fout ontstaam tijdens het update, probeer het opnieuw.";
			break;
			case "de":
			$extra_msg[1] = "Zur Zeit verf&uuml;gt dieses Konto �ber keine weiteren Profildaten.";
			$extra_msg[2] = "Die Profildaten wurden ge&auml;ndert.";
			$extra_msg[3] = "Es ist ein Fehler entstanden, bitte probieren Sie es erneut.";
			break;
			case "fr":
			$extra_msg[1] = "Le profil ne contient actuellement aucune information.";
			$extra_msg[2] = "Les information de votre profil sont � jour.";
			$extra_msg[3] = "Il y a eu un probl�me pendant la mise � jour de votre profil. Veuillez r�essayer.";
			break;
			default:
			$extra_msg[1] = "There is no profile data at the moment.";
			$extra_msg[2] = "Your profile data is up2date.";
			$extra_msg[3] = "There was an error during update, try it again.";
		}
		return $extra_msg[$msg_num];
	}


    /////////////////////////////////////////////////////////////
    // PROBABLY NOT NEEDED ANYTHING BELOW... 
	/*

	// use this method to get the messages in the language of the user (if exist)
	function login_local($user, $password) {
		$this->get_language($user, $password);
		$this->login_user($user, $password);
	}
	function get_language($user, $pw) {
		$sql = sprintf("SELECT up.language AS lang FROM %s AS u, %s AS up WHERE u.login = %s AND u.pw = '%s' AND u.id = up.users_id ", $this->table_name, $this->profile_tbl_name, $this->ins_string($user), md5($pw));
		$result = mysql_query($sql);
		if (mysql_num_rows($result) == 0) {
			return;
		} else {
			$lang = mysql_result($result, 0, "lang");
			if ($lang != "") {
				$this->language = $lang;
			} else {
				return;
			}
		}
	}
	
	function save_profile_date($ident = "", $lang = "", $address = "", $pc = "", $city = "", $country = "", $phone = "", $fax = "", $hp = "", $notes = "", $field1 = "", $field2 = "", $field3 = "", $field4 = "") {
		if (!empty($ident)) {
			$sql = sprintf("UPDATE %s SET language=%s, address=%s, postcode=%s, city=%s, country=%s, phone=%s, fax=%s, homepage=%s, notes=%s, %s=%s, %s=%s, %s=%s, %s=%s, last_change=NOW() WHERE id = %s AND users_id = %d", 
				PROFILE_TABLE, $this->ins_string($lang), $this->ins_string($address), $this->ins_string($pc),
				$this->ins_string($city), $this->ins_string($country), $this->ins_string($phone), $this->ins_string($fax),
				$this->ins_string($hp), $this->ins_string($notes), TBL_USERFIELD_1, $this->ins_string($field1),
				TBL_USERFIELD_2, $this->ins_string($field2), TBL_USERFIELD_3, $this->ins_string($field3),
				TBL_USERFIELD_4, $this->ins_string($field4), $this->ins_string($ident, "int"), $_SESSION['user_id']);
		} else {
			$sql = sprintf("INSERT INTO %s (id, users_id, language, address, postcode, city, country, phone, fax, homepage, notes, %s, %s, %s, %s, last_change) VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
				PROFILE_TABLE, TBL_USERFIELD_1, TBL_USERFIELD_2, TBL_USERFIELD_3, 
				TBL_USERFIELD_4, $_SESSION['user_id'], $this->ins_string($lang), $this->ins_string($address), 
				$this->ins_string($pc), $this->ins_string($city), $this->ins_string($country), $this->ins_string($phone), 
				$this->ins_string($fax), $this->ins_string($hp), $this->ins_string($notes), $this->ins_string($field1),
				$this->ins_string($field2), $this->ins_string($field3), $this->ins_string($field4));
		}	
		if (mysql_query($sql) or die (mysql_error())) {
			$this->profile_id = (empty($_SESSION['is_rec'])) ? mysql_insert_id() : $ident;
			$this->the_msg = $this->extra_text(2);
		} else {
			$this->the_msg = $this->extra_text(3);
		}
	}


	
	// some form elements
	function language_menu($label) {
		$lang_select = "<label for=\"language\">".$label."</label>\n";
		$lang_select .= "<select name=\"language\">\n";
		foreach ($this->avail_lang as $val) {
			$lang_select .= "  <option value=\"".$val."\"";
			if (isset($_REQUEST['language'])) {
				$lang_select .= ($val == $_REQUEST['language']) ? " selected" : "";
			} else {
				$lang_select .= ($val == $this->language) ? " selected" : "";
			}
			$lang_select .= ">".$val."</option>\n";
		}
		$lang_select .= "</select><br>\n";
		return $lang_select;
	}
	// install the "countries_table.sql" first
	function create_country_menu($label) {
		$sql_countries = sprintf("SELECT iso, name FROM %s ORDER BY id", COUNTRY_TABLE);
		$res_countries = mysql_query($sql_countries);
		$menu = "<label for=\"country\">".$label."</label>\n";
		$menu .= "<select name=\"country\">\n";
        $menu .= "  <option value=\"\"";
		$menu .= (!isset($_REQUEST['country'])) ? " selected" : "";
		$menu .= ">...\n";
    	while ($obj = mysql_fetch_object($res_countries)) {
			$menu .= "  <option value=\"".$obj->iso."\"";
			if (isset($this->country) && !isset($_REQUEST['country'])) {
				$menu .= ($obj->iso == $this->country) ? " selected" : "";
			} else {
				$menu .= (isset($_REQUEST['country']) && $obj->iso == $_REQUEST['country']) ? " selected" : "";
			}
			$menu .= ">".$obj->name."</option>\n";
    	}
		$menu .= "</select><br>\n";
		mysql_free_result($res_countries);
		return $menu;
	}

	function create_text_area($text_field, $label) {
		$textarea = "<label for=\"".$text_field."\">".$label."</label>\n";
		$textarea .= "  <textarea name=\"".$text_field."\">";
		if (isset($_REQUEST[$text_field])) {
			$textarea .= $_REQUEST[$text_field];
		} elseif (isset($this->$text_field)) {
			$textarea .= $this->$text_field;
		} else {
			$textarea .= "";
		}
		$textarea .= "</textarea><br>\n";
		return $textarea;		
	}
	*/
}
?>
