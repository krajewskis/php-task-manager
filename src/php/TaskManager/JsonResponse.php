<?php

/**
 * Created by PhpStorm.
 * User: krajewski
 * Date: 8.11.13
 * Time: 10:28
 */

namespace TaskManager;

class JsonResponse
{
	public $success = true;
	public $statusCode = 200;
	public $message = 'OK';
	public $data;
	public $errors;

	public function setError($error, $statusCode, array $errors = array())
	{
		$this->success = false;
		$this->message = $error;
		$this->statusCode = $statusCode;
		$this->errors = $errors;
	}

	public function setResponse($data)
	{
		$this->success = true;
		$this->data = $data;
	}

	public function __toString()
	{
		return json_encode($this);
	}
}