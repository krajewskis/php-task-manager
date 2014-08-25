<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:43
 */

namespace TaskManager\Model;


abstract class AbstractModel
{
	public function getValues()
	{
		return get_object_vars($this);
	}
} 