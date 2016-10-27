<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author dennis <dennis@ifscore.com>
 */

$app->get('/', '\IFS\Controllers\FormsSiteController:showHome');

$app->get('/builder', '\IFS\Controllers\FormsSiteController:showBuilder');