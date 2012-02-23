<?php 
	#############################################################
	#															#
	#		JS Script Compiler									#
	#		Used to reduce HTTP Requests						#
	#															#
	#		MJCMS v3											#
	#		© 2009 MJDIGITAL									#
	#		All rights reserved									#
	#															#
	#############################################################
	
	header("Content-Type: text/javascript"); // set content type to JS
	$jsFiles = array();
	// make sure parameters are passed by URL param 'f'
	if((isset($_GET['f']))&&($_GET['f'])!='') {
		$files = explode(',',$_GET['f']);
	} else {
		$files = array(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/'))); // search this directory
	}
	foreach($files as $f) {
		if($f!=dirname($_SERVER['SCRIPT_NAME'])) { 
			$f = (substr($f,0,1)=='/') ? $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME']).$f : $f;
		} else { // is this directory
			$f = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME']);
		}
		// include whole directory
		if(is_dir($f)) {
			if($handle = opendir($f)) {
				$temp = array();
				while (false !== ($file = readdir($handle))) {
					if (stristr($file,'.js')) {
						$temp[$file] = "$f/$file";
						//echo "$f/$file";
						//echo "\n";
					}
				}
			ksort($temp);
			$jsFiles = array_merge($jsFiles,$temp);
			closedir($handle);
			}
		} else {
			if(file_exists($f)) {
				$jsFiles[basename($f)] = $f;
			}
		}
	}
	if(count($jsFiles)>0) {
		 // list alphabetically
		$jsFiles = array_unique($jsFiles);
		ksort($jsFiles);
		foreach($jsFiles as $key => $js) {
			include($js);
			//echo "$key => $js";
			echo "\n";
		}
	}	
?>