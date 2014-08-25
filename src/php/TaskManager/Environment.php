<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:24
 */

namespace TaskManager;


class Environment
{
	private static $appDir;
	private static $config;

	public static function setAppDir($dir)
	{
		self::$appDir = str_replace('\\', '/', $dir);
	}

	public static function setConfig($config)
	{
		self::$config = parse_ini_file($config, true);
	}

	public static function getRepositoryType()
	{
		return self::$config['RepositoryType'];
	}

	public static function getDatabaseStorage()
	{
		$db = self::$config['Repository']['Database'];
		$db = str_replace('%dir%', self::$appDir, $db);
		return $db;
	}

	public static function getFileStorageLocation()
	{
		return self::$config['Repository']['File'];
	}
}