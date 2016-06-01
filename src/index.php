<?php

require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

$router = new UserApi\Util\Router();
$router->process();