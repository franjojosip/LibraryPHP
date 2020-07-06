<?php

error_reporting(-1);
ini_set('display_errors', 'On');
echo $_SERVER['DOCUMENT_ROOT'];
require_once($_SERVER['DOCUMENT_ROOT']  .'/app/bootstrap.php');

// Init Core Library
$init = new Core();