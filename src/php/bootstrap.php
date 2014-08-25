<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 13:48
 */


error_reporting(E_ALL);
ini_set('display_errors', true);
mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Prague');


spl_autoload_register(function ($className) {
	$filename = __DIR__ . '/' . str_replace('\\', '/', $className) . ".php";
	if (file_exists($filename)) {
		include($filename);
		if (class_exists($className)) {
			return TRUE;
		}
	}
	return FALSE;
});

require_once __DIR__ . '/../../vendor/autoload.php';

\TaskManager\Environment::setAppDir(__DIR__ . '/../../');
\TaskManager\Environment::setConfig(__DIR__ . '/config.ini');

$router = new \TaskManager\Router();
$router->findRoute();
