<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once '../bootstrap.php';

echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Init Core Library
$init = new Core();