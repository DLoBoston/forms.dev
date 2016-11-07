<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author dennis <dennis@ifscore.com>
 */

$app->get('/', '\IFS\Controllers\FormsSiteController:showHome');

$app->get('/builder[/{id}]', '\IFS\Controllers\FormsSiteController:showBuilder');
$app->post('/builder[/{id}]', '\IFS\Controllers\FormsSiteController:processBuilderSubmission');
$app->delete('/builder/{id}', '\IFS\Controllers\FormsSiteController:deleteForm');

$app->get('/display/{id}', '\IFS\Controllers\FormsSiteController:showForm');
$app->post('/display/{id}', '\IFS\Controllers\FormsSiteController:processFormSubmission');

$app->get('/submissions/{id}', '\IFS\Controllers\FormsSiteController:showSubmissions');
