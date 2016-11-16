<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author dennis <dennis@ifscore.com>
 */

$app->get('/', '\IFS\Controllers\FormsSiteController:showHome');

$app->get('/builder[/{id}]', '\IFS\Controllers\FormBuilderController:showBuilder');
$app->post('/builder[/{id}]', '\IFS\Controllers\FormBuilderController:processBuilderSubmission');
$app->delete('/builder/{id}', '\IFS\Controllers\FormBuilderController:deleteForm');

$app->get('/display/{id}', '\IFS\Controllers\FormDisplayController:showForm');
$app->post('/display/{id}', '\IFS\Controllers\FormDisplayController:processFormSubmission');

$app->get('/submissions/', '\IFS\Controllers\FormSubmissionsController:showSubmissions');

$app->group('/api/v1', function () {
	$this->get('/submissions/{id}', '\IFS\Controllers\ApiController:getSubmission');
});
