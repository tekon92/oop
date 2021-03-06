<?php 
	class model{
		private $loaded = array();
		private function __get($model){
			$model .= "model";
			$modelfile = "app/models/{$model}.php";
			$config = loader::load("config");

			if (file_exists($modelfile)) {
				include_once($modelfile);
				if (empty($this->loaded[$model])) {	
					$this->loaded[$model] = new $model;
				}
				$modelobj = $this->loaded[$model];
				if ($config->auto_model_association) {
					$this->associate($modelobj, $_REQUEST);
				}
				return $modelobj;
			}else{
				throw new Exception("Model {$model} is not found");
			}
		}

		private function associate(&$obj, $array){
			foreach ($array as $key => $value) {
				if (property_exists($obj, $key)) {
					$obj->$key = $value;
				}
			}
		}
	}
 ?>