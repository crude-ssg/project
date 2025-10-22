<?php

use CrudeSSG\Data;
use CrudeSSG\HttpHandler;
use CrudeSSG\Renderer;

chdir(__DIR__);
require_once(__DIR__ . "/vendor/autoload.php");
$router = require_once 'routes.php';

Data::useDirectory("data");
$renderer = new Renderer('templates');

$httphandler = new HttpHandler(
    $renderer,
    $router
);
$httphandler->handle();