<?php 
	ob_start("ob_gzhandler");
	header("Content-type: text/javascript; charset: UTF-8");
	header("Cache-Control: must-revalidate");

	$offset = 60 * 60 * 24 * 3;
	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
	header($ExpStr);
	$js = $_GET['js'];
	if (in_array($js, array("prototypec.js","scriptaculousc.js","jqueryc.js")));
	include(urldecode($_GET['js']));
 ?>