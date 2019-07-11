<?php

require __DIR__.'/../../vendor/autoload.php';

define('TEMPLATE', true);

define('ROOT_DIR', __DIR__);

$config = require_once __DIR__.'/../config/main.php';

$app = new Nmw\Kernel($config);

$app->run();
