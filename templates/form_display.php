
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form>
		
		<?php
			foreach ($form->form_elements as $element) :
				$tmpElement = \IFS\Models\FormElement::makeElement($element->type);
				echo '<div class="form-group">';
					echo $tmpElement->getHtml($element);
				echo '</div>';
			endforeach;
		?>
		
	</form>

<?php include 'partials/html_footer.php';
