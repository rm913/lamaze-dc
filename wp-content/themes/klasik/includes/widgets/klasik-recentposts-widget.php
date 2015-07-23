<?php
// =============================== Klasik Recent Posts widget ======================================
class Klasik_RecentPostsWidget extends WP_Widget {
    /** constructor */

	function Klasik_RecentPostsWidget() {
		$widget_ops = array('classname' => 'widget_klasik_recentposts', 'description' => __('KlasikThemes Recent Posts','klasik') );
		$this->WP_Widget('klasik-recentposts-widget', __('KlasikThemes Recent Posts','klasik'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title 					= apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$subtitle 				= apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle']);
		$category 				= apply_filters('widget_category', $instance['category']);
		$cols 					= apply_filters('widget_cols', empty($instance['cols']) ? '' : $instance['cols']);
		$showposts 				= apply_filters('widget_showpost', empty($instance['showpost']) ? '' : $instance['showpost']);
		$longdesc 				= apply_filters('widget_longdesc', empty($instance['longdesc']) ? '' : $instance['longdesc']);
		$customclass 			= apply_filters('widget_customclass', empty($instance['customclass']) ? '' : $instance['customclass']);
		
		$disableimage 			= isset($instance['disableimage']) ? $instance['disableimage'] : false;
		$disabledate 			= isset($instance['disabledate']) ? $instance['disabledate'] : false;
		$disabletext 			= isset($instance['disabletext']) ? $instance['disabletext'] : false;
		$disablemore 			= isset($instance['disablemore']) ? $instance['disablemore'] : false;
		
		$readmoretext 			= apply_filters('widget_readmoretext', empty($instance['readmoretext']) ? '' : $instance['readmoretext']);
		$orderby 				= apply_filters('widget_orderby', empty($instance['orderby']) ? '' : $instance['orderby']);
		$order 					= apply_filters('widget_order', empty($instance['order']) ? '' : $instance['order']);
		
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
		
		$instance['category'] = esc_attr(isset($instance['category'])? $instance['category'] : "");
		global $wp_query;

		$longdesc = (!is_numeric($longdesc) || empty($longdesc))? 0 : $longdesc;
		$showposts = (!is_numeric($showposts))? get_option('posts_per_page') : $showposts;
		
		$cols = intval($cols);
		
		if(!is_numeric($cols) || $cols < 1 || $cols > 6){
			$cols = 4;
		}
		
        if ( $customclass ) {
            $before_widget = str_replace('class="', 'class="'. $customclass . ' ', $before_widget);
        }  
		
        			 echo $before_widget; 
					 
					
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
					 
					 echo '<div class="klasik-recentpost-widget-wrapper"  style="'.$spacing_left_right.'">';
					
					$subtitlewrap ="";
					if($subtitle){
					$subtitlewrap ='<span class="widget-subtitle-wrap"><span class="widget-subtitle">'.$subtitle.'</span><span class="line"></span></span>';
					}
					$titleline='<span class="line-wrap"><span class="line"></span></span>';
					
					
					if ( $title!='' )
					echo $before_title . esc_html($title). $subtitlewrap . $titleline . $after_title;

						
					$output = "";

					$output .='<div class="klasik-recentpost-widget '.$customclass.'">';
						$output .='<div class="row">';

							if($cols==1){
								$colclass = "twelve";
							}elseif($cols==2){
								$colclass = "one_half";
							}elseif($cols==3){
								$colclass = "one_third";
							}elseif($cols==4){	
								$colclass = "one_fourth";
							}elseif($cols==5){
								$colclass = "one_fifth";
							}elseif($cols==6){
								$colclass = "one_sixth";
							}
							
							$temp = $wp_query;
							$wp_query= null;
							$wp_query = new WP_Query();
							$args = array(
								"post_type" => "post",
								"ignore_sticky_posts" => true,
								"showposts" => $showposts,
								"orderby" => $orderby,
								"order" => $order
							);
							
							if($category == 0) $category = "";
							if( $category!="" ){
								$args['tax_query'] = array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => $category
									)
								);
							}
							
							$wp_query->query($args);
							global $post;
							
							if ($wp_query->have_posts()) : 
								$x = 0;
								while ($wp_query->have_posts()) : $wp_query->the_post(); 
								
								$custom = get_post_custom($post->ID);
								$cf_thumb = get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'alignleft'));
								
			
								$x++;
								
								if($x%$cols==0){
									$omega = "omega";
								}elseif($x%$cols==1){
									$omega = "alpha";
								}else{
									$omega = "";
								}
			
								
								$output .='<div class="'.$colclass.' columns '.$omega.'">';
									$output .='<div class="recent-item">';
									
									$custom = get_post_custom($post->ID);
									
									if(has_post_thumbnail($post->ID) ){
										$thumb = get_the_post_thumbnail($post->ID, 'widget-post', array('class' => 'frame'));
									}else{
										$thumb ="";
									}
									
									if($thumb!="" && !$disableimage){
										$output .= '<div class="recent-thumb">'.$thumb.'</div>';
									}
									

									$output .= '<h3 class="recent-title"><a href="'.get_permalink().'">'. get_the_title().'</a></h3>';
									if(!$disabledate){
										$output .= '<span class="smalldate">'. get_the_date() .'</span>';
									}
									$output .= '<div class="sep"></div>';

									if(!$disabletext){
									$output.='<div class="recent-text">';
										if($longdesc>0){
											$excerpt = klasik_string_limit_char(get_the_excerpt(), $longdesc);
										}else{
											$excerpt = get_the_excerpt();
										}
										$output.= $excerpt;
									$output.='</div>';
									}
									
									if(!$disablemore){
									$output.='<div class="recent-link">';
										if($readmoretext==''){
											$moretext = __('Read More','klasik');
										}else{
											$moretext = $readmoretext;
										}
										$output.= '<a href="'.get_permalink().'" class="more-link">'.$moretext.'</a>';
									$output.='</div>';
									}
									$output.='<div class="clear"></div>';
									
									$output.='</div>';
								$output .='</div>';
			
								endwhile;
						
							endif;
							$wp_query = null; $wp_query = $temp; wp_reset_query();
						$output .='</div>';
						$output.='<div class="clear"></div>';
					$output .='</div>';
						 
					echo do_shortcode($output);
					
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
					
					echo $after_widget; 

    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
				
        $instance = $old_instance;
    
		
    	$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['subtitle'] 				= strip_tags($new_instance['subtitle']);
		$instance['category'] 				= strip_tags($new_instance['category']);
		$instance['cols'] 					= strip_tags($new_instance['cols']);
		$instance['showpost'] 				= strip_tags($new_instance['showpost']);
		$instance['longdesc'] 				= strip_tags($new_instance['longdesc']);
		$instance['customclass'] 			= strip_tags($new_instance['customclass']);

		
		$instance['disableimage'] 			= isset($new_instance['disableimage']) ? $new_instance['disableimage'] : false;
		$instance['disabledate'] 			= isset($new_instance['disabledate']) ? $new_instance['disabledate'] : false;
		$instance['disabletext']			= isset($new_instance['disabletext']) ? $new_instance['disabletext'] : false;
		$instance['disablemore']			= isset($new_instance['disablemore']) ? $new_instance['disablemore'] : false;
		
		
		$instance['readmoretext'] 			= strip_tags($new_instance['readmoretext']);
		$instance['orderby'] 				= strip_tags($new_instance['orderby']);
		$instance['order'] 					= strip_tags($new_instance['order']);
		
		
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
		$instance['title'] 			= (isset($instance['title']))? $instance['title'] : "";
		$instance['subtitle'] 		= (isset($instance['subtitle']))? $instance['subtitle'] : "";
		$instance['category'] 		= (isset($instance['category']))? $instance['category'] : "";
		$instance['cols'] 			= (isset($instance['cols']))? $instance['cols'] : "";
		$instance['showpost'] 		= (isset($instance['showpost']))? $instance['showpost'] : "";
		$instance['longdesc'] 		= (isset($instance['longdesc']))? $instance['longdesc'] : "";
		$instance['customclass'] 	= (isset($instance['customclass']))? $instance['customclass'] : "";
		$instance['disableimage'] 	= (isset($instance['disableimage']))? $instance['disableimage'] : "";
		$instance['disabledate'] 	= (isset($instance['disabledate']))? $instance['disabledate'] : "";
		$instance['disabletext'] 	= (isset($instance['disabletext']))? $instance['disabletext'] : "";
		$instance['disablemore'] 	= (isset($instance['disablemore']))? $instance['disablemore'] : "";
		$instance['readmoretext'] 	= (isset($instance['readmoretext']))? $instance['readmoretext'] : "";
		$instance['orderby'] 		= (isset($instance['orderby']))? $instance['orderby'] : "";
		$instance['order'] 			= (isset($instance['order']))? $instance['order'] : "";
		
		
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
					
        $title 				= esc_attr($instance['title']);
		$subtitle 			= esc_attr($instance['subtitle']);
		$category 			= esc_attr($instance['category']);
		$cols 				= esc_attr($instance['cols']);
		$longdesc 			= esc_attr($instance['longdesc']);
		$customclass 		= esc_attr($instance['customclass']);
		$showpost 			= esc_attr($instance['showpost']);
		$disableimage 		= esc_attr($instance['disableimage']);
		$disabledate 		= esc_attr($instance['disabledate']);
		$disabletext 		= esc_attr($instance['disabletext']);
		$disablemore 		= esc_attr($instance['disablemore']);
		$readmoretext 		= esc_attr($instance['readmoretext']);
		$orderby 			= esc_attr($instance['orderby']);
		$order 				= esc_attr($instance['order']);
		
		
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
			$args = array(
			'selected'         => $category,
			'show_option_all'  => 'All Categories',
			'echo'             => 1,
			'name'             =>$this->get_field_name('category')
			);
			wp_dropdown_categories( $args );
			?>
			</label></p>
            
            
            <p><label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Number of Columns:', 'klasik'); ?></label><br />
            <select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" class="widefat" style="width:50%;">
				<?php foreach($this->get_number_options() as $k => $v ) { ?>
                    <option <?php selected( $instance['cols'], $k); ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>      
            </select></p>
            
            <p><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Number of Post:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="text" value="<?php echo $showpost; ?>" /></label></p>
            
            <p><label for="<?php echo $this->get_field_id('longdesc'); ?>"><?php _e('Length of Description Text:', 'klasik'); ?> <input class="widefat" id="<?php echo $this->get_field_id('longdesc'); ?>" name="<?php echo $this->get_field_name('longdesc'); ?>" type="text" value="<?php echo $longdesc; ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:', 'klasik'); ?> </label>
            <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
			<?php foreach ( $this->get_orderby_options() as $k => $v ) { ?>
				<option value="<?php echo $k; ?>"<?php selected( $instance['orderby'], $k ); ?>><?php echo $v; ?></option>
			<?php } ?>
			</select>
            </p>

            <p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'klasik'); ?> 
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>">
			<?php foreach ( $this->get_order_options() as $k => $v ) { ?>
				<option value="<?php echo $k; ?>"<?php selected( $instance['order'], $k ); ?>><?php echo $v; ?></option>
			<?php } ?>
			</select>
            </p>

            <p><label for="<?php echo $this->get_field_id('customclass'); ?>"><?php _e('Custom Class:', 'klasik'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('customclass'); ?>" name="<?php echo $this->get_field_name('customclass'); ?>" type="text" value="<?php echo $customclass; ?>" /></label></p>
            
            <p>
			
            <input type="checkbox" name="<?php echo $this->get_field_name('disableimage'); ?>" id="<?php echo $this->get_field_id('disableimage'); ?>"  <?php if($disableimage == "on") echo " checked='checked'"; ?> />			
            <label for="<?php echo $this->get_field_id('disableimage'); ?>"><?php _e('Disable Image', 'klasik'); ?> </label></p>
            
            <p>
		
            <input type="checkbox" name="<?php echo $this->get_field_name('disabledate'); ?>" id="<?php echo $this->get_field_id('disabledate'); ?>"  <?php if($disabledate == "on") echo " checked='checked'"; ?> />			
            <label for="<?php echo $this->get_field_id('disabledate'); ?>"><?php _e('Disable Date', 'klasik'); ?> </label></p>
            
            <p>
			
            <input type="checkbox" name="<?php echo $this->get_field_name('disabletext'); ?>" id="<?php echo $this->get_field_id('disabletext'); ?>"  <?php if($disabletext == "on") echo " checked='checked'"; ?> />			
            <label for="<?php echo $this->get_field_id('disabletext'); ?>"><?php _e('Disable Text', 'klasik'); ?> </label></p>
      		
            <p> 
		
            <input type="checkbox" name="<?php echo $this->get_field_name('disablemore'); ?>" id="<?php echo $this->get_field_id('disablemore'); ?>"  <?php if($disablemore == "on") echo " checked='checked'"; ?> />			
            <label for="<?php echo $this->get_field_id('disablemore'); ?>"><?php _e('Disable More Text', 'klasik'); ?></label></p>
        	
            <p><label for="<?php echo $this->get_field_id('readmoretext'); ?>"><?php _e('Read More Text', 'klasik'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('readmoretext'); ?>" name="<?php echo $this->get_field_name('readmoretext'); ?>" type="text" value="<?php echo $readmoretext; ?>" /> </label></p>


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
	
	protected function get_orderby_options () {
		return array(
					'date' 			=> __( 'Date', 'klasik' ),		
					'title' 		=> __( 'Title', 'klasik' ),
					'rand' 			=> __( 'Random Order', 'klasik' ),
					'none' 			=> __( 'No Order', 'klasik' )
					);
	} // End get_orderby_options()


	protected function get_order_options () {
		return array(
					'DESC' 			=> __( 'Descending', 'klasik' ),
					'ASC' 			=> __( 'Ascending', 'klasik' )
					);
	} // End get_order_options()

} // class  Widget