<?php

session_start();


define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("LAYOUT_PATH", PRIVATE_PATH . "/layout");
define("PUBLIC_PATH", PROJECT_PATH . "/public");

require_once('database_funcs.php');
require_once('function.php');
require_once('query_functions.php');
require_once('validation_funcs.php');
$db = db_connect();
$errors = [];

?>