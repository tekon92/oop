<?php 
	class router{
		private $route;
		private $controller;
		private $action;
		private $params;

		public function __construct(){
			if (file_exists("app/config/routes.php")) {	
				require_once("app/config/routes.php");
			}
			$path = array_keys($_GET);
			$config = loader::load("config");
			if (!isset($path[0])) {
				$default_controller = $config->default_controller;
				if (!empty($default_controller)) {
					$path[0] = $default_controller;
				}else{
					$path[0] = "index";
				}
			}

			$route = $path[0];
			$sanitizing_pattern = $config->allowed_url_chars;
			$route = preg_replace($sanitizing_pattern, "", $route);
			$route = str_replace("^", "", $route);
			$this->route = $route;
			$routeParts = split("/", $route);
			$this->controller = $routeParts[0];
			$this->action = isset($routeParts[1])? $routeParts[1]:"base";
			array_shift($routeParts);
			array_shift($routeParts);
			$this->params = $routeParts;

			/*match user define routing patter*/

			if (isset($routes)) {
				foreach ($routes as $_route) {
					$_pattern = "~{$_route[0]}~";
					$_destination = $_route[1];
					if (preg_match($_pattern, $route)) {
						$newrouteparts = split("/", $_destination);
						$this->controller = $newrouteparts[0];
						$this->action = $newrouteparts[1];
					}
				}
			}
		}
		public function getAction(){
			if (empty($this->action)) $this->action = "main";
				return $this->action;
		}

		public function getController(){
			return $this->controller;
		}

		public function getParams(){
			return $this->params;
		}

	}
 ?>