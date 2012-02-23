jQuery(window).load(function(){
	var minWidth = (document.minWidth) 		? document.minWidth : 72; 	// default min image width
	var minHeight = (document.minHeight) 	? document.minHeight : 89;	// default min image height
	jQuery('#cropbox').Jcrop({
		setSelect: [ 50, 50, 150, 175 ], 	// initial crop area [ start_x, start_y, end_x, end_y ]
		minSize: [minWidth,minHeight],				// minimum size [ width, height ]
		onChange: showPreview,				// function to run on change
		onSelect: showPreview,				// function to run on select
		aspectRatio: 0.8					// crop box aspect ratio
	});
});

jQuery(window).unload(function() {			// clean up function
	var docRoot = (document.docRoot) 	? document.docRoot : '/';	// set document root
	jQuery.ajax({url:docRoot+"inc/cleanup.php", async:false});
});

function showPreview(coords){
	// updates on change with the following:
	// width = coords.w
	// height = coords.h
	// xpos = coords.x
	// ypos = coords.y
	jQuery('#cropbox').data('coords',coords); // attach coords to object for easy retrieval
}

function previewImage(img) {
	var docRoot = (document.docRoot) 	? document.docRoot : '/';	// set document root
	setLoader(true); // show loader
	coords = jQuery('#cropbox').data('coords');
	if(typeof(coords)=='object') {
		width = coords.w;
		height = coords.h;
		xpos = coords.x;
		ypos = coords.y;
		thWidth = jQuery('#cropbox').width();
		thHeight = jQuery('#cropbox').height();
		console.log('URL',docRoot+"inc/previewImage.php");
		jQuery.ajax({ 
			url: docRoot+"inc/previewImage.php",
			type: "GET",
			data: "image="+img+"&thWidth="+thWidth+"&thHeight="+thHeight+"&width="+width+"&height="+height+"&xpos=-"+xpos+"&ypos=-"+ypos,
			context: document.body,
			success: function(ret){
				console.log('DATA',"image="+img+"&thWidth="+thWidth+"&thHeight="+thHeight+"&width="+width+"&height="+height+"&xpos=-"+xpos+"&ypos=-"+ypos);
				// run on completetion
				if(ret.substr(0,4)=='FAIL') {
					alert(ret.substr(5));
				} else {
					timestamp = new Date().getTime();
					console.log('IMAGE',ret);
					jQuery('#preview').html('<img src="'+ret+'?t='+timestamp+'" />');
				}
				jQuery('#div_accept').fadeIn("fast"); // show accept button
				setLoader(false); // hide loader
		}});
	} else {
		alert('Sorry: Could not retrieve the crop coordinates');
	}
}

function setLoader(state) {
	state = (state==true) ? true : false;
	if(state) {
		// show loader
		jQuery('#div_loader').fadeIn("fast");
	} else {
		// hide loader
		jQuery('#div_loader').fadeOut("fast");
	}
}