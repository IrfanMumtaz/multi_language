<?php


	
	require_once('english/index.php');

	$trans = $lang;
	
	function translate($array, $language = 'en'){
		global $trans;
		$result =  array_key_exists($language, $trans[$array]) ? $trans[$array][$language] : $trans[$array]['en'];
		echo $result;
		
	}

//	echo '<pre>';
//	print_r($lang);
//	echo '</pre>';

?>