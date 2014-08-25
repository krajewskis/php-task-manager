<?php

/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:16
 */
use TaskManager\Repository\TaskRepository;
use TaskManager\Model\Task;

class TaskRepositoryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var TaskRepository
	 */
	private $repository;

	public function setUp()
	{
		$this->repository = new TaskRepository();
	}

	public function testReadList()
	{
		$list = $this->repository->readList();
		$this->assertTrue(count($list) > 0);
		$task = current($list);
		$this->assertInstanceOf(get_class(new Task()), $task);
		$this->assertTrue($task->id >= 1);
		$this->assertFalse(empty($task->title));
	}

	public function testCRUD()
	{
		$task = new Task();
		$task->title = 'TEST';

		//create
		$this->repository->save($task);
		$this->assertInstanceOf(get_class(new Task()), $task);
		$this->assertTrue($task->id > 1);
		$this->assertEquals('TEST', $task->title);

		//read
		$task = $this->repository->read($task->id);
		$this->assertInstanceOf(get_class(new Task()), $task);
		$this->assertTrue($task->id > 1);
		$this->assertEquals('TEST', $task->title);

		//update
		$task->title = 'UPDATED';
		$this->repository->save($task);
		$this->assertEquals('UPDATED', $task->title);

		//delete
		$this->repository->delete($task->id);
		$task = $this->repository->read($task->id);
		$this->assertInstanceOf(get_class(new Task()), $task);
		$this->assertNull($task->id);
	}
} 