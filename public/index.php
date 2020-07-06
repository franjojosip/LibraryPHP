<?php

error_reporting(-1);
ini_set('display_errors', 'On');
echo realpath(__DIR__ ."..\\..");
require_once(realpath(__DIR__ ."..\\..")."/app/bootstrap.php");

// Init Core Library
$init = new Core();