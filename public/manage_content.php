<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation ($current_subject, $current_page); ?></br>
		<a href="new_subject.php">+ Add Subject</a>
	</div>
	<div id="page">
		<?php if ($current_subject) { ?>
			<h2>Manage Subject</h2>
			Menu Name: <?php echo $current_subject["menu_name"]; ?></br>
		<?php } elseif ($current_page) { ?>
			<h2>Manage Page</h2>
			Page Name: <?php echo $current_page["menu_name"]; ?></br>
		<?php } else { ?>
			<h2>Manage Content</h2>
			Please select a subject or a page.
		<?php } ?>
		
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>