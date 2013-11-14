// JavaScript Document
if (!window.parseBool) {
	function parseBool(value) {
	  if (typeof value === "string") {
	     value = value.replace(/^\s+|\s+$/g, "").toLowerCase();
	     if (value === "true" || value === "false")
	       return value === "true";
	  }
	  return; // returns undefined
	}
}

jQuery(function(){ 

	jQuery('.view a').click(function(){

		if(jQuery(this).hasClass('gallery')){
		
			jQuery(this).parent().parent().find('.block').removeClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		} else {
					
			jQuery(this).parent().parent().find('.block').addClass('block-fullwidth');
			jQuery('.view a').removeClass('active');
			jQuery(this).addClass('active');
		
		}
		
		return false;
		
	});
	
	// Uniform
	jQuery("select.orderby, .variations select, input[type=radio]").uniform();
   	// Setup the slider
   jQuery(window).load(function(){
	   if( woo_general_params.enabled=='true' ) {
                        jQuery('#slider').nivoSlider({
					effect: 'fold',               // Specify sets like: 'fold,fade,sliceDown'
					slices: 15,                     // For slice animations
					boxCols: 8,                     // For box animations
					boxRows: 4,                     // For box animations
					animSpeed: parseInt(woo_general_params.slideSpeed),                 // Slide transition speed
					pauseTime: 3000,                // How long each slide will show
					startSlide: 0,                  // Set starting Slide (0 index)
					directionNav: false,             // Next & Prev navigation
					controlNav: true,               // 1,2,3... navigation
					controlNavThumbs: false,        // Use thumbnails for Control Nav
					pauseOnHover: true,             // Stop animation while hovering
					manualAdvance: false,           // Force manual transitions
					prevText: 'Prev',               // Prev directionNav text
					nextText: 'Next',               // Next directionNav text
					randomStart: false,             // Start on a random slide
					beforeChange: function(){},     // Triggers before a slide transition
					afterChange: function(){},      // Triggers after a slide transition
					slideshowEnd: function(){},     // Triggers after all slides have been shown
					lastSlide: function(){},        // Triggers when last slide is shown
					afterLoad: function(){}         // Triggers when slider has loaded
				});
			
		}
	});
	
});