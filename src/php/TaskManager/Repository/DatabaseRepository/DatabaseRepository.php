<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 14:31
 */

namespace TaskManager\Repository\DatabaseRepository;


use TaskManager\Environment;
use TaskManager\Model\AbstractModel;
use TaskManager\Repository\RepositoryInterface\RepositoryInterface;

/**
 * Class DatabaseRepository
 * @package TaskManager\Repository\DatabaseRepository
 */
class DatabaseRepository implements RepositoryInterface
{
	/**
	 * @var string
	 */
	private $model;
	/**
	 * @var string
	 */
	private $table;
	/**
	 * @var string
	 */
	private $db;
	/**
	 * @var \PDO
	 */
	private $pdo;
	/**
	 * @var \FluentPDO
	 */
	private $fpdo;

	/**
	 * @param string $model
	 */
	public function __construct($model)
	{
		$this->model = $model;
		$this->table = explode('\\', $this->model);
		$this->table = strtolower(end($this->table));
		$this->db = Environment::getDatabaseStorage();
		$this->pdo = new \PDO($this->db);
		$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->fpdo = new \FluentPDO($this->pdo);
	}

	/**
	 * @return AbstractModel[]
	 */
	public function readList()
	{
		$query = $this->fpdo->from($this->table);
		$query->asObject($this->model);
		$list = $query->fetchAll();
		return $list;
	}

	/**
	 * @param $id
	 * @return AbstractModel
	 */
	public function read($id)
	{
		$query = $this->fpdo->from($this->table, $id);
		$query->asObject($this->model);
		$entity = $query->fetch();
		return $entity ? $entity : new $this->model;
	}

	/**
	 * @param AbstractModel $entity
	 * @return bool
	 */
	public function save(AbstractModel &$entity)
	{
		$values = $entity->getValues();
		unset($values['id']);

		if ($entity->id === NULL || $entity->id == 0) {
			$query = $this->fpdo->insertInto($this->table, $values);
			$res = $query->execute();
			$entity->id = $this->pdo->lastInsertId();

		} else {
			$query = $this->fpdo->update($this->table, $values, $entity->id);
			$res = $query->execute();
		}

		$query = $this->fpdo->from($this->table, $entity->id);

//		WARNING: FluentPDO does not support FETCH_INTO :(
//		$stmt->setFetchMode(PDO::FETCH_INTO, $entity);

		$values = $query->fetch();
		foreach ($values as $key => $val) {
			$entity->$key = $val;
		}

		return (bool)$res;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function delete($id)
	{
		$query = $this->fpdo->delete($this->table, $id);
		$res = $query->execute();
		return (bool)$res;
	}

}