<?php

namespace Nmw;

class Kernel 
{
	private $request;
	private $response;
	private $config;

	function __construct($config = [])
	{
		$this->request = new Request();
		$this->response = new Response();
		$this->config = $config;
	}

	public function request()
	{
		return $this->request;
	}

	public function response()
	{
		return $this->response;
	}

	public function config($key)
	{
		return $this->config[$key];
	}

	public function run()
	{
		$router = new Router($this);

		$router->match();

		$router->dispatch();	
	}

}
