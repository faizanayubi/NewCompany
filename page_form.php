
<p>Page name:  <input type="text" name="menu_name" value="<?php echo $sel_page['menu_name']; ?>" id="menu_name" /></p>
<p>Position:
	<select name="position">
	<?php
		$subject_set = get_pages_for_subjects($sel_subject['']);
		$subject_count = mysql_num_rows($subject_set);
		for($count=1; $count<=$subject_count+1; $count++) {
			echo "<option value=\"{$count}\"";
			if($sel_subject['position'] == $count) {
				echo " selected";
			}
			echo ">{$count}</option>";
		}
	?>
	</select></p>
<p>Visible:
	<input type="radio" name="visible" value="0" <?php if($sel_subject['visible'] == 0) { echo " checked"; } ?> />NO
	&nbsp;
	<input type="radio" name="visible" value="1" <?php if($sel_subject['visible'] == 1) { echo " checked"; } ?> />YES
</p>