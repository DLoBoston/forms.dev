<?php
/**
 * Settings unique to the environment (i.e. development, production).
 * @todo Find a way to store these settings dynamically and configured based on automation
 * @author dennis <dennis@ifscore.com>
 */

 return $settings = [
    'displayErrorDetails' => true,
    'db' => [ // For PDO connection
        'host' => 'localhost',
        'dbname' => 'forms',
        'user' => 'forms',
        'pass' => 'smrof'
        ],
    'orm' => [ // For Eloquent ORM
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'forms',
        'username' => 'forms',
        'password' => 'smrof',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        ]
    ];
