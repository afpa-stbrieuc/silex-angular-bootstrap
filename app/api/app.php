<?php


$app = require __DIR__.'/bootstrap.php';

$app['monolog']->addInfo("server loaded");

$app->run();