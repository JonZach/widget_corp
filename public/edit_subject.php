<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php include("../includes/layouts/header.php"); ?>

<?php
	if (!$current_subject) {
		redirect_to("manage_content.php");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		// Process the form

		// validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if (empty($errors)) {
			// Perform Update

			$id = $current_subject["id"];
			$menu_name = mysql_formatter($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];

			// 2. Perform DB query
			$query = "UPDATE subjects SET ";
			$query .= "menu_name = '{$menu_name}', ";
			$query .= "position = {$position}, ";
			$query .= "visible = {$visible} ";
			$query .= "WHERE id = {$id} ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if ($result && mysqli_affected_rows($connection) == 1) {
				// Success
				$_SESSION["message"] = "Subject Updated!";
				redirect_to("manage_content.php");
			} else {
				// Failure
				$message = "OOPS...Subject update failed";
			}
		}
	} else {
		// This is probably a GET request
	}
?>

<div id="main">
	<div id="navigation">
		<?php echo navigation ($current_subject, $current_page); ?>
	</div>
	<div id="page">
		<?php // $message is just a variable, does not use SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . $message . "</div>";
			}
		?>
		<?php echo form_errors($errors); ?>

		<h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?></h2>

		<form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
			<p>Subject Name:
				<input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>" />
			</p>
			<p>Position:
				<select name="position">
				<?php
					$subject_set = find_all_subjects();
					$subject_count = mysqli_num_rows($subject_set);
					for($count = 1; $count <= ($subject_count); $count++) {
						echo "<option value=\"{$count}\"";
						if ($current_subject["position"] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
				?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" <?php if ($current_subject["visible"] == 0) {echo "checked"; } ?>/> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($current_subject["visible"] == 1) {echo "checked"; } ?>/> Yes
			</p>
			<input type="submit" name="submit" value="Edit Subject" />
		</form>
		</br>
		<a href="manage_content.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>