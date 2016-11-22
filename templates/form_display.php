
<?php include 'partials/html_header.php'; ?>

<body class="form_display">
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form id="frm_id_<?= $form->id; ?>" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		
		<input type="hidden" name="submission_id" value="<?= (!empty($submission)) ? $submission->id : null; ?>">
		
		<?php
		
			// Create form sections
			foreach ($form->form_sections as $form_section) :
				
				echo "<fieldset>"
				.				"<legend>{$form_section->name}</legend>";
			
				// Create form fields
				foreach ($form_section->form_fields as $form_field) :

					// Create HTML object representation of form field
					$decorated_form_field = \IFS\Models\FormFieldDecoratorFactory::create($form_field);

					// Initialize form field value
					$value = $form_field->default_value;

					// If applicable, overwrite with previous submission
					if ($keyed_submission_values) :
						$value = ($keyed_submission_values->has($form_field->id)) ? json_decode($keyed_submission_values[$form_field->id]->value, true) : null;
					endif;

					// Output display
					echo '<div' 
							.	' class="form-group"'
							. ' data-required="' . $form_field->required . '">';
						echo $decorated_form_field->getHtml($value);
						echo "<p class=\"guidelines\">{$form_field->guidelines}</p>";
					echo '</div>';
				
				endforeach;
				
				echo '</fieldset>';
				
			endforeach;
		?>
			
		<div class="form-group">
			<button type="submit">Submit</button>
		</div>
		
	</form>
	
	<?php $page_scripts[] = '<script src="/scripts/form_display_v1.js"></script>'; ?>

<?php include 'partials/html_footer.php';
