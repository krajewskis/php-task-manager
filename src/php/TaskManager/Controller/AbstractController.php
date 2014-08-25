<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:26
 */

namespace TaskManager\Controller;

use TaskManager\Controller\RestInterface\RestRead;
use TaskManager\Controller\RestInterface\RestReadList;
use TaskManager\Model\AbstractModel;
use TaskManager\Repository\AbstractRepository;


/**
 * Class AbstractController
 * @package TaskManager\Controller
 */
abstract class AbstractController implements RestRead, RestReadList
{
	/**
	 * @var AbstractRepository
	 */
	protected $repository;


	/**
	 * @param AbstractRepository $repo
	 */
	public function __construct(AbstractRepository $repo)
	{
		$this->repository = $repo;
	}

	/**
	 * @param $id
	 * @return AbstractModel
	 */
	public function read($id)
	{
		return $this->repository->read($id);
	}

	/**
	 * @return AbstractModel[]
	 */
	public function readList()
	{
		return $this->repository->readList();
	}

} 