<?php 
	class library{
		private $loaded = array();
		private function __get($lib){
			if (empty($this->loaded[$lib])) {
				$libnamecore = "core/libraries/{$lib}.php";
				$libnameapp = "app/libraries/{$lib}.php}";
				if (file_exists($libnamecore)) {
					require_once($libnamecore);
					$this->loaded[$lib] = new $lib;
				}else if(file_exists($libnameapp)){
					require_once($libnameapp);
					$this->loaded[$lib] = new $lib();
				}else{
					throw new Exception("Library {$lib} not found.");
				}
			}
			return $this->loaded[$lib];
		}
	}
 ?>