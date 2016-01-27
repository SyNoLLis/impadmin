<?php

require __DIR__ . '/source/Jacwright/RestServer/RestServer.php';
require 'ImperialController.php';

$server = new \Jacwright\RestServer\RestServer('debug');
$server->addClass('ImperialController');
$server->handle();
