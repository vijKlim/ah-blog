<?php

use App\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$response = $app->run();
$response->send();