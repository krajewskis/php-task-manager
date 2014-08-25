<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:39
 */

namespace TaskManager\Validator;


use TaskManager\Model\AbstractModel;

abstract class AbstractValidator
{
	/**
	 * @var bool
	 */
	protected $valid = true;

	/**
	 * @var array
	 */
	protected $errors = array();

	/**
	 * @param AbstractModel $entity
	 * @param array $errors
	 * @return bool
	 */
	abstract public function validate(AbstractModel $entity, array &$errors);

	/**
	 * @param $field
	 * @param $messageError
	 * @param null $object
	 */
	final protected function rejectError($field, $messageError, $object = null)
	{
		$this->valid = false;

		$error = new \stdClass();
		$error->field = $field;
		$error->error = $messageError;
		$error->object = $object;

		$this->errors[] = $error;
	}

	/**
	 * @param array $errors
	 * @return bool
	 */
	final protected function getResult(array &$errors)
	{
		$errors = $this->errors;
		return $this->valid;
	}
} 