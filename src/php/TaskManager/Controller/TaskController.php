<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */

namespace TaskManager\Controller;

use TaskManager\Controller\RestInterface\RestCreate;
use TaskManager\Controller\RestInterface\RestDelete;
use TaskManager\Controller\RestInterface\RestUpdate;
use TaskManager\Model\Task;
use TaskManager\Repository\TaskRepository;
use TaskManager\Validator\TaskValidator;


/**
 * Class TaskController
 * @package TaskManager\Controller
 */
class TaskController extends AbstractController implements RestCreate, RestUpdate, RestDelete
{
	/**
	 * @var TaskValidator
	 */
	private $validator;

	public function __construct()
	{
		parent::__construct(new TaskRepository());
		$this->validator = new TaskValidator();
	}

	/**
	 * @param \stdClass $dto
	 * @param array $errors
	 * @param $valid
	 */
	public function create(\stdClass $dto, array &$errors = array(), &$valid)
	{
		$entity = new Task();
		$entity->rewrite($dto);

		$valid = $this->validator->validate($entity, $errors);

		if ($valid) {
			$this->repository->save($entity);
			$entity->rewriteBack($dto);
		}
	}

	/**
	 * @param \stdClass $dto
	 * @param array $errors
	 * @param $valid
	 */
	public function update(\stdClass $dto, array &$errors = array(), &$valid)
	{
		$entity = $this->repository->read($dto->id);
		$entity->rewrite($dto);

		$valid = $this->validator->validate($entity, $errors);

		if ($valid) {
			$this->repository->save($entity);
			$entity->rewriteBack($dto);
		}
	}

	/**
	 * @param $id
	 */
	public function delete($id)
	{
		$this->repository->delete($id);
	}
}