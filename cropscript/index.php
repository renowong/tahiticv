<?php 
// SETTINGS
$img_path_init 		= 'assets/images/uploads/originals/';		// folder to upload initial image into - relative to this document
$img_path_temp 		= 'assets/images/uploads/temp/';			// folder to hold temporary image into - relative to this document
$img_path_crops		= 'assets/images/uploads/crops/';			// folder to upload cropped images into - relative to this document
$img_height_main	= 375;										// main image height (use largest size required)
$img_width_main		= 300;										// main image width
$img_type			= 'jpg';									// convert all uploads to JPG

$minImageWidth		= 300;										// minimum width of uploaded image
$minImageHeight		= 375;										// minimum height of uploaded image

$minWidth			= 72;										// set minimum image crop width
$minHeight			= 89;										// set minimum image crop height

$cropperWidth		= 600;										// width of temporary image used as the cropper
$cropperHeight		= 480;										// height of temporary image used as the cropper

// image name prefixes
$prefix_full		= 'full_';									// full size cropped image name prefix
$prefix_main		= '';										// main cropped image name prefix

// Required fields
$required			= array('field1');							// ID/name of required fields to be submitted


// set dimensions + name prefix of any extra thumbnails required:
// use: 'prefix' => array('width'=>100,'height'=>150)
// DO NOT INCLUDE THE MAIN IMAGE SIZE SET ABOVE
$thumbs = array(
	'med_' => array('width'=>134,'height'=>167)
	#'sml_' => array('width'=>72,'height'=>89)
);

// INITIALISE

$docURI			= $_SERVER['REQUEST_URI'];						// gets the base location of this file
$docPage		= basename($_SERVER['PHP_SELF']);				// gets the page name of this file
$docRoot		= str_replace($docPage,'',$docURI);				// get the exact path to root for this page

if(!session_id()) { session_start(); }							// start session - used to store images
if(!isset($_SESSION['cropper'])) {
	$_SESSION['cropper'] = array();								// create cropper session to hold imagery if not already set
}
$_SESSION['cropper']['doc_root'] 		= $docRoot;
$_SESSION['cropper']['path_orig'] 		= $img_path_init;		// pass settings to be available to AJAX called pages
$_SESSION['cropper']['path_temp'] 		= $img_path_temp;
$_SESSION['cropper']['path_crops'] 		= $img_path_crops;
$_SESSION['cropper']['img_height'] 		= $img_height_main;
$_SESSION['cropper']['img_width'] 		= $img_width_main;
$_SESSION['cropper']['thumbs'] 			= $thumbs;
$_SESSION['cropper']['img_prefix_full']	= $prefix_full;
$_SESSION['cropper']['img_prefix_main']	= $prefix_main;
$_SESSION['cropper']['required']		= $required;

$error = false;													// set default error state
$img = false;													// set default value for image

