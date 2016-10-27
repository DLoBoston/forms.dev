
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3>All Forms</h3>
	
	<p><a href="/builder">Add new form</a></p>
  
	<ul>
		<?php
			foreach ($all_forms as $form) :
				echo '<li><a href="/builder/' . $form->form_id . '">' . $form->name . '</a></li>';
			endforeach;
		?>
	</ul>

<?php include 'partials/html_footer.php';
