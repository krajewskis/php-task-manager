<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:43
 */

namespace TaskManager\Model;


/**
 * Class AbstractModel
 * @package TaskManager\Model
 */
abstract class AbstractModel
{
	/**
	 * @return array
	 */
	public function getValues()
	{
		return get_object_vars($this);
	}

	/**
	 * @param \stdClass $object
	 */
	public function rewrite(\stdClass $object)
	{
		foreach (get_object_vars($this) as $property => $value) {
			$this->$property = $object->$property;
		}
	}

	/**
	 * @param \stdClass $object
	 */
	public function rewriteBack(\stdClass $object)
	{
		foreach (get_object_vars($this) as $property => $value) {
			$object->$property = $value;
		}
	}
} 