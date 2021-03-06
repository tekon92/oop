<?php 
	/******************
	*
	*Javascript Manager
	*
	*******************/

	class jsm{
		function loadPrototype(){
			$base = base::baseUrl();
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js=prototypec.js'>\n";
		}

		function loadScriptaculous(){
			$base = base::baseUrl();
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js=scriptpaculousc.js'>\n";	
		}

		function loadProtaculous(){
			$base = base::baseUrl();
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js=prototypec.js'>\n";
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js=scriptpaculousc.js'>\n";		
		}

		function loadJquery(){
			$base = base::baseUrl();
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js=jqueryc.js'>\n";
		}

	/******************
	*
	* app spesific libraries
	* @param string $filename
	*******************/
		function loadScript($filename){
			$base = base::baseUrl();
			$script = $base."/app/js/{$filename}.js";
			echo "<script type='text/javascript' src='{$base}/core/js/gzip.php?js={$script}'>\n";
		}

	}
 ?>