<?php


$app = require __DIR__.'/bootstrap.php';
$app['debug'] = true;


$app->get('/', function () use ($app) {
 	return $app->sendFile(dirname(__DIR__).'/index.html');
 });




$app['monolog']->addInfo("server loaded");

$app->run();