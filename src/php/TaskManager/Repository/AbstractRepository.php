<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:32
 * Data Access Layer Patern
 */

namespace TaskManager\Repository;


use TaskManager\Environment;
use TaskManager\Model\AbstractModel;
use TaskManager\Repository\FileRepository\FileRepository;
use TaskManager\Repository\DatabaseRepository\DatabaseRepository;

abstract class AbstractRepository
{
	private $model;

	private $repositoryType;
	private $repository;

	public function __construct($model)
	{
		$this->model = $model;

		$this->repositoryType = Environment::getRepositoryType();

		if ($this->repositoryType == RepositoryTypeEnum::SQL) {
			$this->repository = new DatabaseRepository($this->model);

		} else if ($this->repositoryType == RepositoryTypeEnum::FILE) {
			$this->repository = new FileRepository($this->model);
		}
	}
}