<?php
// =============================== Klasik Portfolio Filter widget ======================================
class Klasik_PFilterWidget extends WP_Widget {
    /** constructor */

	function Klasik_PFilterWidget() {
		$widget_ops = array('classname' => 'widget_klasik_pfilter', 'description' => __('KlasikThemes Portfolio Filter','klasik') );
		$this->WP_Widget('klasik-theme-pfilter-widget', __('KlasikThemes Portfolio Filter','klasik'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title 					= apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$subtitle 				= apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle']);
		$cats 					= apply_filters('widget_category', empty($instance['category']) ? array() : $instance['category']);
		$display 				= apply_filters('widget_display', empty($instance['display']) ? '' : $instance['display']);
	
		$cols 					= apply_filters('widget_cols', empty($instance['cols']) ? '' : $instance['cols']);
		$showposts 				= apply_filters('widget_showpost', empty($instance['showpost']) ? '' : $instance['showpost']);
		$longdesc 				= apply_filters('widget_longdesc', empty($instance['longdesc']) ? '' : $instance['longdesc']);
		$customclass 			= apply_filters('widget_customclass', empty($instance['customclass']) ? '' : $instance['customclass']);
		$enablepagenum 			= isset($instance['enablepagenum']) ? $instance['enablepagenum'] : false;
		$instance['category'] 	= isset($instance['category'])? $instance['category'] : "";
		
		
		$show_advanced_option	= isset($instance['show_advanced_option']) ? $instance['show_advanced_option'] : false;
		$layout 				= apply_filters('widget_layout', empty($instance['layout']) ? '' : $instance['layout']);
		$spacingtop 			= apply_filters('widget_spacingtop', empty($instance['spacingtop']) ? '' : $instance['spacingtop']);
		$spacingbottom 			= apply_filters('widget_spacingbottom', empty($instance['spacingbottom']) ? '' : $instance['spacingbottom']);
		$spacingside 			= apply_filters('widget_spacingside', empty($instance['spacingside']) ? '' : $instance['spacingside']);
		$border_top 			= apply_filters('widget_border_top', empty($instance['border_top']) ? '' : $instance['border_top']);
		$border_bottom 			= apply_filters('widget_border_bottom', empty($instance['border_bottom']) ? '' : $instance['border_bottom']);
		
		$customize_background	= isset($instance['customize_background']) ? $instance['customize_background'] : false;
		$background_image		= apply_filters('widget_background_image', empty($instance['background_image']) ? '' : $instance['background_image']);
		$background_color		= apply_filters('widget_background_color', empty($instance['background_color']) ? '' : $instance['background_color']);
		$background_repeat		= apply_filters('widget_background_repeat', empty($instance['background_repeat']) ? '' : $instance['background_repeat']);
		$background_position	= apply_filters('widget_background_position', empty($instance['background_position']) ? '' : $instance['background_position']);
		$background_attachment	= apply_filters('widget_background_attachment', empty($instance['background_attachment']) ? '' : $instance['background_attachment']);
		$background_size		= apply_filters('widget_background_size', empty($instance['background_size']) ? '' : $instance['background_size']);
		$background_opacity		= apply_filters('widget_background_opacity', empty($instance['background_opacity']) ? '' : $instance['background_opacity']);

		
		
		
        if ( $customclass ) {
            $before_widget = str_replace('class="', 'class="'. $customclass . ' ', $before_widget);
        }    
		
		global $wp_query;
		
		
        ?>
              <?php echo $before_widget; 


					
					 $spacing_left_right = '';
					 $spacing_top_bottom = '';
					 $border = '';

					 if($show_advanced_option){
						 if($border_top){
							$border .= 'border-top:'.$border_top.'; ';
						 }
						 
						 if($border_bottom){
							$border .= 'border-bottom:'.$border_bottom.'; ';
						 }
	
						 if($spacingtop){
							$spacing_top_bottom .= 'padding-top:'.$spacingtop.'; ';
						 }
						 
						 if($spacingbottom){
							$spacing_top_bottom .= 'padding-bottom:'.$spacingbottom.'; ';
						 }
						 
						 if($spacingside){
							$spacing_left_right .= 'padding-left:'.$spacingside.'; ';
							$spacing_left_right .= 'padding-right:'.$spacingside.'; ';
						 }
					 }

				
					$bgcolor_rgba='';
					$bgopacity ='';
					
					if($background_opacity != "default"	){
						$bgopacity = $background_opacity;
					}
					
					$klasik_color = $background_color;
					$rgb = klasik_hex2rgba($klasik_color);
					$rgba = klasik_hex2rgba($klasik_color, $bgopacity);
					
					$background='';
					 if($customize_background){
						if($background_color){
						$bgcolor_rgba 		= 'background-color:'.$rgba.'; ';
						}
						
						if($background_image){
					 	$background .= 'background-image:url('.$background_image.'); ';
						}

						if($background_repeat != "default"){
						$background	.= 'background-repeat:'.$background_repeat.'; ';
						}
						if($background_position != "default"){
						$background .= 'background-position:'.$background_position.'; ';
						}
						if($background_attachment != "default"){
						$background	.= 'background-attachment:'.$background_attachment.'; ';
						}
						if($background_size != "default"){
						$background	.= 'background-size:'.$background_size.'; ';
						}
					 }	
					 
					 $layoutcss='';
					 if( $layout == 'fullwidth'){$layoutcss = 'fullwidth';} else {$layoutcss = 'boxed';}
					 
					 echo '<div class="all-widget-container  '.$layoutcss.'" style="'.$background.' '.$border.' ">';
					 
					 
					 echo '<div class="opacity" style="'.$bgcolor_rgba.'">';
					 
					 
					 echo '<div class="all-widget-wrapper" style="'.$spacing_top_bottom.'">';
					 

					 
					 if( $layout == 'fullwidth'){} else{
					 echo '
                		<div class="container">
                    	<div class="row">
                        <div class="twelve columns">
					 ';
					 }
					 
					 echo '<div class="klasik-portfolio-widget-wrapper"  style="'.$spacing_left_right.'">';



					 $subtitlewrap ="";
					 if($subtitle){
					 $subtitlewrap .='<span class="widget-subtitle-wrap"><span class="widget-subtitle">'.$subtitle.'</span><span class="line"></span></span>';
					 }
					 $titleline='<span class="line-wrap"><span class="line"></span></span>';
					 
			  			
					if ( $title!='' )
					echo $before_title . esc_html($title). $subtitlewrap . $titleline . $after_title;
						
					$cols = intval($cols);
		
					if(!is_numeric($cols) || $cols < 1 || $cols > 6){
						$cols = 4;
					}
					
						if($cols==1){
							$minitems = "0";
							$itemwidth = "250";
						}elseif($cols==2){
							$minitems = "2";
							$itemwidth = "250";
						}elseif($cols==3){
							$minitems = "2";
							$itemwidth = "250";
						}elseif($cols==4){	
							$minitems = "2";
							$itemwidth = "250";
						}elseif($cols==5){
							$minitems = "2";
							$itemwidth = "240";
						}elseif($cols==6){
							$minitems = "2";
							$itemwidth = "150";
						}
					
					
					$longdesc = (!is_numeric($longdesc) || empty($longdesc))? 0 : $longdesc;
					
					$showposts = (!is_numeric($showposts))? get_option('posts_per_page') : $showposts;
					$categories = $cats;
					
					$pagenum = "";
					$withcarousel = "";
					if(!$enablepagenum){$pagenum = 'nopagenum';}
					if( $display == 'carousel'){$withcarousel = "carousel-on"; }
					
					echo '<div class="klasik-portfolio '.$pagenum.' '.$withcarousel.' col'.$cols.'">';
										
						$approvedcat = array();
						$sideoutput = "";
						if( count($categories)!=0 ){
							foreach ($categories as $key) {
								$catname = get_term_by("slug",$key,"category");
								$approvedcat[] = $key;
							}
						}

						$approvedcatID = array();
						$isotopeclass = "";
						if( $display == 'filterable'){
							echo '<div class="frame-filter">';
								echo '<div class="filterlist">';
									echo '<ul id="filter" class="controlnav">';
										echo '<li class="segment-1 selected-1 current first"><a href="#" data-filter="*">'.__('All Categories','klasik').'</a></li>';
										foreach ($categories as $key) {
											$catname = get_term_by("slug",$key,"category");
											echo '<li class="segment-1"><a href="#" class="'.$catname->slug.'" data-filter="'.$catname->slug.'">'.$catname->name.'</a></li>';
											$approvedcatID[] = $key;
										}
									echo '</ul>';
								echo '</div>';
							echo '</div>';
							echo '<div class="clear"></div>';
							$isotopeclass = "isotope portfoliolist";
							$showposts = -1;
						}else{
							foreach ($categories as $key) {
								$catname = get_term_by("slug",$key,"category");
								$approvedcatID[] = $key;
							}
						}
					
						wp_reset_query();
						
						if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
						elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
						else { $paged = 1; }
					
						$temp = $wp_query;
						$wp_query= null;
						$wp_query = new WP_Query();
						
						$args = array(
							'post_type'			=> 'post',
							"paged"         	=> $paged,
							'showposts' 		=> $showposts,
							'orderby' 			=> 'date'
						);
			
						if( count($approvedcatID) ){
							$args['tax_query'] = array(
								array(
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => $approvedcat
								)
							);
						}
														
						$wp_query->query($args);
						global $post;
			
			
						$tpl = '<div data-id="id-%%ID%%" class="%%CLASS%%" data-type="%%KEY%%">';

							$tpl .= '<div class="klasik-pf-img"><div class="shadowBottom">';
								$tpl .= '<a class="pfzoom" href="%%FULLIMG%%" %%LBOXREL%% title="%%TITLE%%"><span class="rollover"></span>%%THUMB%%</a>';
								$tpl .= '<div class="clear"></div>';
							$tpl .= '</div></div>';
							
							$tpl .= '<div class="klasik-pf-text">';
								$tpl .='<h3 class="pftitle"><a href="%%LINK%%" title="%%TITLE%%">';
									$tpl .='<span>%%TITLE%%</span>';
								$tpl .='</a></h3>';
								$tpl .='<div class="textcontainer">%%TEXT%%</div>';
							$tpl .= '</div>';
							
							$tpl .= '<div class="clear"></div>';
						$tpl .= '</div>';
						$tpl = apply_filters( 'klasik_pfilter_item_template', $tpl );
						
						
						if ($wp_query->have_posts()) : 
							$x = 0;
							$output = "";
							$output .= '<div class="row '.$isotopeclass.'">';
							
							//CAROUSEL
										
							if( $display == 'carousel'){ 
							
								if(KLASIK_PF_NAV == 'control'){
									$controlNav ='true';
									$directionNav ='false';
									$UsecontrolNav ='usecontrolnav';
								}elseif(KLASIK_PF_NAV == 'directional'){
									$controlNav ='false';
									$directionNav ='true';
								}elseif(KLASIK_PF_NAV == 'both'){
									$controlNav ='true';
									$directionNav ='true';
									$UsecontrolNav ='usecontrolnav';
								}else{
									$controlNav ='false';
									$directionNav ='true';
								}
							
								echo '
								<script type="text/javascript">
								jQuery(window).load(function() {
						  
								jQuery(".pf-flex-'.$this->get_field_id("klasik-theme-pfilter-widget").'';
									foreach ($categories as $key) {
										$catname = get_term_by("slug",$key,"category");
										echo $catname->slug;
										$approvedcatID[] = $key;
									}
								echo '").flexslider({
										animation: "slide",
										touch:true,
										animationLoop: false,
										controlNav: '.$controlNav.',
										directionNav: '.$directionNav.',
										itemWidth: '.$itemwidth.',
										itemMargin: 0,
										minItems: '.$minitems.',
										maxItems: '.$cols.'
									});
								});
								</script>';
							
								$output .= '<div class="klasik-pf flexslider-carousel '.$UsecontrolNav.' pf-flex-'.$this->get_field_id('klasik-theme-pfilter-widget');
								foreach ($categories as $key) {
									$catname = get_term_by("slug",$key,"category");
									$output .= $catname->slug;
									$approvedcatID[] = $key;
								}
								$output .= '">';
								$output .= '<ul class="slides">';
							
							}
							
							
							while ($wp_query->have_posts()) : $wp_query->the_post(); 
								
								//CAROUSEL
								if( $display == 'carousel'){ 
									$template = '<li>'.$tpl.'</li>';
								}else {
									$template = $tpl;
								}								
								
								
								$custom = get_post_custom($post->ID);
								$cf_custom_price = (isset($custom['custom-price'][0]))? $custom['custom-price'][0] : "";
								$cf_custom_link = (isset($custom['custom-link'][0]))? $custom['custom-link'][0] : "";
								$cf_customdesc 		= get_the_title() ;
								
								$x++;
				
								if($cols==1){
									$colclass = "twelve columns";
								}elseif($cols==2){
									$colclass = "one_half columns";
								}elseif($cols==3){
									$colclass = "one_third columns";
								}elseif($cols==4){	
									$colclass = "one_fourth columns";
								}elseif($cols==5){
									$colclass = "one_fifth columns";
								}elseif($cols==6){
									$colclass = "one_sixth columns";
								}
								
								if($cf_thumb){
									$withimage = "imageon";
								}else{
									$withimage = "imageoff";
								}
								
								if($x%$cols==0){
									$omega = "omega";
								}elseif($x%$cols==1){
									$omega = "alpha";
								}else{
									$omega = "";
								}				
								
								//CAROUSEL
								if( $display == 'carousel'){
									$itemclass = '';
								}else{
									$itemclass = $colclass .' '. $omega;
								}
								
								//get post-thumbnail attachment
								$attachments = get_children( array(
									'post_parent' => $post->ID,
									'post_type' => 'attachment',
									'orderby' => 'menu_order',
									'post_mime_type' => 'image')
								);
								
								$fullimageurl = '';
								$cf_thumb2 = '';
								

								foreach ( $attachments as $att_id => $attachment ) {
									$getimage = wp_get_attachment_image_src($att_id, 'widget-portfolio', true);
									$fullimage = wp_get_attachment_image_src($att_id, 'full', true);
									$portfolioimage = $getimage[0];
									$cf_thumb2 ='<img src="'.$portfolioimage.'" alt="" />';
									$thethumblb = $portfolioimage;
									$fullimageurl = $fullimage[0];
								}
								
								//thumb image
								if(has_post_thumbnail($post->ID)){
									$cf_thumb = get_the_post_thumbnail($post->ID, 'widget-portfolio');
									$thumb_id = get_post_thumbnail_id($post->ID);
									$args = array(
										'post_type' => 'attachment',
										'post_status' => null,
										'include' => $thumb_id
									);
									$fullimage = wp_get_attachment_image_src($thumb_id, 'full', true);
									$fullimageurl = $fullimage[0];
									
									$thumbnail_image = get_posts($args);
									if ($thumbnail_image && isset($thumbnail_image[0])) {
										$cf_customdesc = $thumbnail_image[0]->post_content;
									}
								}else{
									$cf_thumb = $cf_thumb2;
								}
								
								//LIGHTBOX URL 
								$custom = get_post_custom($post->ID);
								$cf_lightboxurl = (isset($custom["lightbox-url"][0]) && $custom["lightbox-url"][0]!="")? $custom["lightbox-url"][0] : "";
								
								if($cf_lightboxurl != ""){
									$fullimageurl = $cf_lightboxurl;
								}
								
								$format = get_post_format($post->ID);
			
								if(($format=="video")||($format=="audio")){
									$lightboxrel = "";
									$fullimageurl = get_permalink();
								}else{
									$lightboxrel = "data-rel=prettyPhoto[mixed]";
								}
								
								
								$ids = get_the_ID();
								
								$addclass="";
							
								$catinfos = get_the_terms($post->ID,'category');
								$key = '';
								$separator = ', ';
								$quote = '&quot;';
								
							
									if($catinfos){
										foreach($catinfos as $catinfo){
											$key .= " ".$catinfo->slug;
										}
										$key = trim($key);
									}
									

								
								//PORTFOLIOID
								$template = str_replace( '%%ID%%', $post->ID, $template );
								
								//POST-DAY
								$postday  = '';
								$postday .= get_the_time( 'd' );
								$template   = str_replace( '%%DAY%%', $postday, $template );
								
								//POST-MONTH
								$postmonth  = '';
								$postmonth .= get_the_time('M');
								$template   = str_replace( '%%MONTH%', $postmonth, $template );
								
								//POST-YEAR
								$postyear  = '';
								$postyear .= get_the_time('Y');
								$template   = str_replace( '%%YEAR%', $postyear, $template );
									
								
								//PORTFOLIOCLASS
								$pfclass  = 'item ';
								$pfclass .= $itemclass.' ';
								$pfclass .= $key.' ';
								$pfclass .= $withimage;
								$template = str_replace( '%%CLASS%%', $pfclass, $template );
								
								//PORTFOLIOKEY
								$pfkey = $key;
								$template = str_replace( '%%KEY%%', $pfkey, $template );
								
								//PORTFOLIOFULLIMAGE
								$pffullimg = $fullimageurl;
								$template = str_replace( '%%FULLIMG%%', $pffullimg, $template );
								
								//LIGHTBOXREL
								$pflightbox = $lightboxrel;
								$template = str_replace( '%%LBOXREL%%', $pflightbox, $template );
								
								//PORTFOLIOIMGTITLE
								$pffullimgtitle = $cf_customdesc;
								$template = str_replace( '%%FULLIMGTITLE%%', $pffullimgtitle, $template );
								
								//PORTFOLIOLINK
								if($cf_custom_link !=""){
								$pflink = $cf_custom_link;
								}else{
								$pflink = get_permalink();
								}
								$template = str_replace( '%%LINK%%', $pflink, $template );
								
								//PORTFOLIOIMAGE
								$pfthumb = '';
								if($cf_thumb){
								$pfthumb .= '<div class="image">'.$cf_thumb.'</div>';
								}
								$template = str_replace( '%%THUMB%%', $pfthumb, $template );
	
								//PRICE
								$pfprice = '';
								$pfprice .= $cf_custom_price;
								$template = str_replace( '%%PRICE%%', $pfprice, $template );
	
								//TAGS
								$maintags = "";
								$posttags = get_the_tags();
								$count=0;
								if ($posttags) {
								  $maintags .= '<div class="tags">';
								  foreach($posttags as $tag) {
									$count++;
									if (1 == $count) {
									  $maintags .= $tag->name . ' ';
									}
								  }
								  $maintags .= '</div>' ; 
								}
								$template = str_replace( '%%TAG%%', $maintags, $template );
								
								//AllTAGS
								$alltags = '';
								$alltags = get_the_tag_list('<ul class="tags"><li>','</li><li>','</li></ul>');
								$template = str_replace( '%%ALLTAGS%%', $alltags, $template );
								
								
								//PORTFOLIOTITLE
								$pftitle  = '';
								$pftitle .= get_the_title();
								$template = str_replace( '%%TITLE%%', $pftitle, $template );
	
								//PORTFOLIOTEXT
								$pftext = '';
								if($longdesc>0){
									$excerpt = klasik_string_limit_char(get_the_excerpt(), $longdesc);
								}else{
									$excerpt = get_the_excerpt();
								}
								$pftext .= $excerpt;
								$template = str_replace( '%%TEXT%%', $pftext, $template );
								
								//PORTFOLIOCATEGORY
								$pfcat = '';
								$categories = get_the_category();
								$separator = ', ';
								if($categories){
									foreach($categories as $category) {
										$pfcat .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'klasik' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
									}
								}
								$template = str_replace( '%%CATEGORY%%', trim($pfcat, $separator), $template );
							

							$output .= $template;

							endwhile;
							
							//CAROUSEL
							if( $display == 'carousel'){ 
								$output .= '</ul>';
								$output .= '</div>';
							
							}
							
							$output .= '</div>';
							
							if( $display != 'carousel'){ 
								if($enablepagenum){
									ob_start();
									klasik_pagination();
									$output .='<div class="clear"></div>';
									$output .= '<div class="page-numbers-wrapper">'.ob_get_contents().'</div>';
									
									ob_end_clean();
								}
							}
						
							echo $output;
							

							
						endif;
						$wp_query = null; $wp_query = $temp; wp_reset_query();
						echo '<div class="clear"></div>';
					echo '</div>';
				?>


			
              <?php 
					echo '<div class="clear"></div></div>';
					
					if( $layout == 'fullwidth'){} else{
						echo '                        
						</div>
                    	</div>
                		</div>';
					}
					
				
					echo '<div class="clear"></div></div>';
					
					echo '<div class="clear"></div></div>';
					echo '<div class="clear"></div></div>';
			  
			  
			  echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
			
        $instance = $old_instance;
      
    	$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['subtitle'] 				= strip_tags($new_instance['subtitle']);
		$instance['category'] 				= isset($new_instance['category'])? $new_instance['category'] : "";
		$instance['display'] 				= strip_tags($new_instance['display']);
		
		$instance['cols'] 					= strip_tags($new_instance['cols']);
		$instance['showpost'] 				= strip_tags($new_instance['showpost']);
		$instance['longdesc'] 				= strip_tags($new_instance['longdesc']);
		$instance['customclass'] 			= strip_tags($new_instance['customclass']);
		$instance['enablepagenum'] 			= strip_tags($new_instance['enablepagenum']);
		
		$instance['show_advanced_option'] 	= isset($new_instance['show_advanced_option']) ? $new_instance['show_advanced_option'] : false;
		$instance['layout'] 				= strip_tags($new_instance['layout']);
		$instance['spacingtop'] 			= strip_tags($new_instance['spacingtop']);
		$instance['spacingbottom'] 			= strip_tags($new_instance['spacingbottom']);
		$instance['spacingside'] 			= strip_tags($new_instance['spacingside']);
		$instance['border_top'] 			= strip_tags($new_instance['border_top']);
		$instance['border_bottom'] 			= strip_tags($new_instance['border_bottom']);
		
		$instance['customize_background'] 	= isset($new_instance['customize_background']) ? $new_instance['customize_background'] : false;
		$instance['background_image'] 		= esc_url($new_instance['background_image']);
		$instance['background_color'] 		= strip_tags($new_instance['background_color']);
		$instance['background_repeat'] 		= strip_tags($new_instance['background_repeat']);
		$instance['background_position'] 	= strip_tags($new_instance['background_position']);
		$instance['background_attachment'] 	= strip_tags($new_instance['background_attachment']);
		$instance['background_size'] 		= strip_tags($new_instance['background_size']);
		$instance['background_opacity'] 	= strip_tags($new_instance['background_opacity']);

		
    	return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$instance['title'] = (isset($instance['title']))? $instance['title'] : "";
		$instance['subtitle'] = (isset($instance['subtitle']))? $instance['subtitle'] : "";
		$instance['category'] = (isset($instance['category']))? $instance['category'] : array();
		$instance['display'] = (isset($instance['display']))? $instance['display'] : "";

		$instance['cols'] = (isset($instance['cols']))? $instance['cols'] : "";
		$instance['showpost'] = (isset($instance['showpost']))? $instance['showpost'] : "";
		$instance['longdesc'] = (isset($instance['longdesc']))? $instance['longdesc'] : "";
		$instance['customclass'] = (isset($instance['customclass']))? $instance['customclass'] : "";

		$enablepagenum  = isset($instance['enablepagenum']) ? esc_attr($instance['enablepagenum']) : "";
		
		$show_advanced_option = isset($instance['show_advanced_option']) ? esc_attr($instance['show_advanced_option']) : "";
		$instance['layout'] 				= (isset($instance['layout']))? $instance['layout'] : "";
		$instance['spacingtop'] 			= (isset($instance['spacingtop']))? $instance['spacingtop'] : "";
		$instance['spacingbottom'] 			= (isset($instance['spacingbottom']))? $instance['spacingbottom'] : "";
		$instance['spacingside'] 			= (isset($instance['spacingside']))? $instance['spacingside'] : "";
		$instance['border_top'] 			= (isset($instance['border_top']))? $instance['border_top'] : "";
		$instance['border_bottom'] 			= (isset($instance['border_bottom']))? $instance['border_bottom'] : "";
		
		$customize_background = isset($instance['customize_background']) ? esc_attr($instance['customize_background']) : "";
		$instance['background_image'] 		= (isset($instance['background_image']))? $instance['background_image'] : "";
		$instance['background_color'] 		= (isset($instance['background_color']))? $instance['background_color'] : "";
		$instance['background_repeat'] 		= (isset($instance['background_repeat']))? $instance['background_repeat'] : "";
		$instance['background_position'] 	= (isset($instance['background_position']))? $instance['background_position'] : "";
		$instance['background_attachment'] 	= (isset($instance['background_attachment']))? $instance['background_attachment'] : "";
		$instance['background_size'] 		= (isset($instance['background_size']))? $instance['background_size'] : "";
		$instance['background_opacity'] 	= (isset($instance['background_opacity']))? $instance['background_opacity'] : "";

		
		
        $title = esc_attr($instance['title']);
		$subtitle = esc_attr($instance['subtitle']);
		$categories = $instance['category'];
		$display = esc_attr($instance['display']);

		$cols = esc_attr($instance['cols']);
		$showpost = esc_attr($instance['showpost']);
		$customclass = esc_attr($instance['customclass']);
		$longdesc = esc_attr($instance['longdesc']);

		
		$layout 				= esc_attr($instance['layout']);
		$spacingtop 			= esc_attr($instance['spacingtop']);
		$spacingbottom 			= esc_attr($instance['spacingbottom']);
		$spacingside 			= esc_attr($instance['spacingside']);
		$border_top 			= esc_attr($instance['border_top']);
		$border_bottom			= esc_attr($instance['border_bottom']);
		
		$background_image 		= esc_attr($instance['background_image']);
		$background_color 		= esc_attr($instance['background_color']);
		$background_repeat 		= esc_attr($instance['background_repeat']);
		$background_position 	= esc_attr($instance['background_position']);
		$background_attachment 	= esc_attr($instance['background_attachment']);
		$background_size 		= esc_attr($instance['background_size']);
		$background_opacity 	= esc_attr($instance['background_opacity']);

		
        ?>
        
        
			<style type="text/css">
                i { font-size:11px;}
            </style>
        
			<script type="text/javascript">				
				jQuery(document).ready(function($){
					$('.my-color-field').wpColorPicker();
				});
            </script>
        
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'klasik'); ?><br />
			<?php 
			$chkvalue = $categories;
			
			$portcategories = get_categories();
			$returnstring = '';
			foreach($portcategories as $category){
				$checkedstr="";
				if(in_array($category->slug,$chkvalue)){
					$checkedstr = 'checked="checked"';
				}
				$returnstring .= '<div style="float:left;width:48%;">';
				$returnstring .= '<label for="'. $this->get_field_id('category')."-". $category->slug .'">';
					$returnstring .= '<input type="checkbox" value="'. $category->slug .'" name="'. $this->get_field_name('category'). '['.$category->slug.']" id="'. $this->get_field_id('category')."-". $category->slug . '" '.$checkedstr.' />&nbsp;&nbsp;'. $category->name;
				$returnstring .= '</label>';
				$returnstring .= '</div>';
			}
			$returnstring .= '<div style="clear:both;"></div>';
			
			echo $returnstring;
			?>
			</label></p>
            <p><label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display:', 'klasik'); ?></label><br />
            <select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" class="widefat" style="width:50%;">
				<?php foreach($this->get_display_options() as $k => $v ) { ?>
                    <option <?php selected( $instance['display'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>      
            </select></p>
                        
            <p><label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Number of Columns:', 'klasik'); ?></label><br />
            <select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" class="widefat" style="width:50%;">
				<?php foreach($this->get_number_options() as $k => $v ) { ?>
                    <option <?php selected( $instance['cols'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>      
            </select></p>
            
            <?php if( $display != 'filterable'){?>
            <p><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Number of Post:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="text" value="<?php echo $showpost; ?>" /></label></p>
            <?php } ?>
            <p><label for="<?php echo $this->get_field_id('longdesc'); ?>"><?php _e('Length of Description Text:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('longdesc'); ?>" name="<?php echo $this->get_field_name('longdesc'); ?>" type="text" value="<?php echo $longdesc; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('customclass'); ?>"><?php _e('Custom Class:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('customclass'); ?>" name="<?php echo $this->get_field_name('customclass'); ?>" type="text" value="<?php echo $customclass; ?>" /></label></p>
            
			<?php if( $display != 'filterable' && $display != 'carousel'){?>
            <p>
		
            <input type="checkbox" name="<?php echo $this->get_field_name('enablepagenum'); ?>" id="<?php echo $this->get_field_id('enablepagenum'); ?>" <?php if($enablepagenum == "on") echo " checked='checked'"; ?>/>			
            <label for="<?php echo $this->get_field_id('enablepagenum'); ?>"><?php _e('Enable Paging', 'klasik'); ?> </label></p>
            <?php } ?>
            
            <p>
                <input name="<?php echo $this->get_field_name('show_advanced_option'); ?>" id="<?php echo $this->get_field_id('show_advanced_option'); ?>" type="checkbox" <?php if($show_advanced_option == "on") echo " checked='checked'"; ?> onchange="showAdvancedOps(this)"/>					
                <label for="<?php echo $this->get_field_id('show_advanced_option'); ?>"><?php _e(' Show Advanced Option', 'klasik'); ?> </label>
            </p>   
            
            <div <?php if ( $show_advanced_option == false ) { echo 'style="display:none;"'; } ?> class="hidden_options">         
            
                <p>
                <label for="<?php echo $this->get_field_id('layout'); ?>"><?php _e('Layout Type:', 'klasik'); ?></label><br />
                <select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>" class="widefat" style="width:50%;">
                    <?php foreach($this->get_layout_options() as $k => $v ) { ?>
                        <option <?php selected( $instance['layout'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                    <?php } ?>      
                </select></p>
    
                <p>
                <label for="<?php echo $this->get_field_id('spacingtop'); ?>"><?php _e('Spacing Top:', 'klasik'); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('spacingtop'); ?>" name="<?php echo $this->get_field_name('spacingtop'); ?>" type="text" value="<?php echo $spacingtop; ?>" /></label>
                <i><?php _e('example: 10px', 'klasik'); ?> </i></p>
                
                <p>
                <label for="<?php echo $this->get_field_id('spacingbottom'); ?>"><?php _e('Spacing Bottom:', 'klasik'); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('spacingbottom'); ?>" name="<?php echo $this->get_field_name('spacingbottom'); ?>" type="text" value="<?php echo $spacingbottom; ?>" /></label>
                <i><?php _e('example: 10px', 'klasik'); ?> </i></p>
                
                <p>
                <label for="<?php echo $this->get_field_id('spacingside'); ?>"><?php _e('Spacing Side:', 'klasik'); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('spacingside'); ?>" name="<?php echo $this->get_field_name('spacingside'); ?>" type="text" value="<?php echo $spacingside; ?>" /></label>
                <i><?php _e('example: 10px', 'klasik'); ?> </i></p>
    
                <p>
                <label for="<?php echo $this->get_field_id('border_top'); ?>"><?php _e('Separator Top:', 'klasik'); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('border_top'); ?>" name="<?php echo $this->get_field_name('border_top'); ?>" type="text" value="<?php echo $border_top; ?>" /></label>
                <i><?php _e('example: 1px solid #000000', 'klasik'); ?> </i></p>
    
    
                <p>
                <label for="<?php echo $this->get_field_id('border_bottom'); ?>"><?php _e('Separator Bottom:', 'klasik'); ?> 
                <input class="widefat" id="<?php echo $this->get_field_id('border_bottom'); ?>" name="<?php echo $this->get_field_name('border_bottom'); ?>" type="text" value="<?php echo $border_bottom; ?>" /></label>
                <i><?php _e('example: 1px solid #000000', 'klasik'); ?> </i></p>
            </div><!-- end Show Advanced Option -->  
            
            <div <?php if ( $show_advanced_option == false ) { echo 'style="display:none;"'; } ?> class="hidden_options">

                <p>
                    <input name="<?php echo $this->get_field_name('customize_background'); ?>" id="<?php echo $this->get_field_id('customize_background'); ?>" type="checkbox" <?php if($customize_background == "on") echo " checked='checked'"; ?> onchange="showFeaturedImageOps(this)"/>					
                    <label for="<?php echo $this->get_field_id('customize_background'); ?>"><?php _e(' Customize Background', 'klasik'); ?> </label>
                </p>
                
                <div <?php if ( $customize_background == false ) { echo 'style="display:none;"'; } ?> class="hidden_options">
                
                    <p>
                    <label for="<?php echo $this->get_field_id('background_image'); ?>"><?php _e('Background Image URL:', 'klasik'); ?> 
                    <input class="widefat" id="<?php echo $this->get_field_id('background_image'); ?>" name="<?php echo $this->get_field_name('background_image'); ?>" type="text" value="<?php echo $background_image; ?>" />
                    </label></p>
                    
                    <div>
                  		
                        <label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color:', 'klasik'); ?></label> <br />
                        <input class="widefat my-color-field" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" style="width:20%;" value="<?php echo $background_color; ?>" />
                        
                    </div>
                    
                    <p>
                    <label for="<?php echo $this->get_field_id('background_opacity'); ?>"><?php _e('Background Color Opacity:', 'klasik'); ?></label><br />
                    <select id="<?php echo $this->get_field_id('background_opacity'); ?>" name="<?php echo $this->get_field_name('background_opacity'); ?>" class="widefat" style="width:50%;">
                        <?php foreach($this->get_bg_opacity_options() as $k => $v ) { ?>
                            <option <?php selected( $instance['background_opacity'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php } ?>      
                    </select></p> 
                    
                    <p>
                    <label for="<?php echo $this->get_field_id('background_repeat'); ?>"><?php _e('Background Repeat:', 'klasik'); ?></label><br />
                    <select id="<?php echo $this->get_field_id('background_repeat'); ?>" name="<?php echo $this->get_field_name('background_repeat'); ?>" class="widefat" style="width:50%;">
                        <?php foreach($this->get_bg_repeat_options() as $k => $v ) { ?>
                            <option <?php selected( $instance['background_repeat'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php } ?>      
                    </select></p> 
                    
                    <p>
                    <label for="<?php echo $this->get_field_id('background_position'); ?>"><?php _e('Background Position:', 'klasik'); ?></label><br />
                    <select id="<?php echo $this->get_field_id('background_position'); ?>" name="<?php echo $this->get_field_name('background_position'); ?>" class="widefat" style="width:50%;">
                        <?php foreach($this->get_bg_position_options() as $k => $v ) { ?>
                            <option <?php selected( $instance['background_position'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php } ?>      
                    </select></p> 
                    
                    <p>
                    <label for="<?php echo $this->get_field_id('background_attachment'); ?>"><?php _e('Background Attachment:', 'klasik'); ?></label><br />
                    <select id="<?php echo $this->get_field_id('background_attachment'); ?>" name="<?php echo $this->get_field_name('background_attachment'); ?>" class="widefat" style="width:50%;">
                        <?php foreach($this->get_bg_attachment_options() as $k => $v ) { ?>
                            <option <?php selected( $instance['background_attachment'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php } ?>      
                    </select></p> 
                    
                    <p>
                    <label for="<?php echo $this->get_field_id('background_size'); ?>"><?php _e('Background Size:', 'klasik'); ?></label><br />
                    <select id="<?php echo $this->get_field_id('background_size'); ?>" name="<?php echo $this->get_field_name('background_size'); ?>" class="widefat" style="width:50%;">
                        <?php foreach($this->get_bg_size_options() as $k => $v ) { ?>
                            <option <?php selected( $instance['background_size'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php } ?>      
                    </select></p> 
                </div><!-- end Enable Background -->  
                  
			</div><!-- end Show Advanced Option -->  
            
            
        <?php
    }
	
	

	protected function get_bg_repeat_options (){
		return array(
			'default' 			=> __( 'Default', 'klasik' ),	
			'repeat' 			=> __( 'Repeat', 'klasik' ),	
			'repeat-x'			=> __( 'Repeat Horizontal', 'klasik' ),	
			'repeat-y'			=> __( 'Repeat Vertical', 'klasik' ),	
			'no-repeat'			=> __( 'No Repeat', 'klasik' )
		);
	} // End get_bg_repeat_options()
	
	
	protected function get_bg_position_options (){
		return array(
			'default' 			=> __( 'Default', 'klasik' ),
			'left' 				=> __( 'Left', 'klasik' ),
			'center' 			=> __( 'Center', 'klasik' ),
			'right' 			=> __( 'Right', 'klasik' ),
			'top left' 			=> __( 'Top', 'klasik' ),
			'top center' 		=> __( 'Top Center', 'klasik' ),
			'top right' 		=> __( 'Top Right', 'klasik' ),
			'bottom left' 		=> __( 'Bottom', 'klasik' ),
			'bottom center' 	=> __( 'Bottom Center', 'klasik' ),
			'bottom right' 		=> __( 'Bottom Right', 'klasik' )
		);
	}  // End get_bg_position_options()
	
	
	protected function get_bg_attachment_options () {
		return array(
			'default' 		=> __( 'Default', 'klasik' ),		
			'scroll' 		=> __( 'scroll', 'klasik' ),
			'fixed' 		=> __( 'fixed', 'klasik' )
		);
	} // End get_bg_attachment_options()
	
	protected function get_bg_size_options () {
		return array(
			'default' 		=> __( 'Default', 'klasik' ),		
			'auto' 			=> __( 'auto', 'klasik' ),
			'cover' 		=> __( 'cover', 'klasik' ),
			'contain' 		=> __( 'contain', 'klasik' )
		);
	} // End get_bg_attachment_options()
	
	protected function get_bg_opacity_options () {
		return array(
			'default' 		=> __( 'Default', 'klasik' ),
			'0.1' 			=> __( '10%', 'klasik' ),		
			'0.2' 			=> __( '20%', 'klasik' ),
			'0.3' 			=> __( '30%', 'klasik' ),
			'0.4' 			=> __( '40%', 'klasik' ),
			'0.5' 			=> __( '50%', 'klasik' ),
			'0.6' 			=> __( '60%', 'klasik' ),
			'0.7' 			=> __( '70%', 'klasik' ),
			'0.8' 			=> __( '80%', 'klasik' ),
			'0.9' 			=> __( '90%', 'klasik' ),
			'1' 			=> __( '100%', 'klasik' )
		);
	} // End get_bg_opacity_options()
	
	
	protected function get_layout_options () {
		return array(
					'boxed' 			=> __( 'Boxed', 'klasik' ),
					'fullwidth' 		=> __( 'Full Width', 'klasik' )		
					
					);
	} // End get_layout_options()
	
	protected function get_display_options () {
		return array(
					'default' 			=> __( 'Default', 'klasik' ),		
					'filterable' 		=> __( 'Filterable', 'klasik' ),
					'carousel' 			=> __( 'Carousel', 'klasik' )
					);
	} // End get_display_options()

	
	protected function get_number_options () {
		return array(
					'1' 			=> __( '1 Column', 'klasik' ),		
					'2' 			=> __( '2 Column', 'klasik' ),
					'3' 			=> __( '3 Column', 'klasik' ),
					'4' 			=> __( '4 Column', 'klasik' ),
					'5' 			=> __( '5 Column', 'klasik' ),
					'6' 			=> __( '6 Column', 'klasik' )
					);
	} // End get_number_options()


} // class  Widget