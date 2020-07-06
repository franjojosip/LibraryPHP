<?php
// Database Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library');
define('DB_CHARSET', 'utf8');

// App Root
define('APP_ROOT', dirname(dirname(__FILE__)));

// URL Root
define('URL_ROOT', "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
