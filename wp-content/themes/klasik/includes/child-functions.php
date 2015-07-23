<?php
function klasik_child_setup() {
	remove_action( 'widgets_init', 'klasik_footer1_sidebar_init' );
	remove_action( 'widgets_init', 'klasik_footer2_sidebar_init' );
	remove_action( 'widgets_init', 'klasik_footer3_sidebar_init' );
	remove_action( 'widgets_init', 'klasik_footer4_sidebar_init' );

}
add_action( 'after_setup_theme', 'klasik_child_setup' );

// =============================== Klasik Advanced Post widget ======================================
function klasik_child_advancedpost_item_template1($val, $content=''){
	$tpl ='<div id="advpost-%%ID%%" class="tpl1 %%CLASS%%">';
		$tpl .='<div class="recent-item">';
		$tpl .= '<div class="recent-thumb">%%THUMB%%</div>';
		
		$tpl .= '<span class="smalldate">%%MONTH%<span class="day">%%DAY%%</span></span>';
		$tpl .= '<h3 class="recent-title"><a href="%%LINK%%">%%TITLE%%</a></h3>';
		$tpl .='<div class="clear"></div>';

		$tpl .='<div class="recent-text">%%TEXT%%</div>';
		
		$tpl .='<div class="clear"></div>';
		
		$tpl .='</div>';
	$tpl .='</div>';
	return $tpl;
}

add_filter('klasik_advancedpost_item_template1', 'klasik_child_advancedpost_item_template1',2);

function klasik_child_advancedpost_item_template2($val, $content=''){
	$tpl2 ='<div id="advpost-%%ID%%" class="tpl1 %%CLASS%%">';
		$tpl2 .='<div class="recent-item">';
		$tpl2 .= '<div class="recent-thumb">%%THUMB%%</div>';
		
		$tpl2 .= '<span class="smalldate">%%MONTH%<span class="day">%%DAY%%</span></span>';
		$tpl2 .= '<h3 class="recent-title"><a href="%%LINK%%">%%TITLE%%</a></h3>';
		$tpl2 .='<div class="clear"></div>';

		$tpl2 .='<div class="recent-text">%%TEXT%%</div>';
		
		$tpl2 .='<div class="clear"></div>';
		
		$tpl2 .='</div>';
	$tpl2 .='</div>';
	return $tpl2;
}

add_filter('klasik_advancedpost_item_template2', 'klasik_child_advancedpost_item_template2',3);



define('KLASIK_SLIDERTEXTEFFECT', 'moveFromLeft');

/* Portfolio Carousel */
define("KLASIK_PF_NAV", "directional"); //Option for navigation control, directional and both 

/* Testimonial Carousel */
define("KLASIK_TESTI_NAV", "directional"); //Option for navigation control, directional and both 

/* Team Carousel */
define("KLASIK_TEAM_NAV", "directional"); //Option for navigation control, directional and both 


/* class klasik */
add_filter( 'body_class', 'klasik_body_class' );
function klasik_body_class( $classes ) {
	// add 'class-name' to the $classes array
	$classes[] = 'childclass';
	// return the $classes array
	return $classes;
}
