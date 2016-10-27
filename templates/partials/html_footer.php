		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
		<!-- page specific scripts -->
		<?php
			if (!empty($page_scripts)) :
				foreach ($page_scripts as $script) :
					echo $script;
				endforeach;
			endif;
		?>
	</body>
</html>