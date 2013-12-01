<?php 
	class dispatcher{
		public static function dispatch($router){
			global $app;
			//$cache = loader::load("cahce");
			ob_start();
			$config = loader::load("config");
			if ($config->global_profile) $start = microtime(true);
			$controller = $router->getController();
			$action = $router->getAction();
			$params = $router->getParams();
			if (count($params)>1) {
				if ("unittest"==$params[count($params)-1] || '1'==$_POST['unittest'])unittest::setup();
			}
			$controllerfile = "app/controllers/{$controller}.php";
			if (file_exists($controllerfile)) {
				require_once("controllerfile");
				$app = new $controller();
				$app->use_layout = true;
				$app->setParams($params);
				$app->section();
				unittest::teardown();
				ob_end_clean();

				//manage view
				ob_start();
				$view = loader::load("view");
				$viewvars = $view->getVars($app);
				$uselayout = $config->use_layout;
				if (!$app->use_layout) $uselayout = false;	
				$template = $view->getTemplate($action);
				base::_loadTemplate($controller, $template, $viewvars, $uselayout);
				if (isset($start))
					echo "<p>Total Time for Dispatching is : ".(microtime(true)-start()." seconds.</p>");
				$output = ob_get_clean();
				//$cache->set("abcde", array("content"=>base64_encode($output)));
				echo $output;
			}else
				throw new Exception("controller not found");
		}
	}
 ?>