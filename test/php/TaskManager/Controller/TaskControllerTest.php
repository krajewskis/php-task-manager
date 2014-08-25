<?php

/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:46
 */
use \TaskManager\Controller\TaskController;

class TaskControllerTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var TaskController
	 */
	private $controller;

	public function setUp()
	{
		$this->controller = new TaskController();
	}

	public function testReadList()
	{
		$list = $this->controller->readList();
		$this->assertTrue(count($list) > 0);
		$task = current($list);
		$this->assertTrue($task->id >= 1);
		$this->assertFalse(empty($task->title));
	}

	public function testCRUD()
	{
		$errors = array();
		$task = new stdClass();
		$task->title = 'TEST';

		//create
		$this->controller->create($task, $errors, $valid);
		$this->assertTrue($task->id > 1);
		$this->assertEquals('TEST', $task->title);
		$this->assertTrue(empty($errors));
		$this->assertTrue($valid);

		//read
		$task = $this->controller->read($task->id);
		$this->assertTrue($task->id > 1);
		$this->assertEquals('TEST', $task->title);

		$task = new stdClass();
		$task->id = 1;
		$task->title = 'TEST';

		//update
		$task->title = 'UPDATED';
		$this->controller->update($task, $errors, $valid);
		$this->assertEquals('UPDATED', $task->title);
		$this->assertTrue(empty($errors));
		$this->assertTrue($valid);

		//delete
		$this->controller->delete($task->id);
		$task = $this->controller->read($task->id);
		$this->assertNull($task->id);
	}

	public function testValidator()
	{
		$errors = array();
		$task = new stdClass();
		$task->title = '';

		//create
		$this->controller->create($task, $errors, $valid);
		$this->assertFalse(empty($errors));
		$this->assertFalse($valid);
	}
} 