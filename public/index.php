<?php

// Set constants
require '../src/globals.php';

// Autoloaders
require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require '../src/' . str_replace('\\', '/', $classname) . '.php';
});

// Application settings
$settings = require '../src/settings.php';

// Create app
$app = new \Slim\App(["settings" => $settings]);

// Add dependecies
require '../src/dependencies.php';

// Register middleware
require '../src/middleware.php';

// Register routes
require '../src/routes.php';

$app->run();