<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:21
 */

namespace TaskManager\Repository;


use TaskManager\Enum\RepositoryTypeEnum;
use TaskManager\Model\AbstractModel;
use TaskManager\Model\Task;

/**
 * Class TaskRepository
 * @package TaskManager\Repository
 */
class TaskRepository extends AbstractRepository
{
	public function __construct()
	{
		parent::__construct(get_class(new Task()));
	}
}