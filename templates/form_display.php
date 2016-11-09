
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form id="frm_<?= $form->form_id; ?>" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		
		<input type="hidden" name="submission_id" value="<?= (!empty($submission)) ? $submission->submission_id : null; ?>">
		
		<?php
			
			foreach ($form->form_elements as $form_element) :
				
				// Create HTML object representation of form element
				$html_element = \IFS\Models\HtmlElementFactory::create($form_element);
				
				// Output display
				echo '<div class="form-group">';
					echo $html_element->getHtml($keyed_submission_values[$form_element->form_element_id]->value);
				echo '</div>';
				
			endforeach;
		?>
			
		<div class="form-group">
			<button type="submit">Submit</button>
		</div>
		
	</form>

<?php include 'partials/html_footer.php';
