<?php

namespace Nmw;

class Request 
{
	private $uri;
	private $method;
	private $post;
	private $get;

	function __construct()
	{
		$this->uri		= $_SERVER['REQUEST_URI'];
		$this->method	= $_SERVER['REQUEST_METHOD']; 
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function getMethod()
	{
		return $this->method;
	}

}
