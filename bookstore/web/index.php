<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';

//from skeleton
require __DIR__.'/../config/dev.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../config/routes.php';
require __DIR__.'/../src/controllers.php';



$app->run();
