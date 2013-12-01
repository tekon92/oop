<?php 
	class view{
		private $vars = array();
		private $template;

		public function set($key, $value){
			$this->vars[$key] = $value;
		}

		public function getVars(&$controller = null){
			if (empty($this->template)) return $controller;
			return $this->template;
		}

		public function __get($var){
			return loader::load($var);
		}
	}
 ?>