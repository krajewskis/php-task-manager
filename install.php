<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 15:24
 */

require_once __DIR__ . '/src/php/bootstrap.php';

$db = \TaskManager\Environment::getDatabaseStorage();
$pdo = new \PDO($db);
$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$sql = file_get_contents(__DIR__ . '/install/create_structure.sql');

foreach (explode(';', trim($sql)) as $query) {
	$pdo->exec(trim($query) . ';');
}