<?php

namespace App\Controllers\Index;

class DefaultController
{
	public function index()
	{
		$people = [];
		$people['sex'] = 18;
		$people['name'] = 'Nmw';
		return ['people' => $people];
	}

	public function test()
	{
		return ['index', ['message' => 'test']];
	}
}
