<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 29.8.13
 * Time: 10:05
 * To change this template use File | Settings | File Templates.
 */

namespace TaskManager;

class CURL
{
	private $url;
	private $curl;
	private $data;

	private $result;
	private $info;

	public function __construct($url)
	{
		$this->url = $url;
	}

	public function doGet()
	{
		$this->init($this->url);
		$this->process();
	}

	public function doGetId($id)
	{
		$this->init($this->url . '/' . $id);
		$this->process();
		$this->close();
	}

	public function doPost($data)
	{
		$this->init($this->url);
		curl_setopt($this->curl, CURLOPT_POST, true);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
		$this->process();
		$this->close();
	}

	public function doPut($id, $data)
	{
		$this->init($this->url . '/' . $id);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
		$this->process();
		$this->close();
	}

	public function doDelete($id)
	{
		$this->init($this->url . '/' . $id);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$this->process();
		$this->close();
	}

	private function init($url)
	{
		$this->curl = curl_init($url);
	}

	private function process()
	{
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
		$this->result = curl_exec($this->curl);
		$this->info = curl_getinfo($this->curl);
	}

	public function close()
	{
		curl_close($this->curl);
	}

	public function getInfo()
	{
		return $this->info;
	}

	public function getOriginalResult()
	{
		return $this->result;
	}

	public function getResult()
	{
		return json_decode($this->result);
	}

	public function getResultSuccess()
	{
		return $this->getResult()->success;
	}

	public function getResultMessage()
	{
		return $this->getResult()->message;
	}

	public function getResultData()
	{
		return $this->getResult()->data;
	}

}