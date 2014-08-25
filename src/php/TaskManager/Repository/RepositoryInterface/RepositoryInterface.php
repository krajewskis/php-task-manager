<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:27
 */

namespace TaskManager\Repository\RepositoryInterface;


use TaskManager\Model\AbstractModel;

/**
 * Interface RepositoryInterface
 * @package TaskManager\Repository\RepositoryInterface
 */
interface RepositoryInterface
{
	/**
	 * @param $model
	 */
	public function __construct($model);

	/**
	 * @return AbstractModel[]
	 */
	public function readList();

	/**
	 * @param $id
	 * @return AbstractModel
	 */
	public function read($id);

	/**
	 * @param AbstractModel $entity
	 * @return bool
	 */
	public function save(AbstractModel &$entity);

	/**
	 * @param $id
	 * @return bool
	 */
	public function delete($id);
} 