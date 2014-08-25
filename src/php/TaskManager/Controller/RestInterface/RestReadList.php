<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */
namespace TaskManager\Controller\RestInterface;


use TaskManager\Model\AbstractModel;

interface RestReadList
{
	/**
	 * @return AbstractModel[]
	 */
	public function readList();
} 