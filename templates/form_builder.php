
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
	
	<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
		<input type="text" name="name" value="<?= $form_data['name']; ?>">
		<button type="submit"><?php echo ($form_data['form_id']) ? 'Update' : 'Create'; ?></button>
	</form>
	
</body>

<?php include 'partials/html_footer.php';
