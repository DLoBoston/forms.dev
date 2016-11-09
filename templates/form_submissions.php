
<?php include 'partials/html_header.php'; ?>

<body class="form_submissions">
  
	<?php include 'partials/header.php'; ?>
	
	<h3><?= $form->name; ?></h3>
	
	<table>
		<tr>
			<th>Submission ID</th>
			<th>Created</th>
			<th>Updated</th>
		</tr>
		<?php
			foreach ($submissions as $submission) :
				echo '<tr>';
					echo "<td><a href=\"/display/{$form->form_id}?submission_id={$submission->submission_id}\">Edit {$submission->submission_id}</a></td>";
					echo "<td>{$submission->created_at}</td>";
					echo "<td>{$submission->updated_at}</td>";
				echo '</tr>';
			endforeach;
		?>
	</table>

<?php include 'partials/html_footer.php';
