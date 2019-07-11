<?php

namespace Nmw;

class Router
{
	private $bind = [];
	private $template = null;
	private $namespace = 'App\Controllers\\';
	private $controller = null;
	private $action = 404;
	private $request;
	private $response;

	function __construct($kernel)
	{	
		if (!is_null($kernel->config('route'))) {
			$this->bind = $kernel->config('route');	
		}
		if (!is_null($kernel->config('template'))) {
			$this->template = $kernel->config('template');
		}
		$this->request = $kernel->request();	
		$this->response= $kernel->response();
	}

	public function match()
	{
		$method = strtoupper($this->request->getMethod());
		$uri	= $this->request->getUri();

		foreach ($this->bind as $route) {
			if ($method === strtoupper($route[0]) && $uri === $route[1]) {
				$this->controller = $this->namespace . explode('@', $route[2])[0];
				$this->action	  = explode('@', $route[2])[1];
 				return;
			}
		}

		if (substr_count($uri, '/') < 3) {
			$this->response->error(404);
		}	

		$uri = substr($uri, 1, strlen($uri) - 1);
		$uri = explode('/', $uri);
		$this->controller = $this->namespace . ucfirst($uri[0]). '\\' . ucfirst($uri[1]) . 'Controller';
		$this->action	  = strtolower($uri[2]);		
	}
	
	public function dispatch()
	{
		if (class_exists($this->controller) && method_exists($this->controller, $this->action)) {
			$controller = new $this->controller();
			$action = $this->action;
			$this->response->template = $this->template;
			$this->response->send($controller->$action());
		} else {
			$this->response->error('404');
		}
	}
}
