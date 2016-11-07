
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3><?= $form->name; ?></h3>
	
	<form id="frm<?= $form->form_id; ?>" action="<?= htmlspecialchars($route, ENT_QUOTES, "utf-8"); ?>" method="post">
		
		<?php
			foreach ($form->form_elements as $element) :
				$tmpElement = \IFS\Models\FormElement::makeElement($element->type);
				echo '<div class="form-group">';
					echo $tmpElement->getHtml($element);
				echo '</div>';
			endforeach;
		?>
			
		<div class="form-group">
			<button type="submit">Submit</button>
		</div>
		
	</form>

<?php include 'partials/html_footer.php';
