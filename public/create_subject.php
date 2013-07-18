<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	if (isset($_POST['submit'])) {
		// Process the form

		$menu_name = mysql_formatter($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];

		// validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if (!empty($errors)) {
			$_SESSION["errors"] = $errors;
			redirect_to("new_subject.php");
		}

		// 2. Perform DB query
		$query = "INSERT INTO subjects (";
		$query .= " menu_name, position, visible";
		$query .= ") VALUES (";
		$query .= " '{$menu_name}', {$position}, {$visible}";
		$query .= ")";
		$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if ($result) {
			// Success
			$_SESSION["message"] = "Subject Created!";
			redirect_to("manage_content.php");
		} else {
			// Failure
			$_SESSION["message"] = "OOPS...Subject creation failed";
			redirect_to("new_subject.php");
		}
	} else {
		// This is probably a GET request
		redirect_to("new_subject.php");
	}
?>

<?php if (isset($connection)) { mysqli_close($connection); } ?>