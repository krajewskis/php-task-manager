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
} 