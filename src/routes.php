<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello ....");
});
