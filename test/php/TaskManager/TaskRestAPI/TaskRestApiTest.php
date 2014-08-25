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
		$this->curl->doGetId(1);
	}

	public function testReadList()
	{
		$this->curl->doGet();
		$message = $this->curl->getResultMessage();
		$this->assertEquals('OK', $message);

		$list = $this->curl->getResultData();
		$this->assertTrue(count($list) > 0);
		$task = current($list);
		$this->assertTrue($task->id >= 1);
		$this->assertFalse(empty($task->title));
	}

	public function testCRUD()
	{
		$this->markTestSkipped('not finish');
	}

	public function testValidator()
	{
		$this->markTestSkipped('not finish');
	}
} 