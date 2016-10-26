<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

$app->get('/', function ($request, $response) {
	$response = $this->view->render($response, "forms_home.php", ['page_title' => 'Forms Home']);
	return $response;
});

$app->get('/builder', function ($request, $response) {
	$response = $this->view->render($response, "form_builder.php", ['page_title' => 'Form Builder']);
	return $response;
});
