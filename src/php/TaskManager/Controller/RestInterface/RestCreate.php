<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */

namespace TaskManager\Controller\RestInterface;


interface RestCreate
{
	/**
	 * @param \stdClass $dto
	 * @param array $errors
	 * @param $valid
	 */
	public function create(\stdClass $dto, array &$errors = array(), &$valid);
} 