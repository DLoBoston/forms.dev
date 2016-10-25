<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

$app->get('/', function ($request, $response) {
	
	$this->get('orm');
	
	$forms = \IFS\Models\AccountForm::find(1);
	
	echo $forms->name;
exit('debug');
			
	$response = $this->view->render($response, "index.php", ['forms' => $forms]);
	return $response;
});
