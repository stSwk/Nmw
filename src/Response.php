<?php
namespace Nmw;

class Response 
{
	public $template;	

	public function error($message)
	{
		header('HTTP/1.1 500 Internal Server Error');
		echo $message;
		exit;
	}

	public function send($message)
	{
		if (is_array($message)) {
			if (is_string($message[0]) && is_array($message[1])) {
				if (TEMPLATE) {
					$this->display($message[0], $message[1]);
				} else {
					echo '未开启模板模式';
				}
			} else {
				$this->json($message);
			}
		} else {
			echo $message;
		}
		exit;
	}	

	public function display($tpl, $data) 
	{
		\Smarty_Autoloader::register();

		$smarty = new \Smarty();

		$smarty->left_delimiter = "{{ "; 

		$smarty->right_delimiter = " }}";

		$smarty->setCacheDir($this->template['cache']);

		$smarty->setTemplateDir($this->template['directory']);

		$smarty->setConfigDir($this->template['config']);

		$smarty->setCompileDir($this->template['compile']);

		$smarty->caching = \Smarty::CACHING_LIFETIME_CURRENT;
		
		foreach ($data as $k => $v) {
			$smarty->assign($k, $v);
		}
			
		$smarty->display("$tpl.html");
	}

	private function json($data)
	{
		header('Content-Type:application/json; charset=utf-8');
		echo json_encode($data);
		exit;	
	}
}
