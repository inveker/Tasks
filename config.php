<?php

define('DEFAULT_CONTROLLER', 'MainController');
define('DEFAULT_ACTION', 'previewAction');

define('PATH', array(
                    'TEMPLATES' => 'templates/',
                    'CORE' => 'core/',
                    'MODELS' => 'models/',
                    'CONTROLLERS' => 'controllers/',
                    'VIEWS' => 'views/',
                ));

define('DB', array(
                    'type' => 'mysql',
                    'user' => 'root',
                    'pass' => 'get5',
                    'host' => 'localhost',
                    'dbname' => 'task',
                    'charset' => 'utf8',
                ));