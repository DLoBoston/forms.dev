
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
	
	<form id="frmBuilder" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		
		<div class="form-group">
			<input type="text" name="name" value="<?= $form['name']; ?>">
		</div>
		
		<?php
			if ($form['elements']) :
				foreach ($form['elements'] as $element) :
					echo '<div class="form-group">';
					echo $element->label . ' ' . $element->type;
					echo ' | <a data-element-id="' . $element->form_element_id . '" data-element-action="delete">delete</a>';
					echo '</div>';
				endforeach;
			endif;
		?>
			
		<div class="form-group">
			<button type="submit"><?php echo ($form['form_id']) ? 'Update' : 'Create'; ?></button>
		</div>
			
		<div class="form-group">
			<button id="btnDelete" type="button">Delete</button>
		</div>
		
	</form>
	
	<?php $page_scripts[] = '<script src="/scripts/form_builder.js"></script>'; ?>

<?php include 'partials/html_footer.php';
