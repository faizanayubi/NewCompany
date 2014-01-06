<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if(intval($_GET['page']) == 0) {
		redirect_to("content.php");
	}
	
	include_once("includes/form_functions.php");
	if(isset($_POST['submit'])) {
		$errors = array();
		
		$required_fields = array('menu_name', 'position', 'visible');
		$errors = array_merge($errors, check_required_fields($required_fields));
		
		$feilds_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($feilds_with_lengths));
		
		$id = mysql_prep($_GET['page']);
		$menu_name 
		= trim(mysql_prep($_POST['menu_name']));
		$position = mysql_prep($_POST['position']);
		$visible = mysql_prep($_POST['visible']);
		$content = mysql_prep($_POST['content']);
			
		if(empty($errors)) {
			$query = "UPDATE pages SET
						menu_name = '{$menu_name}',
						position = {$position},
						visible = {$visible},
						content = '{$content}' 
						WHERE id = {$id}";
			$result = mysql_query($query, $connection);
			if(mysql_affected_rows() == 1) {
				//sucess
				$message = "The Subject was sucessfully updated";
			} else {
				$message = "The Subject Update failed. ";
				$message .= "<br />".mysql_error();
			}
		} else {
			if(count($errors) == 1) {
				$message = "There were 1 error in the form.";
			} else {
				$message = "There were ". count($errors) ." errors in the form";
			}
		}	
	}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subject, $sel_page); ?>
			<br />
			<a href="new_subject.php">+ Add new subject</a>
		</td>
		<td id="page">
			<h2>Edit Subject: <?php echo $sel_page['menu_name']; ?></h2>
			<?php if(!empty($message)) { echo "<p class=\"message\">{$message}</p>"; } ?>
			<?php if(!empty($errors)) { display_errors($errors); } ?>
			<form action="edit_subject.php?page=<?php echo urlencode($sel_page['id']); ?>" method="post">
				<?php include "page_form.php"?>
				<input type="submit" name="submit" value="Update Page" />
				&nbsp;&nbsp;
				<a href="delete_page.php?page=<?php echo urlencode($sel_page['id']); ?>" onclick="return confirm('Are you sure?');">Delete Page</a>
			</form>
			<br />
			<a href="content.php?page=<?php echo urlencode($sel_page['id']); ?>">Cancel</a><br />
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>