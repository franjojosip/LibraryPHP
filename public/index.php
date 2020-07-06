<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once $_SERVER['DOCUMENT_ROOT'] .'/app/bootstrap.php';

// Init Core Library
$init = new Core();

echo("<script>console.log('Route: " . $_SERVER['DOCUMENT_ROOT'] . "');</script>");
