<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
use Router\Router;
include_once "inc/init.inc.php";
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 $router = new Router();
 $router->run();
