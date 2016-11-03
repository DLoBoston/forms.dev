
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
	
	<form id="frmBuilder" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		<input type="hidden" name="form_elements" name="form_elements">
		
		<div class="form-group">
			<input type="text" name="name" value="<?= $form['name']; ?>">
		</div>
		
		<div id="form-elements"></div>
			
		<div class="form-group">
			<button type="submit"><?php echo ($form['form_id']) ? 'Update' : 'Create'; ?></button>
		</div>
			
		<div class="form-group">
			<button id="btnDelete" type="button">Delete</button>
		</div>
		
	</form>
	
	<!-- Add Element Toolbox -->
	<aside id="element-toolbox">
		<p>Add Element</p>
			<?php
				foreach ($global_vars['form_element_types'] as $element_type) :
					echo '<button type="button" data-form-element-type="' . $element_type . '">' . $element_type . '</button>';
				endforeach;
			?>
	</aside>
  
  <!-- Pass through current form data to javascript -->
  <script>
    var passthrough_form_data = <?php echo json_encode($form); ?>;
  </script>
	
	<?php $page_scripts[] = '<script src="/scripts/form_builder.js"></script>'; ?>

<?php include 'partials/html_footer.php';
