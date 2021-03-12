<?php


require_once(__DIR__ . "/../framework/boot.php");

use core\Application;
use core\Router;

if(!isset($_SESSION)){
	session_start();
}


/**
 * Initialize an app's path.
 */
$appInstance = Application::getInstance();
$appInstance->setAppRootPath(dirname(__DIR__));
$appInstance->setModulePath(__DIR__ . '/modules');


//Perform routing
$router = new Router();
Application::getInstance()->setRouter($router->route());
