
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form>
		
		<?php
			foreach ($form->form_elements as $element) :
				echo '<div class="form-group">';
					echo '<div data-form-element-id="' . $element->form_element_id . '"'
									. 'data-form-element-type="' . $element->type . '"'
									. 'data-form-element-label="' . $element->label . '"'
									. '>';
						echo $element->label . ' ' . $element->type;
						echo ' | <a data-form-element-action="delete">delete</a>';
					echo '</div>';
				echo '</div>';
			endforeach;
		?>
		
	</form>

<?php include 'partials/html_footer.php';
