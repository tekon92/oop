<?php 
	class loader{
		private static $loaded = array();

		public static function load($object){
			$valid = array(	"library",
							"view",
							"model",
							"helper",
							"router",
							"config",
							"hook",
							"cache",
							"db");
			if (!in_array($object, $valid)) {
				$config = self::load("config");
				if ("on" == $config->debug) {
					base::backtrace();
				}
				throw new Exception("Not a valid Object '{$object}' to load");
			}
			if (empty(self::$loaded[$object])) {
				self::$loaded[$object] = new $object();
			}
			return self::$loaded[$object];
		}
	}
 ?>