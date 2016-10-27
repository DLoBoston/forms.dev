
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
	
	<form id="frmBuilder" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		<input type="text" name="name" value="<?= $form_data['name']; ?>">
		<button type="submit"><?php echo ($form_data['form_id']) ? 'Update' : 'Create'; ?></button>
		<button id="btnDelete" type="button">Delete</button>
	</form>
	
	<?php $page_scripts[] = '<script src="/scripts/form_builder.js"></script>'; ?>

<?php include 'partials/html_footer.php';
