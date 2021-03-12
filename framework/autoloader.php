<?php

use core\Application;


/**
 * @param string $str
 * @return string
 */
function replaceSlashes(string $str): string {
	return $file = str_replace("\\", "/", $str);
}

/**
 * @param string $className
 */
function autoload(string $className): void {

	$file = replaceSlashes(__DIR__ . '/' . $className . '.php');

	if(file_exists($file)) {
		require_once($file);
	}

	return;
}

/**
 * @param string $className
 */
function autoloadModules(string $className): void {

	$file = replaceSlashes(Application::getInstance()->getAppRootPath() . '/' . $className . '.php');

	if(file_exists($file)) {
		require_once($file);
	}
}


spl_autoload_register('autoload');
spl_autoload_register('autoloadModules');