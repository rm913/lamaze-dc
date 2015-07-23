(function () {
 "use strict";
jQuery(document).ready(function(){
	
	//=================================== FADE EFFECT ===================================//
	
	jQuery('.klasik-pf-img a').hover(
		function() {
			jQuery(this).find('.rollover').stop().fadeTo(500, 0.6);
		},
		function() {
			jQuery(this).find('.rollover').stop().fadeTo(500, 0);
		}
	
	);
	
	runcamera();
	runflexslider();
	runviewportChecker();
});


/*** Animated Effect ***/
function runviewportChecker(){
	jQuery("*[data-animate]")
	  .addClass('hidden')
	  .each(function(i, e){
		jQuery(this)
		  .viewportChecker({
			classToAdd: 'visible animated ' + jQuery(this).data('animate'),
			offset: 200
		});
	  });
}


function runflexslider(){
	//=================================== FLEXSLIDER ===================================//
	jQuery('.flexslider').flexslider({
		animation: "fade",
		touch:true,
		animationDuration: 6000,
		directionNav: true,
		controlNav: false
	});
	
}

function runcamera(){
	if(jQuery('#slideritems').length){
		jQuery('#slideritems').camera({
			height: '28.65%', /* to set the slider height */
			minHeight: '250px', /* to set minimum the slider height */
			fx: 'simpleFade', /* to set the slider effect */
			autoAdvance: true,
			pagination: false,
			navigation:true,
			navigationHover: true,
			playPause: false,
			thumbnails: false,
			loader: 'none',
			imagePath: '../images/'
		});
	}
}

})(jQuery);