<?php 

	function aphs_intToBool($value) {
	    return empty($value) ? 'false' : 'true';
	}
	
	function aphs_isNullOrEmpty($v){
	    return (!isset($v) || trim($v)==='');
	}

	function aphs_mergeEmptyOptions(&$options, $defaults) {
	    foreach ($options as $key => $value) {

	        if(!is_array($options[$key]) && aphs_isNullOrEmpty($options[$key]) && array_key_exists($key, $defaults)) {
	            $options[$key] = $defaults[$key];
	        }
	    }
	}

	function aphs_removeSlashes($string){
	    $string = implode("",explode("\\",$string));
	    return stripslashes(trim($string));
	}

	function aphs_underscoreToCamelCase($string, $capitalizeFirstCharacter = false){
	    $str = str_replace('_', '', ucwords($string, '_'));
	    if (!$capitalizeFirstCharacter) {
	        $str = lcfirst($str);
	    }
	    return $str;
	}

	function aphs_compressCss($buffer){
		/* remove comments */
		$buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer) ;
		/* remove tabs, spaces, newlines, etc. */
		$arr = array("\r\n", "\r", "\n", "\t", "  ", "    ", "    ");
		$rep = array("", "", "", "", " ", " ", " ");
		$buffer = str_replace($arr, $rep, $buffer);
		/* remove whitespaces around {}:, */
		$buffer = preg_replace("/\s*([\{\}:,])\s*/", "$1", $buffer);
		/* remove last ; */
		$buffer = str_replace(';}', "}", $buffer);
		
		return $buffer;
	}

	function aphs_restructureFilesArray($files){
	    $output = [];
	    foreach ($files as $attrName => $valuesArray) {
	        foreach ($valuesArray as $key => $value) {
	            $output[$key][$attrName] = $value;
	        }
	    }
	    return $output;
	}

	function aphs_debug_to_console($data) {
	    $output = $data;
	    if (is_array($output))
	        $output = implode(',', $output);

	    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}	







?>