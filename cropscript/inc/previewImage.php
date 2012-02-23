<?php 
if(!session_id()) { session_start(); }				// start session

// SETTINGS
$docRoot			= $_SESSION['cropper']['doc_root'];
$img_path 			= $_SESSION['cropper']['path_temp'];			// folder to hold temporary image
$img_height			= intval($_SESSION['cropper']['img_height']);	// main image height
$img_width			= intval($_SESSION['cropper']['img_width']);	// main image width
$img_type			= 'jpg';										// convert files to JPG
$prefix				= $_SESSION['cropper']['img_prefix_full'];		// full size cropped image name prefix

$img = false;											// default value for image
// INITIAL IMAGE UPLOAD
$passedImage = $_SERVER['DOCUMENT_ROOT'].@$_GET['image'];
// check all data was passed
$errors = array();
switch(true) {
	case (!isset($_GET['image'])): 										$errors[] = 'The image was not passed'; break;
	case ((!isset($_GET['thWidth']))||(!intval($_GET['thWidth']))): 	$errors[] = 'The thumbnail width was not passed or was invalid'; break;
	case ((!isset($_GET['thHeight']))||(!intval($_GET['thHeight']))): 	$errors[] = 'The thumbnail height was not passed or was invalid'; break;
	case ((!isset($_GET['width']))||(!intval($_GET['width']))): 		$errors[] = 'The crop area width was not passed or was invalid'; break;
	case ((!isset($_GET['height']))||(!intval($_GET['height']))): 		$errors[] = 'The crop area height was not passed or was invalid'; break;
	case (!isset($_GET['xpos'])): 										$errors[] = 'The crop area x position was not passed'; break;
	case (!isset($_GET['ypos'])): 										$errors[] = 'The crop area y position was not passed'; break;
}
if((count($errors)==0)&&(file_exists($passedImage))) { 	// check if image exists + no errors found
	require_once($_SERVER['DOCUMENT_ROOT'].$_SESSION['cropper']['doc_root'].'inc/_img.php');	// include image upload and manipulation class
	$_image = new _image;								// instantiate img object
	$_image->source_file = $passedImage;				// set passed image as source file
	$_image->newPath = $_SERVER['DOCUMENT_ROOT'].$docRoot.$img_path; // set new path for temporary crop preview
	// get original image size
	$origWidth = $_image->get_image_width($passedImage);
	$origHeight = $_image->get_image_height($passedImage);
	// calculate shrinkage ratio
	$wRatio = $origWidth/$_GET['thWidth'];
	$hRatio = $origHeight/$_GET['thHeight'];
	
	// inflate crop values by ratio to match original dimensions
	$cropWidth = ceil($_GET['width']*$wRatio);
	$cropHeight = ceil($_GET['height']*$hRatio);
	$cropX = ceil($_GET['xpos']*$wRatio);
	$cropY = ceil($_GET['ypos']*$hRatio);
	
	// crop original
	$crop = $_image->crop($cropWidth,$cropHeight,$cropX,$cropY);
	
	copy($crop,$_SERVER['DOCUMENT_ROOT'].$docRoot.$img_path.$prefix.basename($crop));			// make a copy of the fullsize crop
	if(isset($_SESSION['cropper']['img_crop'])) {			// check if fullsize crop session exists (holding previously cropped image)
		@unlink($_SESSION['cropper']['img_crop']);			// delete old image
		unset($_SESSION['cropper']['img_crop']);			// clear session
		unset($_SESSION['cropper']['img_full']);			// clear session
	}
	$_SESSION['cropper']['img_crop'] = $img_path.$prefix.basename($crop);
	$_SESSION['cropper']['img_full'] = substr($img_path.$prefix.basename($crop),strlen($distance));
	
	if(@$crop) { 
		// resize image to fit
		$_image->source_file = $crop;
		$_image->newWidth	= $img_width;
		$_image->newHeight	= $img_height;
		$_image->padToFit = false;
		$_image->upscale = 'true';
		$_image->duplicates = 'o';							// overwrite original crop (not fullsize copy)
		$img = $_image->resize();
	}
	
	if(@$img) { 											// image resized OK
		if(isset($_SESSION['cropper']['img_preview'])) {	// check if crop session exists (holding previously cropped image)
			@unlink($_SESSION['cropper']['img_preview']);	// delete old image
			unset($_SESSION['cropper']['img_preview']);		// clear session
			unset($_SESSION['cropper']['preview']);			// clear session
		}
		$_SESSION['cropper']['img_preview'] = $img;			// add image to temporary session (relative to this script)
		$_SESSION['cropper']['preview'] = substr($img,strlen($distance)); // add image to temporary session (relative to parent doc)
		echo substr($img,strlen($_SERVER['DOCUMENT_ROOT']));				// return image path (relative to parent doc)
	} else {
		echo 'FAIL|Image failed to crop';
	}
} else {
	if(!file_exists($passedImage)) { $errors[] = "The file was not stored correctly or the path \"".$_GET['image']."\" was not correct"; }
	echo 'FAIL|';
	foreach($errors as $er) {
		echo $er."\n";
	}
}
?>