<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */

namespace TaskManager\Controller\RestInterface;


interface RestUpdate
{
	/**
	 * @param \stdClass $dto
	 * @param array $errors
	 * @param $valid
	 */
	public function update(\stdClass $dto, array &$errors = array(), &$valid);
} 