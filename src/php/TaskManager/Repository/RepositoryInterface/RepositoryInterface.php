<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:27
 */

namespace TaskManager\Repository\RepositoryInterface;


use TaskManager\Model\AbstractModel;

interface RepositoryInterface
{
	public function __construct($model);

	public function readList();

	public function read($id);

	public function save(AbstractModel &$entity);

	public function delete($id);
} 