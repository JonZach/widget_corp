<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	if (isset($_POST['submit'])) {
		// Process the form

		$menu_name = mysql_formatter($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];

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
			redirect_to("manage_content.php");
		} else {
			// Failure
			// $message = "Subject creation failed";
			redirect_to("new_subject.php");
		}
	} else {
		// This is probably a GET request
		redirect_to("new_subject.php");
	}
?>

<?php if (isset($connection)) { mysqli_close($connection); } ?>