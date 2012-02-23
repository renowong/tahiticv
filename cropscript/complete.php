<?php 
if(!session_id()) { session_start(); }							// start session

// SETTINGS
$docRoot = @$_SESSION['cropper']['doc_root'];
$path_orig = @$_SESSION['cropper']['path_orig'];					// get settings from session
$path_temp = @$_SESSION['cropper']['path_temp'];
$path_crops = @$_SESSION['cropper']['path_crops'];
$thumbs = @$_SESSION['cropper']['thumbs'];
$prefix_full = @$_SESSION['cropper']['img_prefix_full'];
$prefix_main = @$_SESSION['cropper']['img_prefix_main'];
$required = @$_SESSION['cropper']['required'];

$error = false;														// set default error state

$finished_images = array();											// array to hold finished images

// check preview image is set and exists
if((isset($_SESSION['cropper']['preview']))&&(file_exists($_SESSION['cropper']['preview']))) {
	// Handle Posted Items
	if(intval(@$_POST['submitted'])) {
		// ERROR CHECK IF NEEDED
		foreach($required as $r) {
			if((!isset($_POST[$r]))||(trim($_POST[$r])=='')) {
				$er = "You didn't complete the field: ".$r." - now you're gonna have to go back and do it all over again!";
				$error = (!$error) ? $er : $error."<br />".$er;
			}
		}
	}
	
	if(!$error) { // carry on if there was no error
		// STORE LOCATION OF ORIGINAL IMAGE
		if($_SESSION['cropper']['image']) { $finished_images['original'] = $_SESSION['cropper']['image']; } // store image in image array
		
		// MOVE THE FULLSIZE CROP FILE TO CROPS FOLDER
		$full = rename($_SERVER['DOCUMENT_ROOT'].$docRoot.$_SESSION['cropper']['img_full'], $_SERVER['DOCUMENT_ROOT'].$docRoot.$path_crops.$prefix_full.basename($_SESSION['cropper']['image']));
		if($full) { $finished_images['full'] = $path_crops.$prefix_full.basename($_SESSION['cropper']['image']); } // store image in image array
		
		// MOVE THE PREVIEW FILE TO CROPS FOLDER
		$img_main = $distance.$path_crops.$prefix_main.basename($_SESSION['cropper']['image']); // use the original image name  + prefix
																								// (this has already been checked for duplicate names and made unique)
		$moved = rename($_SESSION['cropper']['preview'], $img_main);
		if($full) { $finished_images['main'] = $img_main; } // store image in image array
		
		if(!$moved) { // create error if the image was not moved correctly
			$error = 'Sorry, there seems to have been an error storing your photo - please <a href="Javascript:history.back(1);">go back</a> and try again';
		}
		
		// CREATE ALL THUMBS
		if(($moved)&&(count($thumbs>0))) {
			require_once('inc/_img.php');								// include image upload and manipulation class
			$_image = new _image;										// instantiate img object
			$_image->source_file = $img_main;							// get cropped image
			foreach($thumbs as $prefix => $size) {						// loop through thumbnails
				// resize image to fit
				$_image->namePrefix = $prefix;
				$_image->newWidth	= $size['width'];
				$_image->newHeight	= $size['height'];
				$_image->duplicates = 'o'; // overwrite
				$img = $_image->resize();
				if($img) { $finished_images[$prefix] = $img; } // store image in image array
			}
		}
		
		// CLEAN UP TEMP IMAGES
		if(file_exists($_SESSION['cropper']['image_temp'])) {
			unlink($_SESSION['cropper']['image_temp']);
		}
		// CLEAR SESSION
		unset($_SESSION['cropper']);
		
		// Store Posted Items
		if(intval(@$_POST['submitted'])) {
					
			// ADD TO DB IF NEEDED BUT I AM JUST GONNA DUMP OUT THE CONTENTS
			$output = '<strong>You submitted:</strong><br />';
			foreach($_POST as $f => $v) {
				if(!in_array($f,array('submitted','submit'))) { $output .= "$f => $v<br />"; }
			}
		}
	}
} else { // no preview image available
	$error = 'You need to preview the photo before you press accept';
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complete: Upload and Crop</title>
<link type="text/css" rel="stylesheet" href="inc/css" />
<script language="javascript" type="text/javascript">
	function wclose(){
		window.opener.document.getElementById('avatar').value = document.getElementById('med_').value;
		self.close();
	}
</script>
</head>

<body onload="wclose();">
<!-- TEMPORARY CONTENT -->
<h1>T&eacute;l&eacute;verseur et ajusteur d'image TahitiCV</h1>
<p>&copy;: 2011 MJDIGITAL</p>
<p class="desc">Image upload and crop tool - upload your profile picture and crop it to a set size of <?php echo $cropperWidth.'x'.$cropperHeight; ?> keeping the aspect ratio. Follow the steps in order.</p>
<!-- END TEMPORARY CONTENT -->

<?php 
if($error) { // output errors
	echo '<p>'.$error.'</p>'; 
} elseif(count($finished_images)<1) { // no finished images created/stored
	echo '<p>Sorry, it appears your images were not stored correctly - please <a href="Javascript:history.back(1);">go back</a> and try again</p>';
} else {
	// All fine - write out thanks and show image links
	echo '<p>Thank you - here are your images:</p>
	<p>';
	foreach($finished_images as $type => $img) {
		//if(file_exists($img)) {
			$w = $_image->get_image_width($img);
			$h = $_image->get_image_height($img);
			echo '<input type="hidden" id="'.$type.'" name="'.$type.'" value="'.basename($img).'"/><strong>'.$type.':</strong> <a href="'.$img.'" target="_blank">'.basename($img).'</a> ('.$w.'x'.$h.')<br />';
		//} else {
		//	echo 'Image: <strong title="'.$img.'">'.basename($img).'</strong> was not found<br />';
		//}
	}
	echo '</p>';
	echo $output;
} ?>
</body>
</html>