
<?php include 'partials/html_header.php'; ?>

<body>
  
	<?php include 'partials/header.php'; ?>
  
	<h3>All Forms</h3>
	
	<p><a href="/builder">Add new form</a></p>
  
	<ul>
		<?php
			foreach ($all_forms as $form) :
				echo '<li>' . $form->name;
					echo '<ul>';
						echo '<li><a href="/builder/' . $form->id . '">Edit Form</a></li>';
						echo '<li><a href="/display/' . $form->id . '">Show Form</a></li>';
						echo '<li><a href="/submissions/?form_id=' . $form->id . '">Show Submissions</a></li>';
					echo '</ul>';
				echo '</li>';
			endforeach;
		?>
	</ul>

<?php include 'partials/html_footer.php';
