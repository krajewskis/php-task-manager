<?php
/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 25.8.14
 * Time: 17:25
 */

namespace TaskManager;


use TaskManager\Controller\AbstractController;

class Router
{
	/**
	 * @var GET | POST | PUT | DELETE
	 */
	private $requestMethod;

	/**
	 * @var string
	 */
	private $controller;

	/**
	 * @var int | null
	 */
	private $id;

	/**
	 * @var string
	 */
	private $controllerClassName;

	/**
	 * @var string JSON Format
	 */
	private $phpInput;

	/**
	 * @var \stdClass Encoded JSON
	 */
	private $data;

	/**
	 * @var AbstractController
	 */
	private $controllerInstance;

	/**
	 * @var JsonResponse
	 */
	private $jsonResponse;

	/**
	 * @var array
	 */
	private $errors = array();

	/**
	 * @var bool
	 */
	private $valid = true;

	public function __construct()
	{
		$this->receiveMethod();
		$this->receiveParameters();
		$this->receiveData();

		$this->jsonResponse = new JsonResponse();
	}

	public function findRoute()
	{
		try {

			$this->checkControllerClassExists();

			$this->controllerInstance = new $this->controllerClassName();

			if ($this->isItListRequest()) {
				$this->processListRequest();

			} else if ($this->isItReadRequest()) {
				$this->processReadRequest();

			} else if ($this->isItCreateRequest()) {
				$this->processCreateRequest();

			} else if ($this->isItUpdateRequest()) {
				$this->processUpdateRequest();

			} else if ($this->isItDeleteRequest()) {
				$this->processDeleteRequest();

			} else {
				$this->throwNotFound();
			}

			if (!$this->valid) {
				$this->throwBadRequest();
			}

			$this->jsonResponse->setResponse($this->data);

		} catch (\Exception $e) {
			$this->serveException($e);
		}

		print $this->jsonResponse;
		exit;
	}

	private function receiveMethod()
	{
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
	}

	private function receiveParameters()
	{
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		$this->controller = ucfirst($uri[2]);
		$this->id = isset($uri[3]) ? $uri[3] : null;

		$this->controllerClassName = 'TaskManager\\Controller\\' . $this->controller . 'Controller';
	}

	private function receiveData()
	{
		$this->phpInput = file_get_contents('php://input');

		if ($this->phpInput) {
			$this->data = json_decode($this->phpInput);
		} else {
			$this->data = new \stdClass();
		}
	}

	private function checkControllerClassExists()
	{
		if (!class_exists($this->controllerClassName)) {
			throw new \Exception('CONTROLLER_NOT_FOUND');
		}
	}

	private function checkControllerMethodExists($method)
	{
		if (!method_exists($this->controllerClassName, $method)) {
			throw new \Exception('CONTROLLER_METHOD_NOT_FOUND');
		}
	}

	private function isItListRequest()
	{
		return $this->requestMethod == 'GET' && !$this->id;
	}

	private function isItReadRequest()
	{
		return $this->requestMethod == 'GET' && $this->id;
	}

	private function isItCreateRequest()
	{
		return $this->requestMethod == 'POST';
	}

	private function isItUpdateRequest()
	{
		return $this->requestMethod == 'PUT' && $this->id;
	}

	private function isItDeleteRequest()
	{
		return $this->requestMethod == 'DELETE' && $this->id;
	}

	private function processListRequest()
	{
		$this->checkControllerMethodExists('readList');
		$this->data = $this->controllerInstance->readList();
	}

	private function processReadRequest()
	{
		$this->checkControllerMethodExists('read');
		$this->data = $this->controllerInstance->read($this->id);
		if (!$this->data->id) {
			$this->throwNotFound($this->id);
		}
	}

	private function processCreateRequest()
	{
		$this->checkControllerMethodExists('create');
		$this->controllerInstance->create($this->data, $this->errors, $this->valid);
	}

	private function processUpdateRequest()
	{
		$this->checkControllerMethodExists('update');
		$this->controllerInstance->update($this->data, $this->errors, $this->valid);
	}

	private function processDeleteRequest()
	{
		$this->checkControllerMethodExists('delete');
		$this->controllerInstance->delete($this->id);
	}

	private function throwNotFound($id = null)
	{
		throw new \Exception('Not found ' . $id, 404);
	}

	private function throwBadRequest()
	{
		throw new \Exception('Bad request', 400);
	}

	private function serveException(\Exception $e)
	{
		$code = $e->getCode();
		header('HTTP/1.1 ' . $code);
		$this->jsonResponse->setError($e->getMessage(), $e->getCode(), $this->errors);
	}
}