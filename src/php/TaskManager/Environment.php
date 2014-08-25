<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:24
 */

namespace TaskManager;

/**
 * Class Environment
 * @package TaskManager
 */
/**
 * Class Environment
 * @package TaskManager
 */
class Environment
{
	/**
	 * @var string
	 */
	private static $appDir;

	/**
	 * @var string
	 */
	private static $config;

	/**
	 * @param $dir
	 */
	public static function setAppDir($dir)
	{
		self::$appDir = str_replace('\\', '/', $dir);
	}

	/**
	 * @param $config
	 */
	public static function setConfig($config)
	{
		self::$config = parse_ini_file($config, true);
	}

	/**
	 * @return string
	 */
	public static function getRepositoryType()
	{
		return self::$config['RepositoryType']['RepositoryType'];
	}

	/**
	 * @return string
	 */
	public static function getDatabaseStorage()
	{
		$db = self::$config['Repository']['Database'];
		$db = str_replace('%dir%', self::$appDir, $db);
		return $db;
	}

	/**
	 * @return string
	 */
	public static function getFileStorageLocation()
	{
		return self::$config['Repository']['File'];
	}
}