<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:20
 */

namespace TaskManager\Model;


/**
 * Class Task
 * @package TaskManager\Model
 */
class Task extends AbstractModel
{
	/**
	 * @var int
	 */
	public $id;
	/**
	 * @var string
	 */
	public $title;
}