<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$menu_name = mysql_prep($_POST['menu_name']);
	$position = mysql_prep($_POST['position']);
	$visible = mysql_prep($_POST['visible']);
?>

<?php
	$required_fields = array('menu_name', 'position', 'visible');
	$errors[] = check_required_fields($required_fields);
	
	$feild_with_lengths = array('menu_name' => 30);
	$errors[] = check_max_field_lengths($feild_with_lengths);
	
	if(!empty($errors)) {
		redirect_to("new_subject.php");
	}
?>
<?php
	$query = "INSERT INTO subjects (
				menu_name, position, visible
				) VALUES (
					'{$menu_name}', {$position}, {$visible}
				)";
	$result = mysql_query($query, $connection);
	if($result) {
		redirect_to("content.php");
	} else {
		echo "<p>Subject Creation Failed</p>";
		echo "<p>". mysql_error()."</p>";
	}
?>
<?php mysql_close($connection); ?>