// INITIAL IMAGE UPLOAD - executed when an image is posted
if(isset($_FILES['image'])) { 									// check if file field 'image' has been posted
	require_once($_SERVER['DOCUMENT_ROOT'].$docRoot.'inc/_img.php');		// include image upload and manipulation class
	$_image = new _image;										// instantiate img object
	$_image->uploadTo = $img_path_init;							// upload to $img_path_init set above
	$image = $_image->upload($_FILES['image']);					// perform upload
	if($image) {												// if uploaded OK then resize to fit main image area
		$fullWidth = $_image->get_image_width($image);			// get width of uploaded image
		$fullHeight = $_image->get_image_height($image);		// get height of uploaded image
		if(($fullWidth>=$minImageWidth)
			&&($fullHeight>=$minImageHeight)) {					// check uploaded image is big enough
			if(isset($_SESSION['cropper']['image'])) {			// check if image session exists (holding previously uploaded image)
				@unlink($_SESSION['cropper']['image']);			// delete old original image
				@unlink($_SESSION['cropper']['image_temp']);	// delete old temporary image
				unset($_SESSION['cropper']['image']);			// clear image session
				unset($_SESSION['cropper']['image_temp']);		// clear temp image session
			}
			$_SESSION['cropper']['image'] = $image;				// add new image to session
			// RESIZE to 
			$_image->newHeight 		= $cropperHeight;			// max height
			$_image->newWidth 		= $cropperWidth;			// max width
			$_image->newPath		= $img_path_temp;			// path for temporary image
			$_image->aspectRatio 	= 'true';					// maintain aspect ratio for original image
			$_image->padToFit		= 'false';					// do not pad the image with coloured space to fit height/width
			$_image->newImgType 	= $img_type; 				// force output to type specified above
			$i = $_image->resize();								// resize image
			if(file_exists($i)) { 								// image resized OK
				$_SESSION['cropper']['image_temp'] = $i;		// save new temp image to session
				$img = $i;
				list($thumbWidth, $thumbHeight) = getimagesize($i);
			}
		} else {
			$error = 'La photo doit mesurer au minimum '.$minImageWidth.' pixels en longeur par '.$minImageHeight.' pixels en hauteur';
		}
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload and Crop</title>
<link type="text/css" rel="stylesheet" href="<?php echo $docRoot; ?>inc/css" />
<style type="text/css">
/* Image paths set here to allow for shifting root directories */
#tbl_cropper_wrap #preview		{	background:url(<?php echo $docRoot; ?>../images/unknown-person.jpg) left top no-repeat #EEE;}
#div_loader						{	background:url(<?php echo $docRoot; ?>assets/images/black80.png) left top repeat;}
.jcrop-vline, .jcrop-hline		{	background: white url(<?php echo $docRoot; ?>inc/css/Jcrop.gif) top left repeat;}
</style>
<script language="javascript" type="text/javascript">
// pass the minimum height and width values to the document
document.minWidth 	= <?php echo $minWidth; ?>;
document.minHeight 	= <?php echo $minHeight; ?>;
document.docRoot 	= '<?php echo $docRoot; ?>';
function checkRequired() {
	reqFields = '#<?php echo trim(implode(',#',$required),',# '); ?>';
	if(reqFields!='') {
		req = jQuery(reqFields);
		retVal = true;
		req.each(function(i,e){
			if(jQuery.trim(jQuery(e).val()).length<1) {
				erID = jQuery(e).attr("id")+'_error';
				if(jQuery('#'+erID).length>0) { jQuery(jQuery('#'+erID)).fadeIn(); }
				retVal = false;
			}
		});
		return retVal;
	} else { return false; }
}
</script>
<script language="javascript" type="text/javascript" src="<?php echo $docRoot; ?>inc/js"></script>
</head>

<body>
<!-- TEMPORARY CONTENT -->
<h1>T&eacute;l&eacute;verseur et ajusteur d'image TahitiCV</h1>
<p>&copy;: 2011 MJDIGITAL</p>
<p class="desc">T&eacute;l&eacute;versez votre image et dimensionnez la en <?php echo $cropperWidth.'x'.$cropperHeight; ?>. Suivez les directives.</p>
<!-- END TEMPORARY CONTENT -->

<!-- START >> CROPPER -->
<?php if(isset($_FILES['image'])) { // write out the onplete form ?>
<form id="form_cropper" name="form_cropper" action="<?php echo $docRoot; ?>complete.php" method="post" onsubmit="return checkRequired();">
<?php } else { // write out the normal form ?>
<form id="form_cropper" name="form_cropper" action="" enctype="multipart/form-data" method="post">
<?php } ?>
<table id="tbl_cropper_wrap">
	<tr>
		<th id="container">
			<div id="div_loader"><img src="<?php echo $docRoot; ?>assets/images/loader.gif" width="31" height="31" alt="Loading" /></div>
			<div id="div_main_img"><?php 
			if($error) {
				echo '<div class="error">'.$error.'</div>';
			}
			if($img) { 
				echo '<img src="'.$img.'" id="cropbox" width="'.$thumbWidth.'" height="'.$thumbHeight.'" />'; 
			}?>
			</div>
		</th>
		<td rowspan="2" id="preview"></td>
	</tr>
	<tr>
		<td>
			<div id="div_file">
				1: <input name="image" type="file" />
			</div>
			<div id="div_submit">
				2: <input name="" type="submit" onclick="setLoader(true);" />
			</div>
			<?php 
			if($img) { ?>
			<div >
				3: Ajustez les dimensions et d&eacute;coupez.
			</div>
			<div id="div_test">
				4: <input type="button" onclick="previewImage('<?php echo $docRoot.$image; ?>');" value="Visionner Image" />
			</div>
			<div id="div_accept" style="display:none;">
                <dd>
                <input type="hidden" name="field1" id="field1" value="hiddenindex" /></dd>
		<input type="hidden" name="submitted" value="1" />
                <input name="submit" type="submit" value="Accepter" tabindex="5" />
			</div>
			<?php } ?>
		</td>
	</tr>
</table>
</form>
<!-- END << CROPPER -->
</body>
</html>