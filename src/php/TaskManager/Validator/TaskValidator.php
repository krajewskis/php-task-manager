<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:30
 */

namespace TaskManager\Validator;


use TaskManager\Model\AbstractModel;

class TaskValidator extends AbstractValidator
{
	/**
	 * @param AbstractModel $entity
	 * @param array $errors
	 * @return bool
	 */
	public function validate(AbstractModel $entity, array &$errors)
	{
		$this->rejectIfTitleIsEmpty($entity->title);

		return $this->getResult($errors);
	}

	/**
	 * @param $title
	 */
	private function rejectIfTitleIsEmpty($title)
	{
		if (empty($title)) {
			$this->rejectError('title', 'Cant be empty');
		}
	}
}