<?php
	function check_required_fields($required_array) {
		$field_errors = array();
		foreach($required_array as $fieldname ) {
			if(!isset($_POST[$fieldname])|| (empty($_POST[$fieldname]) && $_POST[$fieldname] !=0)) {
				$errors[] = $fieldname;
			}
		}
		return $field_errors;
	}
	
	function check_max_field_lengths($field_length_array) {
		$field_errors = array();
		foreach($feild_length_array as $feildname => $maxlength) {
			if(strlen(trim(mysql_prep($_POST[$feildname]))) > $maxlength) {
				$field_errors[] = $feildname." exceeds maximum length";
			}
		}
		return $field_errors;
	}
	
	function display_errors($error_array) {
		echo "<p class=\"errors\">";
		echo "Please review the following fields: <br />";
		foreach($error_array as $error) {
			echo " - " . $error . "<br />";
		}
		echo "</p>";
	}
?>