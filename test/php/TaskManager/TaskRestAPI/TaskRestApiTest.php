<?php

/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 18:15
 */

use \TaskManager\CURL;

class TaskRestApiTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var CURL;
	 */
	private $curl;

	protected function setUp()
	{
		$this->curl = new CURL('http://task-manager.localhost/rest/task');
	}

	public function testListAll()
	{
		$this->curl->doGet();
		print_r($this->curl->getOriginalResult());
	}
} 