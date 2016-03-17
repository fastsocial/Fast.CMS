<?php
use Phalcon\Mvc\View;

class AdminController extends \Phalcon\Mvc\Controller
{
	
	private $admin_data;
	
	public function initialize() {
		$this->view->setRenderLevel(View::LEVEL_LAYOUT);
		
		$this->admin_data = array(
			"paths" => array(
				"modules" => dirname(__FILE__)."/../../admin/modules" 
			),
			"modules" => array()
		);
		if ($modules = opendir($this->admin_data["paths"]["modules"])) {
			while (false !== ($item = readdir($modules))) {
				if ($item != "." && $item != "..") {
					$xml = simplexml_load_file($this->admin_data["paths"]["modules"]."/".$item);
					$name = $xml->name;
					$module = new Module($name);
					$this->admin_data["modules"][] = $module;
				}
			}
			closedir($modules);
		}
		
		$this->view->setVar("admin_data", $this->admin_data);
		

		if (!isset($_SESSION["admin_user"])) {
			// Перенаправление на другое действие
			$this->dispatcher->forward(array(
				"controller" => "admin",
				"action" => "login"
			));
		}
	}
	
	public function loginAction() {
		if (isset($_POST["submit"])) {
			if ($_POST["login"] == "adminich" && $_POST["pass"] == "serviskm451451451") {
				$_SESSION["admin_user"] = true;
				$this->dispatcher->forward(array(
					"controller" => "admin",
					"action" => "index"
				));
			} else {
				$this->view->setVar("admin_error", true);
			}
		}
	}
	
	public function indexAction() {
		
	}
	
	public function moduleAction($moduleName) {
		$this->view->setRenderLevel(View::LEVEL_LAYOUT);
		var_dump($moduleName);
		//echo $this->view->getVar("moduleName");
	}
}
