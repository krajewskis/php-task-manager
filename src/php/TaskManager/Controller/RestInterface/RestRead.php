<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */

namespace TaskManager\Controller\RestInterface;


use TaskManager\Model\AbstractModel;

interface RestRead
{
	/**
	 * @param $id
	 * @return AbstractModel
	 */
	public function read($id);
} 