
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form id="frm_<?= $form->form_id; ?>" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		
		<input type="hidden" name="submission_id" value="<?= (!empty($submission)) ? $submission->submission_id : null; ?>">
		
		<?php
			
			// Create form elements
			foreach ($form->form_elements as $form_element) :
				
				// Create HTML object representation of form element
				$html_element = \IFS\Models\HtmlElementFactory::create($form_element);
				
				// Initialize form element value
				$value = null;
				if ($keyed_submission_values) :
					$value = ($keyed_submission_values->has($form_element->form_element_id)) ? $keyed_submission_values[$form_element->form_element_id]->value : null;
				endif;
				
				// Output display
				echo '<div class="form-group">';
					echo $html_element->getHtml($value);
					echo "<p class=\"guidelines\">{$form_element->guidelines}</p>";
				echo '</div>';
				
			endforeach;
		?>
			
		<div class="form-group">
			<button type="submit">Submit</button>
		</div>
		
	</form>

<?php include 'partials/html_footer.php';
