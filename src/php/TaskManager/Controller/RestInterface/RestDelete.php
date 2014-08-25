<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:23
 */

namespace TaskManager\Controller\RestInterface;


interface RestDelete
{
	/**
	 * @param $id
	 */
	public function delete($id);
} 