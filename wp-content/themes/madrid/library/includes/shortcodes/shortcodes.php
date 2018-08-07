<?php

include_once('available.php');
// Your content to test
/**
 * Shortcode: Columns
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */




function code125_1_12($atts, $content = null) {
    return '<div class="span1">' . do_shortcode($content) . '</div>';
}

function code125_2_12($atts, $content = null) {
    return '<div class="span2">' . do_shortcode($content) . '</div>';
}

function code125_3_12($atts, $content = null) {
    return '<div class="span3">' . do_shortcode($content) . '</div>';
}

function code125_4_12($atts, $content = null) {
    return '<div class="span4">' . do_shortcode($content) . '</div>';
}

function code125_5_12($atts, $content = null) {
    return '<div class="span5">' . do_shortcode($content) . '</div>';
}

function code125_6_12($atts, $content = null) {
    return '<div class="span6">' . do_shortcode($content) . '</div>';
}

function code125_7_12($atts, $content = null) {
    return '<div class="span7">' . do_shortcode($content) . '</div>';
}

function code125_8_12($atts, $content = null) {
    return '<div class="span8">' . do_shortcode($content) . '</div>';
}

function code125_9_12($atts, $content = null) {
    return '<div class="span9">' . do_shortcode($content) . '</div>';
}

function code125_10_12($atts, $content = null) {
    return '<div class="span10">' . do_shortcode($content) . '</div>';
}

function code125_11_12($atts, $content = null) {
    return '<div class="span11">' . do_shortcode($content) . '</div>';
}

function code125_12_12($atts, $content = null) {
    return '<div class="span12">' . do_shortcode($content) . '</div>';
}

function code125_row($atts, $content = null) {
    return '<div class="row">' . do_shortcode($content) . '</div>';
}

function code125_row_fluid($atts, $content = null) {
    return '<div class="row-fluid">' . do_shortcode($content) . '</div>';
}

function code125_text($atts, $content = null) {
    return   html_entity_decode (do_shortcode( html_entity_decode($content)) );
}


function code125_float_left($atts, $content = null) {
    return   '<div class="float_left">' .html_entity_decode (do_shortcode( html_entity_decode($content)) ) . '</div>';
}

function code125_float_right($atts, $content = null) {
    return   '<div class="float_right">' . html_entity_decode (do_shortcode( html_entity_decode($content)) ) . '</div>';
}

function code125_is_mobile($atts, $content = null) {
    $data = '';
    if( is_mobile() ){
    	$data =   html_entity_decode (do_shortcode( html_entity_decode($content)) );
	}
	return $data;
}

function code125_is_tablet($atts, $content = null) {
    $data = '';
    if( is_tablet() ){
    	$data =   html_entity_decode (do_shortcode( html_entity_decode($content)) );
	}
	return $data;
}

function code125_is_handheld($atts, $content = null) {
    $data = '';
    if( is_handheld() ){
    	$data =   html_entity_decode (do_shortcode( html_entity_decode($content)) );
	}
	return $data;
}

function code125_is_desktop($atts, $content = null) {
    $data = '';
    if( !is_handheld() ){
    	$data =   html_entity_decode (do_shortcode( html_entity_decode($content)) );
	}
	return $data;
}



/**
 * Shortcode: tab
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */


function code125_tab($atts, $content) {
    $atts = shortcode_atts(array(
        'title' => 'Tab %d',
        'icon' => ''    ), $atts);

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array('title' => sprintf($atts['title'], $GLOBALS['tab_count']), 'content' => $content , 'icon' => $atts['icon']);

    $GLOBALS['tab_count']++;
}

	

/**
 * Shortcode: tabgroup
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_tabgroup($atts, $content) {
    $GLOBALS['tab_count'] = 0;
	unset($GLOBALS['tabs']);
    do_shortcode($content);

    if (is_array($GLOBALS['tabs'])) {
    	$counter = 1;
        $tabs ='';
        $panes = '';
        foreach ($GLOBALS['tabs'] as $tab) {
        	if($counter == 1){
            $tabs = $tabs .'<li class="first_li"><a class="'.$tab['icon'].'" href="#">' . $tab['title'] . '</a></li>';
            $panes = $panes . '<div class="custom_tabs_content clearfix">' . do_shortcode($tab['content']) . '</div>';
            }else{
            $tabs = $tabs . '<li><a class="'.$tab['icon'].'" href="#">' . $tab['title'] . '</a></li>';
            $panes = $panes . '<div class="custom_tabs_content clearfix">' . do_shortcode($tab['content']) . '</div>';
            }
            $counter++;
        }
        $return = '<ul class="custom_tabs">' .  $tabs . '</ul><div class="custom_tabs_wrap">' .  $panes . '</div>' . "\n";
    }
    return $return;
}



/**
 * Shortcode: fancy_tabgroup
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_fancy_tabgroup($atts, $content) {
    $GLOBALS['fancy_tab_count'] = 0;
	unset($GLOBALS['fancy_tabs']);
    do_shortcode($content);

    if (is_array($GLOBALS['fancy_tabs'])) {
        $tabs = '';
        $panes = '';
        foreach ($GLOBALS['fancy_tabs'] as $tab) {
        	if($tab['icon']!='' && $tab['icon']!='none'){
        		$icon = '<span class="side-menu-icon '.$tab['icon'].'"></span>';
        	}else {
        		$icon = '';
        	}
        
            $tabs = $tabs . '<li class="clearfix"><a class="clearfix" href="#">' . $icon . '<span class="a_text">' . $tab['title'] . '</span></a></li>';
            $panes = $panes . '<div class="custom_tabs2_content clearfix">' . do_shortcode($tab['content']) . '</div>';
        }
        $return = "\n" . '<div class="custom_tabs2_container"><div class="left_tabs"><ul class="custom_tabs2">' .  $tabs . '</ul></div><div class="custom_tabs2_wrap">' .  $panes . '</div></div>' . "\n";
    }
    return $return;
}

/**
 * Shortcode: fancy_tab
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_fancy_tab($atts, $content) {
    $atts = shortcode_atts(array('title' => 'Tab %d','icon'=>''), $atts);

    $x = $GLOBALS['fancy_tab_count'];
    $GLOBALS['fancy_tabs'][$x] = array('title' => sprintf($atts['title'], $GLOBALS['fancy_tab_count']), 'content' => $content , 'icon'=>$atts['icon']);

    $GLOBALS['fancy_tab_count']++;
}



/**
 * Shortcode: fancy_tabgroup_posts
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_fancy_tabgroup_posts($atts, $content) {
    $GLOBALS['fancy_tab_post_count'] = 0;
	unset($GLOBALS['fancy_tabs_posts']);
    do_shortcode($content);

    if (is_array($GLOBALS['fancy_tabs_posts'])) {
        $tabs = '';
        $panes = '';
        foreach ($GLOBALS['fancy_tabs_posts'] as $tab) {
        	$type = get_post_type($tab['id']);
        	query_posts('p=' . $tab['id'] . '&post_type=' . $type . '');
        	
        	
        	while (have_posts()) : the_post();
        	
        	if($tab['icon']!='' && $tab['icon']!='none'){
        		$icon = '<span class="side-menu-icon '.$tab['icon'].'"></span>';
        	}else {
        		$icon = '';
        	}
        	
            $tabs = $tabs . '<li class="clearfix"><a class="clearfix" href="#">' . $icon . '<span class="a_text">' . get_the_title(). '</span></a></li>';
            
            ob_start();
            the_content();
            $the_content = ob_get_contents();
            ob_end_clean();
            
            $panes = $panes . '<div class="custom_tabs2_content clearfix">' . $the_content . '</div>';
            
            endwhile;
            wp_reset_query();
        }
        $return = "\n" . '<div class="custom_tabs2_container"><div class="left_tabs"><ul class="custom_tabs2">' .  $tabs . '</ul></div><div class="custom_tabs2_wrap">' .  $panes . '</div></div>' . "\n";
    }
    return $return;
}

/**
 * Shortcode: fancy_tab_post
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_fancy_tab_post($atts, $content) {
    $atts = shortcode_atts(array('id' => '','icon'=>''), $atts);

    $x = $GLOBALS['fancy_tab_post_count'];
    $GLOBALS['fancy_tabs_posts'][$x] = array('id' => sprintf($atts['id'], $GLOBALS['fancy_tab_post_count']),  'icon'=>$atts['icon']);

    $GLOBALS['fancy_tab_post_count']++;
}



/**
 * Shortcode: accordiongroup
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_accordiongroup($atts, $content) {
    $GLOBALS['accordion_count'] = 0;
    	unset($GLOBALS['accordion']);
        do_shortcode($content);
        $counter = 0;
        $tabs = '';
        if (is_array($GLOBALS['accordion'])) {
            foreach ($GLOBALS['accordion'] as $tab) {
                if ($counter == 0)
                    $tabs = $tabs . '<h2  class="current first"><span class="icon-plus-1"></span>' . $tab['title'] . '</h2><div class="pane" style="display:block;">' . $tab['content'] . '</div>';
                else
                     $tabs = $tabs . '<h2><span class="icon-plus-1"></span>' . $tab['title'] . '</h2><div class="pane" style="display:none">' . $tab['content'] . '</div>';
                $counter++;
            }
            $return = "\n" . '<!-- the accordion tabs --><div class="accordion">' . $tabs . '</div>' . "\n";
        }
        return $return;
}

/**
 * Shortcode: accordion
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_accordion($atts, $content) {
    $atts = shortcode_atts(array('title' => 'Tab %d'), $atts);
    
        $x = $GLOBALS['accordion_count'];
        $GLOBALS['accordion'][$x] = array('title' => sprintf($atts['title'], $GLOBALS['accordion_count']), 'content' => $content);
    
        $GLOBALS['accordion_count']++;
}
/**
 * Shortcode: toggle
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_toggle($atts, $content = null) {
    $atts = shortcode_atts(array('title' => 'Click To Open'), $atts);
    
    
    $data = '<div class="toggle"><h3 class="clearfix"><span class="icon-plus-1"></span><a href="#">'.$atts['title'].'</a></h3><div class="content">'.do_shortcode($content).'</div></div>';
    
    return $data;
}


/**
 * Shortcode: dropcap
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_dropcap($atts, $content) {
    $return = '<span class="dropcaps">' . $content . '</span>';
    return $return;
}


/**
 * Shortcode: dropcap2
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_dropcap2($atts, $content) {
    $return = '<span class="dropcaps color2">' . $content . '</span>';
    return $return;
}


/**
 * Shortcode: ul
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ul($atts, $content) {
	$atts = shortcode_atts(array('float' => 'none','color'=>''), $atts);
	
	if( $atts['float'] == 'left' ){
		$float = 'li_left_flaot';
	
	}elseif( $atts['float'] == 'right'  ){
		$float = 'li_right_flaot';
	
	}else {
		$float = '';
	}
	
    $GLOBALS['ul_count'] = 0;
	unset($GLOBALS['ul']);
    do_shortcode($content);
	$tabs = '';
    if (is_array($GLOBALS['ul'])) {
        foreach ($GLOBALS['ul'] as $tab) {
        	if($tab['color']!=''){
        		$style = 'style="color:'.$tab['color'].'"';
        	}elseif($atts['color']!='') {
        		$style = 'style="color:'.$atts['color'].'"';
        	}else {
        		$style = '';
        	}
        	if($tab['icon']==''){
        		$icon = '';
        		$class = '';
        	}else {
        		$icon = '<span class="li_icon '.$tab['icon'].'" '.$style.'></span>';
        		$class = 'li_icon';
        	}
            $tabs = $tabs .  '<li class="'.$class.'">' . $icon . do_shortcode($tab['content']) . '</li>';
        }
        $return = "\n" . '<ul class="custom_ul ">' . $tabs . '</ul>' . "\n";
    }
    return $return;
}

/**
 * Shortcode: li
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_li($atts, $content) {
    $atts = shortcode_atts(array('icon' => '','color' => ''), $atts);

    $x = $GLOBALS['ul_count'];
    $GLOBALS['ul'][$x] = array('icon' => sprintf($atts['icon'], $GLOBALS['ul_count']),'color' => sprintf($atts['color'], $GLOBALS['ul_count']), 'content' => $content);

    $GLOBALS['ul_count']++;
}

/**
 * Shortcode: ul_2_table
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ul_2_table($atts, $content) {
    $atts = shortcode_atts(array('align' => ''), $atts);

    $data = '<div class="ul_2_table '.$atts['align'].'">'.do_shortcode($content).'</div>';
    return $data;
}

/**
 * Shortcode: input
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_input($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => 'none',
    	'id'=>'',
        'placeholder' => ''), $atts);


	$data = '<p class="label-input">' . $atts['placeholder'] . '</p><div class="input-wrap"><input id="' . $atts['id'] . '" name="' . $atts['id'] . '" class="element-block " type="text" value="" size="30" tabindex="1" aria-required="true" placeholder=""><span class="' . $atts['icon'] . '"></span></div>';

    return $data;
}

/**
 * Shortcode: is_logged_in
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_is_logged_in($atts, $content = null) {

    $data = '';
    if(is_user_logged_in()){
    	$data = $data . do_shortcode($content);
    }
    return $data;
}

/**
 * Shortcode: is_logged_out
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_is_logged_out($atts, $content = null) {

    $data = '';
    if(!is_user_logged_in()){
    	$data = $data . do_shortcode($content);
    }
    return $data;
}

/**
 * Shortcode: textarea
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_textarea($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => 'none message',
    	'id'=>'',
        'placeholder' => ''), $atts);

	$data = '<p class="label-input">' . $atts['placeholder'] . '</p><div class="input-wrap"><textarea class="element-block  ' . $atts['icon'] . '" name="' . $atts['id'] . '" id="' . $atts['id'] . '" type="text"  ></textarea></div>';


    return $data;
}


/**
 * Shortcode: percentage
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_percentage($atts, $content = null) {

    $atts = shortcode_atts(array( 'percentage' => '80%','title' => ''), $atts);

	$data = '<div class="row-fluid"><div class="span6">'.$atts['title'].'</div><div class="span6"><div class="progress progress-striped"><div class="bar" style="width: '.$atts['percentage'].';">'.$atts['percentage'].'</div></div></div></div>';


    return $data;
}



/**
 * Shortcode: list_all_icons
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_list_all_icons($atts, $content = null) {

    include(get_template_directory() . '/library/includes/admin/icons.php'); 
    $icons =  get_all_icons();
    
    $data= '<div class="list_all_icons">';
    foreach ($icons as $icon ) {
    	$data = $data .'<div class="list_all_icons_single"><span class="'.$icon.'"></span><span class="text"> '.$icon.'</span></div>';
    }
	$data=  $data . '</div>';
	
    return $data;
}

add_shortcode( 'list_all_icons', 'code125_list_all_icons' );

/**
 * Shortcode: share
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_share($atts, $content = null) {

    $atts = shortcode_atts(array( 'text' => 'Share this Project','id' => '' ), $atts);
	if($atts['id']!=''){
		$id = $atts['id'] ;
	}else {
		global $post;
		
		$id = $post->ID;	
	}
		
	
	$data = '<div class="dropdown share-button-wrap">';
	
	if( !isset($GLOBALS['button_count'])){
		$GLOBALS['button_count'] = 0;
	}
	$GLOBALS['button_count']++;
	
	$count = $GLOBALS['button_count'];
	
	$color_1= '#f3f3f3';
	$color_0 = '#333';
	
	$data = $data .'<style>.button_'.$count.' span.text{color:#333; background-color: '.$color_1.'; } .button_'.$count.':hover span.text:after,.button_'.$count.':hover span.hover{color:white; background-color: '.$color_0.';}</style>';
	
	$data = $data . '<a href="#" class="button_'.$count.' share-shortcode dropdown-toggle roll-link-html  button  button_'.$count.' " data-toggle="dropdown"><span class="text icon-share">' . $atts['text'] . '</span><span class="hover icon-share">' . $atts['text'] . '</span></a>';
	
	
	$data = $data . '<ul class="share dropdown-menu clearfix"><li class="fb"><div class="fb-like" data-href="'. get_permalink($id) .'" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></li>';
	$data = $data . '<li class="tw"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>';
	$data = $data . '<li class="gp"><div class="g-plusone" data-size="medium" data-href="'. get_permalink($id)  .'"></div><script type="text/javascript">(function() {var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;  po.src = \'https://apis.google.com/js/plusone.js\'; var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s); })(); </script></li>';
	
	$id_link = get_post_thumbnail_id($id);
	$image_url = wp_get_attachment_image_src($id_link, "full");
	
	  
	$data = $data . '<li class="pinit"><a href="http://pinterest.com/pin/create/button/?url='.get_permalink($id).'&media='. $image_url[0].'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li></ul></div><div class="clearfix"></div>';
	
	return $data;
}

/**
 * Shortcode: author_name
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_author_name($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '','post_id' => '','class' => '','wrap_li' => '','wrap_li_class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
		
	$post_data = get_post($post_id);
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class=" vcard '.$atts['wrap_li_class'].'"><span class="'.$atts['icon'].'"></span>';
		$icon = ''; 
		$li_end = '</li>';
	}else {
		$li_start = '<span class="vcard">';
		$li_end = '</span>';
		$icon = '<span class="'.$atts['icon'].'"></span> ';	
	}
	
	$user = get_userdata($post_data->post_author);
	 
	
	 
	$data = $li_start . '<a class=" url fn  '.$atts['class'].' " rel="author" href="'.  get_author_posts_url($user->ID) .'">'. $icon .' ' .$user->display_name.'</a>' . $li_end;
	
	
	return $data;
}

/**
 * Shortcode: post_title
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_post_title($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '','post_id' => '','class' => '','post_link' => '','wrapper' => '','wrap_li' => '','wrap_li_class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	if($atts['wrapper']==''){
		$atts['wrapper']='p' ;
	}
		
	$post_data = get_post($post_id);
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class="'.$atts['wrap_li_class'].'"><span class="'.$atts['icon'].'"></span>';
		$icon = '';
		$li_end = '</li>';
	}else {
		$li_start = '';
		$li_end = '';
		$icon = '<span class="'.$atts['icon'].'"></span> ';	
	}
	if($atts['post_link']=='true'){
		
		if($atts['wrapper']=='a'){
			$link = ' href="'.get_permalink($post_id) .'"' ;
		}else {
			$link = '';
		}
		
	}else {
		$link = '';
	}
	 
	
	 
	$data = $li_start . '<'.$atts['wrapper'].' class="'.$atts['class'].' " '. $link .'>'. $icon .' ' .$post_data->post_title.'</'.$atts['wrapper'].'>' . $li_end;
	
	
	return $data;
}

/**
 * Shortcode: post_category
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_post_category($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '','post_id' => '','class' => '','wrap_li' => '','wrap_li_class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class="'.$atts['wrap_li_class'].'"><span class="'.$atts['icon'].'"></span>';
		$icon = '';
		$li_end = '</li>';
	}else {
		$li_start = '';
		$li_end = '';
		$icon = '<span class="'.$atts['icon'].'"></span> ';	
	}
	
	 $type = get_post_type($post_id);
	 
	 $tax = get_post_tax($post_id);
	
	$terms = wp_get_post_terms(get_the_ID(), $tax);
	$cats = '';
	foreach ($terms as $term) {
	    $cats = $cats . '<a class="'.$tax.'-'.$term->term_id.'" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
	}
	 
	$data = $li_start . '<span class="'.$atts['class'].' " >'. $icon .' ' .$cats.'</span>' . $li_end;
	
	
	return $data;
}

/**
 * Shortcode: post_date
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_post_date($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '','post_id' => '','class' => '','wrap_li' => '','wrap_li_class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class="'.$atts['wrap_li_class'].'"><span class="'.$atts['icon'].'"></span>';
		$icon = '';
		$li_end = '</li>';
	}else {
		$li_start = '';
		$li_end = '';
		$icon = '<span class="'.$atts['icon'].'"></span> ';	
	}
	
	 
	 
	$data = $li_start . '<p class="'.$atts['class'].' " >'. $icon .' ' . get_the_time('F j, Y',$post_id) . '</p>' . $li_end;
	
	
	return $data;
}

/**
 * Shortcode: post_comments_count
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_post_comments_count($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '','post_id' => '','class' => '','wrap_li' => '','wrap_li_class' => '','method' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	$type = get_post_type($post_id);
	
	if($type != 'post'){
		return '';
	}
	
	if($atts['icon']!=''){
		$icon_data = '<span class="'.$atts['icon'].'"></span> ';	
	}else {
		$icon_data = '';
	}
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class="'.$atts['wrap_li_class'].'">'.$icon_data ;
		$icon = '';
		$li_end = '</li>';
	}else {
		$li_start = '';
		$li_end = '';
		$icon = $icon_data;	
	}
	
	 
	 
	$data = $li_start . '<p class="'.$atts['class'].' " >'. $icon .' ' . get_total_number_of_comments($post_id,$atts['method']) . '</p>' . $li_end;
	
	
	return $data;
}
/**
 * Shortcode: blockquote
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_blockquote($atts, $content = null) {

 
	$data = '<div class="quote-wrap"><div class="icon-quote-wrap"><span class="icon-quote-left"></span></div><div class="content-quote-wrap">'.do_shortcode($content).'</div></div>';
	
	
	return $data;
}

/**
 * Shortcode: post_like_button
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_post_like_button($atts, $content = null) {

    $atts = shortcode_atts(array( 'post_id' => '','wrap_li' => '','wrap_li_class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	
	if($atts['wrap_li']=='true'){
		$li_start = '<li class="'.$atts['wrap_li_class'].'">';
		$li_end = '</li>';
	}else {
		$li_start = '';
		$li_end = '';
	}
	
	 
	 
	$data = $li_start .  getPostLikeLink($post_id) . $li_end;
	
	
	return $data;
}

/**
 * Shortcode: team_member_social
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_team_member_social($atts, $content = null) {

    $atts = shortcode_atts(array( 'post_id' => '','class' => '' ), $atts);
	if($atts['post_id']!=''){
		$post_id = $atts['post_id'] ;
	}else {
		global $post;
		
		$post_id = $post->ID;	
	}
	
	$meta_values = get_post_custom($post_id);
	$icons_social = unserialize($meta_values['social_icons'][0]) ;
	
	$icons_code =  '<div class="social-mini-icons-sh clearfix '.$atts['class'].'">';
	if(is_array($icons_social)){
	foreach ($icons_social as $icon ) {
		if($icon['type'] == 'email'){
			$icons_code = $icons_code . '<a href="mailto:'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
		}else {
			$icons_code = $icons_code . '<a href="'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
		}
	}
	}
	$icons_code = $icons_code . '</div>';
	
	
	
	return $icons_code;
}



/**
 * Shortcode: container
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_container($atts, $content = null) {

    



    $data = '<div class="box-container">' . do_shortcode($content) . '</div>';

    return $data;
}

/**
 * Shortcode: section_open
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_section_open($atts, $content = null) {
	$atts = shortcode_atts(array( 'image' => '','center' => '','color' => '','position' => '','repeat' => '','attachment' => '','style' => ''), $atts);
	
    $bg = "";
    
    if($atts['color']!=''){
    	$bg = $bg . $atts['color']." ";
    }
    
    if($atts['image']!=''){
    	$bg = $bg . "url('".$atts['image']."') ";
    }
    
    if($atts['position']!=''){
    	$bg = $bg . $atts['position']." ";
    }
    
    if($atts['repeat']!=''){
    	$bg = $bg . $atts['repeat']." ";
    }
    
    if($atts['attachment']!=''){
    	$bg = $bg . $atts['attachment']." ";
    }
    
    if($bg !=''){
    	$bg =  'style="background: ' . $bg .'; "';
	}

    $data = '<div class="section '.$atts['center'].' '.$atts['style'].'" '.$bg.' >';

    return $data;
}
/**
 * Shortcode: section_close
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_section_close($atts, $content = null) {
	
    $data = '</div>';

    return $data;
}

/**
 * Shortcode: wide_section_open
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_wide_section_open($atts, $content = null) {
	$atts = shortcode_atts(array( 'image' => '','color' => '','position' => '','repeat' => '','attachment' => '','style' => ''), $atts);
	
    $bg = "";
    
    if($atts['color']!=''){
    	$bg = $bg . $atts['color']." ";
    }
    
    if($atts['image']!=''){
    	$bg = $bg . "url('".$atts['image']."') ";
    }
    
    if($atts['position']!=''){
    	$bg = $bg . $atts['position']." ";
    }
    
    if($atts['repeat']!=''){
    	$bg = $bg . $atts['repeat']." ";
    }
    
    if($atts['attachment']!=''){
    	if($atts['attachment'] != 'parallax'){
    		$bg = $bg . $atts['attachment']." ";
    	}
    }
    
    
    
    if($bg !=''){
    	$bg =  'style="background: ' . $bg .'; "';
	}
	global $is_gecko, $is_safari;
	
	if($is_gecko || $is_safari){
		if($atts['attachment'] == 'parallax'){
			$bg =  'style="background: ' . 'url(\''.$atts['image'].'\') fixed center  center"'; 
		}
		$atts['attachment'] ='fixed';
	}else {
		if($atts['attachment'] == 'parallax'){
			$bg =  'style="background: ' . 'url(\''.$atts['image'].'\')  center  center"'; 
		}
	}

    $data = '</div><div class="wide-container att-'.$atts['attachment'].' clearfix '.$atts['style'].'" '.$bg.' ><div class="mid-page-wide">';

    return $data;
}
/**
 * Shortcode: wide_section_close
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_wide_section_close($atts, $content = null) {

    $data = '</div></div><div class="mid-page">';

    return $data;
}

/**
 * Shortcode: full_width_open
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_full_width_open($atts, $content = null) {

    $data = '</div>';

    return $data;
}
/**
 * Shortcode: full_width_close
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_full_width_close($atts, $content = null) {

    $data = '<div class="mid-page">';

    return $data;
}




/**
 * Shortcode: box_with_button
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_box_with_button($atts, $content = null) {
	$atts = shortcode_atts(array( 'icon' => '','color' => '','text_color'=>'','link' => '','text' => ''), $atts);
    



    $data = '<div class="box-container box_with_button">' . do_shortcode($content) . '<div class="box_with_button-button">'. do_shortcode('[button_2 color="'.$atts['color'].'" text_color="'.$atts['text_color'].'" size="button-med" icon="'.$atts['icon'].'" float="none" text="'.$atts['text'].'" link="'.$atts['link'].'"]') .'</div></div>';

    return $data;
}

/**
 * Shortcode: center
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_center($atts, $content = null) {

    



    $data = '<div class="center-everything">' . do_shortcode($content) . '</div>';

    return $data;
}

/**
 * Shortcode: service_column
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_service_column($atts, $content = null) {

    $atts = shortcode_atts(array( 'icon' => '',
        'size' => '',
        'color' => '',
        'style' => ''), $atts);

	if ($atts['style'] == '' )
	    $atts['style'] = 1;
	
	if( !isset($GLOBALS['service_count'])){
		$GLOBALS['service_count'] = 0;
	}
	$GLOBALS['service_count']++;
	
	$count = $GLOBALS['service_count'];
	
	if($atts['style'] == 1){
    	$data = '<div class="service-column-wrap service_count'.$count.' style1"><div class="wrap-service-icon"><span class="color-icon ' . $atts['icon'] . '"></span></div><div class="service-content-wrap">' . do_shortcode($content) . '</div></div>';
    }elseif($atts['style'] == 2){
    	$data = '<div class="service-column-wrap style2"><div class="service-content-wrap box-container"><span class="color-icon ' . $atts['icon'] . '"></span>' . do_shortcode($content) . '</div></div>';
    }elseif($atts['style'] == 3){
    	$data = '<div class="service-column-wrap service_count'.$count.' box-container style3"><div class="wrap-service-icon"><span class="color-icon ' . $atts['icon'] . '"></span></div><div class="service-content-wrap ">' . do_shortcode($content) . '</div></div>';
    }elseif($atts['style'] == 4){
    	$data = '<div class="service-column-wrap box-container service_count'.$count.' style1"><div class="wrap-service-icon"><span class="color-icon ' . $atts['icon'] . '"></span></div><div class="service-content-wrap">' . do_shortcode($content) . '</div></div>';
    }elseif($atts['style'] == 5){
    	$data = '<div class="service-column-wrap  flip-post service_count'.$count.' style5"><div class="flip-wrap"><div class="post-front post-data-bg"><div class="post-back-wrap"><div class="wrap-service-icon"><span class="color-icon ' . $atts['icon'] . '"></span></div></div></div><div class="post-back post-data-bg"><div class="post-back-wrap"><div class="service-content-wrap">' . do_shortcode($content) . '</div></div></div></div></div>';
    }
    
    
    if($atts['color'] != ''){
    
    $color_1= $atts['color'];
    $color_0 = '#' . hexDarker(substr($atts['color'],1), 50);
    
    $data = $data .'<style>.service-column-wrap.style3.service_count'.$count.' .color-icon{ color: '.$color_1.'; }.service-column-wrap.style3.service_count'.$count.':hover .color-icon{color: '.$color_0.';}.service-column-wrap.style1.service_count'.$count.' .color-icon{ background-color: '.$color_1.'; }.service-column-wrap.style1.service_count'.$count.':hover .color-icon{background-color: '.$color_0.';}</style>';
    	
    }

    return $data;
}

/**
 * Shortcode: button
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_button($atts, $content = null) {

    $atts = shortcode_atts(array( 'color' => 'default',
        'link' => '',
        'text' => '',
        'float' => '',
        'size'=>''), $atts);



    $data = '<a href="' . $atts['link'] . '" class="' . $atts['color'] . ' btn ' . $atts['float'] . ' '.$atts['size'].'">' . $atts['text'] . '</a>';

    return $data;
}

/**
 * Shortcode: button_2
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_button_2($atts, $content = null) {

    $atts = shortcode_atts(array( 'color' => 'default',
    	'text_color' => '#fff',
        'link' => '',
        'text' => '',
        'float' => '',
        'att' => '',
        'class' => '',
        'size'=>'',
        'icon'=>'',
        'id'=>''), $atts);
        
	if( !isset($GLOBALS['button_count'])){
		$GLOBALS['button_count'] = 0;
	}
	$GLOBALS['button_count']++;
	
	$count = $GLOBALS['button_count'];
	
	if($atts['att']!=''){
		$att2 = explode(",", $atts['att']);
		$att_echo = $att2[0] . '="' . $att2[1] . '"';
	}else {
		$att_echo =  '';
	}
	
	$color_1= $atts['color'];
	$color_0 = '#' . hexDarker(substr($atts['color'],1), 20);
	
	$data ='<style>a.button_'.$count.' span.text{ background-color: '.$color_1.';color:'.$atts['text_color'].'; } .button_'.$count.':hover span.text:after,.button_'.$count.':hover span.hover{background-color: '.$color_0.'; }</style>';
	
	
    $data = $data .'<a id="' . $atts['id'] . '"  '.$att_echo.'  href="' . $atts['link'] . '" class="roll-link-html '.$atts['class'].'  button  button_'.$count.' ' . $atts['float'] . ' '.$atts['size'].'"><span class="text">' . $atts['text'] . '<span class="'.$atts['icon'].'"></span></span><span class="hover">' . $atts['text'] . '<span class="'.$atts['icon'].'"></span></span></a>';

    return $data;
}


/**
 * Shortcode: button_3
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_button_3($atts, $content = null) {

    $atts = shortcode_atts(array( 'color' => 'default',
        'text_color'=>'#fff',
        'link' => '',
        'text' => '',
        'float' => '',
        'size'=>'',
        'icon'=>'',
        'id'=>''), $atts);
        
	if( !isset($GLOBALS['button_3_count'])){
		$GLOBALS['button_3_count'] = 0;
	}
	$GLOBALS['button_3_count']++;
	
	$count = $GLOBALS['button_3_count'];
	
	
	$color_1= $atts['color'];
	
	$color_0 = '#' . hexLighter(substr($color_1,1), 15);
	$color_2 = '#' . hexLighter(substr($color_1,1), 15);
	$color_3 = '#' . hexDarker(substr($color_1,1), 10);
	$color_4 = '#' . hexDarker(substr($color_1,1), 20);
	
	$data ='<style>.button_num_3_'.$count.'{ color:'.$atts['text_color'].' ; background-color: '. $color_1.';
	  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, '. $color_1.'), color-stop(100%, '. $color_3.'));
	  background-image: -webkit-linear-gradient(top, '. $color_1.', '. $color_3.');
	  background-image: -moz-linear-gradient(top, '. $color_1.', '. $color_3.');
	  background-image: -ms-linear-gradient(top, '. $color_1.', '. $color_3.');
	  background-image: -o-linear-gradient(top, '. $color_1.', '. $color_3.');
	  background-image: linear-gradient(top, '. $color_1.', '. $color_3.');
	  border: 1px solid '. $color_4.';} .button_num_3_'.$count.':hover {background-color: '. $color_2.';
	    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, '. $color_2.'), color-stop(100%, '. $color_1.'));
	    background-image: -webkit-linear-gradient(top, '. $color_2.', '. $color_1.');
	    background-image: -moz-linear-gradient(top, '. $color_2.', '. $color_1.');
	    background-image: -ms-linear-gradient(top, '. $color_2.', '. $color_1.');
	    background-image: -o-linear-gradient(top, '. $color_2.', '. $color_1.');
	    background-image: linear-gradient(top, '. $color_2.', '. $color_1.');}</style>';
	
	
    $data = $data .'<a id="' . $atts['id'] . '" href="' . $atts['link'] . '" class="button_num_3  button_num_3_'.$count.' ' . $atts['float'] . ' '.$atts['size'].'">' . $atts['text'] . '<span class="'.$atts['icon'].'"></span></a>';

    return $data;
}

/**
 * Shortcode: posts_slider_auto
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_posts_slider_auto($atts, $content = null) {


     $atts = shortcode_atts(array(
             'width_type' => '',
             'posts_per_page' => '',
             'order' => '',
             'orderby' => '',
             'meta_key' => '',
             'category'=>'',
             'type' => 'post',
             'author_enable' => 'yes',
             'date_enable' => 'yes',
             'comments_count_enable' => 'yes',
             'cat_enable' => 'yes',
             'like_enable' => 'yes',
             'view_count_enable' => 'yes',
             'review_enable' => 'yes'), $atts);
             
         if (!isset($atts['posts_per_page']))
             $atts['posts_per_page'] = 5;
        
         if (!isset($atts['order']))
             $atts['order'] = 'DESC';
         if (!isset($atts['orderby']))
             $atts['orderby'] = 'post_date';
     
     
     
     
        
         		if($atts['category']==''){
         			$args = array(
         			'posts_per_page' => $atts['posts_per_page'], 
         			'post_type' => array( $atts['type'] ),
         			'order'=>$atts['order'],
         			'orderby' => $atts['orderby']
         			);
         		}else {
         			$args = array(
         			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
         			'post_type' => array( $atts['type'] ),
         			'order'=>$atts['order'],
         			'orderby' => $atts['orderby'],
         			'tax_query' => array(
         					array(
         						'taxonomy' => get_post_tax($atts['type']),
         						'field' => 'id',
         						'terms' => $atts['category']
         					)
         				), 
         			);
         		}
         		
         		
     	if($atts['orderby'] == 'meta_value_num'){
     		$args['meta_key'] = $atts['meta_key'];
     	}
     

if($atts['orderby'] == 'meta_value_num'){
	$args['meta_key'] = $atts['meta_key'];
}

   query_posts($args);
     
     
     $data = '[posts_slider width_type="'.$atts['width_type'].'" author_enable="'.$atts['author_enable'].'" date_enable="'.$atts['date_enable'].'" comments_count_enable="'.$atts['comments_count_enable'].'" cat_enable="'.$atts['cat_enable'].'" like_enable="'.$atts['like_enable'].'" view_count_enable="'.$atts['view_count_enable'].'" review_enable="'.$atts['review_enable'].'"]';
     
     while (have_posts()) : the_post();
     
			$data = $data . '[posts_slide id="'.get_the_ID().'" type="'.$atts['type'].'"]';
			   	
   endwhile;
   
   
   	$data = $data . '[/posts_slider]';					    		
   
    wp_reset_query();
    return do_shortcode($data);
    
}


/**
 * Shortcode: posts
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_posts($atts, $content = null) {


     $atts = shortcode_atts(array(
        'posts_per_page' => '',
        'paging' => '',
        'order' => '',
        'orderby' => '',
        'meta_key' => '',
        'blog_style' => '1',
        'thumb_view' => 'views',
        'thumb_size' => 'large',
        'category'=>'',
        'type' => 'post',
        'author_enable' => 'yes',
        'date_enable' => 'yes',
        'comments_count_enable' => 'yes',
        'cat_enable' => 'yes',
        'like_enable' => 'yes',
        'view_count_enable' => 'yes',
        'review_enable' => 'yes'), $atts);
        
    if (!isset($atts['posts_per_page']))
        $atts['posts_per_page'] = 5;
    if (!isset($atts['paging']))
        $atts['paging'] = 'false';
    if (!isset($atts['order']))
        $atts['order'] = 'DESC';
    if (!isset($atts['orderby']))
        $atts['orderby'] = 'post_date';
    
    
    if (!isset($atts['thumb_size']))
        $atts['thumb_size'] = 'large';

	$GLOBALS['thumb_view'] = $atts['thumb_view'];

    if (isset($atts['category'])) {
        $cats = $atts['category']; //explode(",", $atts['category']);
    } else {
        $cats = '';
    }
    if ($atts['paging'] == 'true') {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    } else {
        $paged = 1;
    }

    if($atts['category']==''){
    	$args = array(
    	'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
    	'post_type' => array( $atts['type'] ),
    	'offset' => 0,
    	'paged' => $paged,
    	'order'=>$atts['order'],
    	'orderby' => $atts['orderby']
    	);
    }else {
    	$args = array(
    	'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
    	'post_type' => array( $atts['type'] ),
    	'offset' => 0,
    	'paged' => $paged,
    	'order'=>$atts['order'],
    	'orderby' => $atts['orderby'],
    	'tax_query' => array(
    			array(
    				'taxonomy' => get_tax_by_type($atts['type']),
    				'field' => 'id',
    				'terms' => $atts['category']
    			)
    		), 
    	);	
    }
	if($atts['orderby'] == 'meta_value_num'){
		$args['meta_key'] = $atts['meta_key'];
	}
	
	$cat_print = $atts['category'];
	
	query_posts($args);
	
	$GLOBALS['author_enable'] = $atts['author_enable'];
	$GLOBALS['date_enable'] = $atts['date_enable'];
	$GLOBALS['comments_count_enable'] = $atts['comments_count_enable'];
	$GLOBALS['cat_enable'] = $atts['cat_enable'];
	$GLOBALS['like_enable'] = $atts['like_enable'];
	$GLOBALS['view_count_enable'] = $atts['view_count_enable'];
	$GLOBALS['review_enable'] = $atts['review_enable'];
	$GLOBALS['thumb_size'] = $atts['thumb_size'];
	
	$mutual_array =array();
	
	
	$mutual_array['author_enable'] = $atts['author_enable'];
	$mutual_array['date_enable'] = $atts['date_enable'];
	$mutual_array['comments_count_enable'] = $atts['comments_count_enable'];
	$mutual_array['cat_enable'] = $atts['cat_enable'];
	$mutual_array['like_enable'] = $atts['like_enable'];
	$mutual_array['view_count_enable'] = $atts['view_count_enable'];
	$mutual_array['review_enable'] = $atts['review_enable'];
	$mutual_array['thumb_size'] = $atts['thumb_size'];
	
	
	$passing_string = serialize($mutual_array);
   
     
     $counter = 1;
     $data = '<div class="posts-ajax-wrap ">';
     
     while (have_posts()) : the_post();
     
			
			include(get_template_directory() . '/library/includes/templates/blog-style'.$atts['blog_style'].'.php');
			
			
	
   endwhile;
   
    $data = $data . '</div>';

    
    if ($atts['paging'] == 'true') {
   	       ob_start();
           bones_page_navi();
           $page_navi = ob_get_contents();
           ob_end_clean();
   
           $data = $data . $page_navi;
        
    }elseif ($atts['paging'] == 'load') {
    	
    	$data = $data . '<a href="#" class="do-show-more-posts roll-link-html btn-block" data-order="'.$atts['order'].'" data-thumb_view="'.$atts['thumb_view'].'" data-passing_string="'.$passing_string.'" data-orderby="'.$atts['orderby'].'" data-meta_key="'.$atts['meta_key'].'" data-cat="'.$cat_print.'" data-per-click="'.$atts['posts_per_page'].'" data-post-type="'.$atts['type'].'" data-current-shortcode="blog-style'.$atts['blog_style'].'"  data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="false" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
    }
   
    wp_reset_query();
    return $data;
    
}

/**
 * Shortcode: columns_grid
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_columns_grid($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array('type' => 'portfolio',
		  'offset' => 0,
		  'paging' => 'true',
		  'child_cats' => 'true',
		  'show_count' => 'true',
		  'height' => 'fixed',
		  'shape' => 'square',
		  'link_type' => 'link',
		  'animated' => 'true',
		  'col_count' => '4',
		  'orderby'=> 'date',
          'meta_key' => '', 
		  'order'=>'DESC',
		  'category'=>'',
		  'cat_post'=>'',
		  'cat_portfolio'=>'',
		  'cat_team'=>'',
		  'filter' =>'true',
		  'posts_per_page' =>'8' ), $atts);
	
	
	$GLOBALS['link_type'] = $atts['link_type'];
	
	if ($atts['paging'] == 'true') {
	    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	} else {
	    $paged = 1;
	}
	if ($atts['child_cats'] == '') {
	    $atts['child_cats'] = 'true';
	}
	if ($atts['animated'] == '') {
	    $atts['animated'] = 'true';
	}
	if ($atts['show_count'] == '') {
	    $atts['show_count'] = 'true';
	}
	if ($atts['col_count'] == '') {
	    $atts['col_count'] = 4;
	}
	if ($atts['height'] == 'flexible') {
	    $height = '-flexible';
	}else {
		$height = '';
	}
	if ($atts['shape'] == 'circle') {
	    $shape = '-circle';
	    $height = '';
	}elseif($atts['shape'] == 'square-metro') {
		$shape = '-square-metro';
		$height = '';
	}elseif($atts['shape'] == 'oct') {
		$shape = '-oct';
		$height = '';
	}else {
		$shape = '';
	}
	
	if ($atts['col_count'] == 1) {
		$height = '';
		$shape = '';
	}
	
	
	/*
	if ($atts['type'] != 'team' && ( $atts['col_count'] == 5 || $atts['col_count'] == 6)) {
		$atts['col_count'] = 4;
	}
	*/
	
	if($atts['category']==''){
		$args = array(
		'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
		'post_type' => array( $atts['type'] ),
		'offset' => 0,
		'paged' => $paged,
		'order'=>$atts['order'],
		'orderby' => $atts['orderby']
		);
	}else {
		$args = array(
		'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
		'post_type' => array( $atts['type'] ),
		'offset' => 0,
		'paged' => $paged,
		'order'=>$atts['order'],
		'orderby' => $atts['orderby'],
		'tax_query' => array(
				array(
					'taxonomy' => get_tax_by_type($atts['type']),
					'field' => 'id',
					'terms' => $atts['category']
				)
			), 
		);	
	}
	
 	if($atts['filter']==''){
 		$atts['filter']= 'true';
 	}
 	
 	
 	
 	$data = '<div class="clearfix"></div>';
 	
 	if($atts['child_cats']=='true'){
 		$args2 = array(
 		    'orderby'       => 'name', 
 		    'order'         => 'ASC'
 		);
 		$cat_print = '';
 	}else {
 		
 		if($atts['category']==''){
 			$parent =  $atts['category'];
 		}else {
 			$parent =  0;
 		}
 		$cat_print = $atts['category'];
 			
 		
 		$args2 = array(
 		    'orderby'       => 'name', 
 		    'order'         => 'ASC', 
 		    'parent'         => $parent,
 		);
 		
 	}
 	
 	$GLOBALS['columns_team'] = $atts['col_count'];
 	
 	if ($atts['col_count'] == 'mixed') {
 		$height = '-mixed';
 		$shape = '';
 		$GLOBALS['columns_team'] = 5;
 	}
 	
 	if($atts['type']=='team'){
 		$tax_file = 'team';
 	}
 	else {
 		$tax_file = 'portfolio';
 	}
 	
 	$tax= get_tax_by_type($atts['type']);
 	
 	if($atts['col_count']==1){
 		$file_col_count = 1;
 		
 	}else {
 		$file_col_count = 4;
 	}
 	
 	
 	if($atts['filter']=='true'){
 		 		
 		
 		
 		$terms = get_terms( $tax, $args2 );
 		if($atts['animated']=='true'){
 			$data = $data . '<ul id="filter" class="option-set portfolio_filter clearfix" data-option-key="filter">';
 		}else {
 			$data = $data . '<ul id="filter" class="portfolio_filter clearfix">';
 		}
 		
 		$data = $data . '<li><a href="#filter" data-option-value="*" class="selected">'.__('All','code125').'</a></li>';
 		
 		foreach ($terms as $term) {
 			if($atts['animated']=='true'){
 				if($atts['show_count']=='true'){
 					$data = $data . '<li><a href="#filter" class="'.$tax.'-' . $term->term_id .' '.get_option( $tax .'_icon_' . $term->term_id ).'" data-option-value=".' . $term->slug . '">' . $term->name . ' (' . $term->count . ')</a></li>';
 				}else {
 					$data = $data . '<li><a href="#filter" class="'.$tax.'-' . $term->term_id .' '.get_option( $tax .'_icon_' . $term->term_id ).'" data-option-value=".' . $term->slug . '">' . $term->name . '</a></li>';
 				}
 			}else {
 				if($atts['show_count']=='true'){
 					$data = $data . '<li><a class="'.$tax.'-' . $term->term_id .' '.get_option( $tax .'_icon_' . $term->term_id ).'" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
 				}else {
 					$data = $data . '<li><a class="'.$tax.'-' . $term->term_id .' '.get_option( $tax .'_icon_' . $term->term_id ).'" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a></li>';
 				}
 				
 			}
 		    
 		}
 		
 		$data = $data . '</ul>';
 		
 	}
 	
 	
 	
 	$data = $data . '<div id="items_container" class="posts-ajax-wrap super-list '.$tax_file.' portfolio_'.$GLOBALS['columns_team'].'_cols'.$height.$shape.'  portfolio_items variable-sizes clearfix">';
     
     if($atts['orderby'] == 'meta_value_num'){
     	$args['meta_key'] = $atts['meta_key'];
     }
     query_posts($args);
     if (have_posts()) : while (have_posts()) : the_post();
     	include(get_template_directory() . '/library/includes/templates/'.$tax_file.'-style'.$file_col_count.$height.$shape.'.php');
    
    endwhile;
    endif;
   $data = $data . '</div>';
if ($atts['paging'] == 'true') {
	       ob_start();
        bones_page_navi();
        $page_navi = ob_get_contents();
        ob_end_clean();

        $data = $data . $page_navi;
     
 }elseif ($atts['paging'] == 'load') {
 	$data = $data . '<a href="#" class="do-show-more-posts roll-link-html btn-block" data-meta_key="'.$atts['meta_key'].'" data-order="'.$atts['order'].'" data-orderby="'.$atts['orderby'].'" data-link="'.$atts['link_type'].'" data-cat="'.$cat_print.'" data-per-click="'.$atts['posts_per_page'].'" data-post-type="'.$atts['type'].'" data-current-shortcode="'.$tax_file.'-style'.$file_col_count.$height.$shape.'" data-column="'.$GLOBALS['columns_team'].'" data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="true" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
 }

 wp_reset_query();
return $data;

}


/**
 * Shortcode: thumbnails_in_line
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_thumbnails_in_line($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array('type' => 'portfolio',
		  'orderby'=> 'date',
        'meta_key' => '', 
		  'order'=>'DESC',
		  'cat_post'=>'',
		  'cat_portfolio'=>'',
		  'cat_team'=>'',
		  'posts_per_page' =>'8' ), $atts);

	
	
	if($atts['type']=='portfolio'){
		if($atts['cat_portfolio']==''){
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby']
			);
		}else {
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby'],
			'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_cat',
						'field' => 'id',
						'terms' => $atts['cat_portfolio']
					)
				), 
			);
		}
    	
 	}elseif($atts['type']=='team'){
 		if($atts['cat_team']==''){
 			$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby']
 			);
 		}else {
 			$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby'],
 			'tax_query' => array(
 					array(
 						'taxonomy' => 'hierarchy',
 						'field' => 'id',
 						'terms' => $atts['cat_team']
 					)
 				), 
 			);
 		}
 		
 		}else {
 		$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'paged' => $paged,
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby'] 
 			);
 	}
 	
 	
 	$data = '';
 	$data2 = '';
 	
 	if($atts['orderby'] == 'meta_value_num'){
 		$args['meta_key'] = $atts['meta_key'];
 	}
 	
 	
 	
    $the_query = new WP_query( $args );
     $width = $the_query->post_count*100;
     $data2 = $data2 . '<div class="thumbnails_in_line   clearfix" style="width:'.$width.'px">';
     if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
     	$permalink = get_permalink();
     	
     	$the_title = get_the_title();
     	
     	 
     	$id_link = get_post_thumbnail_id();
     	  
     	  $image_url = wp_get_attachment_image_src( $id_link, '85_85'); 
     	
     	$the_post_thumbnail = '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" />';
     	
     	
     	$data = $data . '<div class="thumb_in_line" title="'.$the_title. '"><a href="'.$permalink.'">'.$the_post_thumbnail.'</a></div>';
     	
    
    endwhile;
    endif;
    
   $data = $data2. $data . '</div>';


 wp_reset_query();
 
return $data;

}


/**
 * Shortcode: breaking_news
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_breaking_news($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array('type' => 'portfolio',
		  'orderby'=> 'date',
        'meta_key' => '', 
		  'order'=>'DESC',
		  'category'=>'',
		  'posts'=>'',
		  'source_type'=>'',
		  'title'=>'',
		  'posts_per_page' =>'8' ), $atts);

	
	if($atts['source_type']=='category'){
	
		if($atts['category']==''){
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby']
			);
		}else {
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby'],
			'tax_query' => array(
					array(
						'taxonomy' => get_tax_by_type($atts['type']),
						'field' => 'id',
						'terms' => $atts['category']
					)
				), 
			);
		}
    
 	}elseif ($atts['source_type']=='posts') {
 		$args = array(
 		'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 		'post__in' => array($atts['posts'] ),
 		'post_type' => array( $atts['type'] ),
 		'order'=>$atts['order'],
 		'orderby' => $atts['orderby']
 		);
 	}
 	
 	
 	$data = '';
 	
 	$data = $data . '<div class="breaking-news-ticker   clearfix"><p class="breaking-title">'.do_shortcode($atts['title']). '</p><ul class="newsticker" style="display:none">';
 	
 	if ($atts['source_type']=='posts' || $atts['source_type']=='category' ){
   
	if($atts['orderby'] == 'meta_value_num'){
		$args['meta_key'] = $atts['meta_key'];
	}
	
    query_posts( $args );
    
     $counter = 1;
     if (have_posts()) : while (have_posts()) : the_post();
     	$permalink = get_permalink();
     	
     	$the_title = get_the_title();
     	
     		$data = $data . '<li><a  href="'.$permalink. '">'.$the_title. '</a></li>'; 
     	
     	
     	
    endwhile;
    endif;
    
   
   
   }else {
   	 $data = $data . do_shortcode($content);
   }

$data =  $data . '</ul></div>';
 wp_reset_query();
return $data;

}

/**
 * Shortcode: accordion_thumbs
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_accordion_thumbs($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array('type' => 'portfolio',
		  'orderby'=> 'date',
        'meta_key' => '', 
		  'order'=>'DESC',
		  'cat_post'=>'',
		  'cat_portfolio'=>'',
		  'posts_per_page' =>'8' ), $atts);

	
	
	if($atts['type']=='portfolio'){
		if($atts['cat_portfolio']==''){
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby']
			);
		}else {
			$args = array(
			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
			'post_type' => array( $atts['type'] ),
			'order'=>$atts['order'],
			'orderby' => $atts['orderby'],
			'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_cat',
						'field' => 'id',
						'terms' => $atts['cat_portfolio']
					)
				), 
			);
		}
    	
 	}elseif($atts['type']=='team'){
 		if($atts['cat_team']==''){
 			$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby']
 			);
 		}else {
 			$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby'],
 			'tax_query' => array(
 					array(
 						'taxonomy' => 'hierarchy',
 						'field' => 'id',
 						'terms' => $atts['cat_team']
 					)
 				), 
 			);
 		}
 		
 		}else {
 		$args = array(
 			'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 			'post_type' => array( $atts['type'] ),
 			'order'=>$atts['order'],
 			'orderby' => $atts['orderby'] 
 			);
 	}
 	
 	
 	$data = '';
 	$data2 = '';
 	
 	if($atts['orderby'] == 'meta_value_num'){
 		$args['meta_key'] = $atts['meta_key'];
 	}
 	
 	
    query_posts( $args );
     $data = $data . '<div class="accordion_thumbs   clearfix">';
     $counter = 1;
     if (have_posts()) : while (have_posts()) : the_post();
     	$permalink = get_permalink();
     	
     	$the_title = get_the_title();
     	
     	ob_start();
     	the_excerpt_max_charlength(200);
     	$the_excerpt_max_charlength = ob_get_contents();
     	ob_end_clean();
     	 
     	
     	
     	$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , '64x64');
     	
     	if($counter==1){
     		$class= "current first";
     		$class2= "block";
     	}else {
     		$class= "";
     		$class2= "none";
     	}
     	if($the_post_thumbnail==''){
     		$the_post_thumbnail='<span class="thumb-icon-self icon-pencil"></span>';
     	}
     	$data = $data . '<div class="title '.$class. '"><div class="thumb-wrap">'.$the_post_thumbnail. '</div><div class=""><h5>'.$the_title. '</h5><div class="thumb-subdata"><p class="date">' . get_the_time('F') . ' ' . get_the_time('j') . ', ' . get_the_time('Y') . '</p>'.do_shortcode('[post_comments_count post_id="'.get_the_ID().'" method="text"]').'</div></div><div class="down"><span class="icon-down-open-1"></span></div></div><div class="pane" style="display:'.$class2.';">'.$the_excerpt_max_charlength.' <a href="'.$permalink.'" class="gray"> '.__('Read More','code125').'</a></div>';
     	
     	$counter++;
    
    endwhile;
    endif;
    
   $data =  $data . '</div>';


 wp_reset_query();
return $data;

}









/**
 * Shortcode: category
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
*/
function code125_category($atts, $content = null) {

 
      $atts = shortcode_atts(array(
         'posts_per_page' => '',
         'order' => '',
         'orderby' => '',
         'meta_key' => '',
         'blog_style' => '1',
         'thumb_view' => 'views',
         'category'=>'',
         'type' => 'post',
         'author_enable' => 'yes',
         'date_enable' => 'yes',
         'comments_count_enable' => 'yes',
         'cat_enable' => 'yes',
         'like_enable' => 'yes',
         'view_count_enable' => 'yes',
         'review_enable' => 'yes'), $atts);
         
     if (!isset($atts['posts_per_page']))
         $atts['posts_per_page'] = 5;
     if (!isset($atts['paging']))
         $atts['paging'] = 'false';
     if (!isset($atts['order']))
         $atts['order'] = 'DESC';
     if (!isset($atts['orderby']))
         $atts['orderby'] = 'post_date';
 
 	$GLOBALS['thumb_view'] = $atts['thumb_view'];
 	$atts['thumb_size'] = 'large';
 	$GLOBALS['thumb_size'] = $atts['thumb_size'];
 
    
     $tax = get_tax_by_type($atts['type']);
     
     $term = get_term( $atts['category'], $tax );
 
    if ( is_wp_error( $term )  ) {
    	return 'Error with Category ID, Please make sure this category exists with the Post typed assigned.';
    }elseif ( is_wp_error( get_term_link( intval($term->term_id), $tax ) ) ) {
    	return 'Error with Category ID, Please make sure this category exists with the Post typed assigned.';
    	
    }
    $args = array(
     	'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
     	'post_type' => array( $atts['type'] ),
     	'order'=>$atts['order'],
     	'orderby' => $atts['orderby'],
     	'tax_query' => array(
     			array(
     				'taxonomy' => get_tax_by_type($atts['type']),
     				'field' => 'id',
     				'terms' => $atts['category']
     			)
     		), 
     	);	
    
 	if($atts['orderby'] == 'meta_value_num'){
 		$args['meta_key'] = $atts['meta_key'];
 	}
 	
 	
 	
 	
 	query_posts($args);
 	
 	$GLOBALS['author_enable'] = $atts['author_enable'];
 	$GLOBALS['date_enable'] = $atts['date_enable'];
 	$GLOBALS['comments_count_enable'] = $atts['comments_count_enable'];
 	$GLOBALS['cat_enable'] = $atts['cat_enable'];
 	$GLOBALS['like_enable'] = $atts['like_enable'];
 	$GLOBALS['view_count_enable'] = $atts['view_count_enable'];
 	$GLOBALS['review_enable'] = $atts['review_enable'];
 	
 	$mutual_array =array();
 	
 	
 	$mutual_array['author_enable'] = $atts['author_enable'];
 	$mutual_array['date_enable'] = $atts['date_enable'];
 	$mutual_array['comments_count_enable'] = $atts['comments_count_enable'];
 	$mutual_array['cat_enable'] = $atts['cat_enable'];
 	$mutual_array['like_enable'] = $atts['like_enable'];
 	$mutual_array['view_count_enable'] = $atts['view_count_enable'];
 	$mutual_array['review_enable'] = $atts['review_enable'];
 	$mutual_array['thumb_size'] = $atts['thumb_size'];
 	
 	
 	$passing_string = serialize($mutual_array);
    
      
      $counter = 1;
     $mutual_array['cat-counter'] = 1; 
     $mutual_array['cat-counter-total'] = $atts['posts_per_page'];
     $data = '<div class="category_style '.$tax.'-'.$term->term_id.' clearfix" >';
     
     
     $data = $data .'<h3 class="title"><a href="'.get_term_link(intval($term->term_id), $tax).'" class="roll-link-html "><span class="text"><span class="'.get_option( $tax .'_icon_' . $term->term_id ).'"></span> '.$term->name.'</span><span class="hover"><span class="'.get_option( $tax .'_icon_' . $term->term_id ).'"></span> '.$term->name.'</span></a><a class="rss-icon icon-rss" href="'.home_url(). '/?feed=rss2&'.$tax.'='.$atts['category'].'"></a></h3><div class="cat-section-wrap">';
      
      while (have_posts()) : the_post();
      
 			include(get_template_directory() . '/library/includes/templates/cat-style'.$atts['blog_style'].'.php');
    	
    endwhile;
    
     $data = $data . '</div></div>';
 
    
     wp_reset_query();
     return $data;
    
}














































 

 
/**
 * Shortcode: news_in_photos
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_news_in_photos($atts,$content = null) {

$atts = shortcode_atts(
	array('orderby'=> 'date',
          'meta_key' => '', 
		  'order'=>'DESC',
		  'numberposts' =>'Number Of News To Show',
		  'category' => ''), $atts);

if (isset($atts['category'])) {
    $cats = $atts['category']; //explode(",", $atts['category']);
} else {
    $cats = '';
}
global $post;

$args = array(
    'posts_per_page' => $atts['numberposts'],
    'cat' => $cats,
    'orderby' => $atts['orderby'],
    'order' => $atts['order'],
    'post_type' => 'post',
    'post_status' => 'publish',         // posts only
    'meta_query'=>'_thumbnail_id', // with thumbnail
    'exclude'=>$post->ID );

if($atts['orderby'] == 'meta_value_num'){
	$args['meta_key'] = $atts['meta_key'];
}
query_posts($args);
  
  
  $counter = 1;
  $data = '<div class="news_in_photo clearfix">';
  
  while (have_posts()) : the_post();
  
  
  
  		$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'mixed-size-4');
  			
  		$id_link = get_post_thumbnail_id();
  		
  		$image_url = wp_get_attachment_image_src( $id_link, "full"); 
  			
  			if( $the_post_thumbnail!='' ){
  		
           		$data = $data . '<div class="news-photo thumb-wrap thumb'.$counter.'">';
           
           		$data = $data . get_thumb_hover(get_the_ID(),'mixed-size-4',ot_get_option( 'hover_view' ));
           
           		$data = $data . '</div>';   
           		
           		$counter++;     
           }
           
          if($counter ==$atts['numberposts'] ){
          	break;
          }
          
  endwhile;
  	$data = $data . '</div>'; 
          
          wp_reset_query();
          return $data;
	
}


/**
 * Shortcode: review_box
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_review_box($atts,$content = null) {

	global $post;
	$data = '<div class="review-wrap">' . get_reviewbox($post->ID) . '</div>';
    return $data;
	
}

/**
 * Shortcode: author_box
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_author_box($atts,$content = null) {
	$atts = shortcode_atts(
		array('id'=> ''), $atts);
	
	
	$user = get_userdata($atts['id']);
	
	$facebook_user = get_the_author_meta( 'facebook', $atts['id']);
	$twitter_user = get_the_author_meta( 'twitter', $atts['id']);
	$position_user = get_the_author_meta( 'position', $atts['id']);
	
	$google_plus_user = get_the_author_meta( 'google_plus', $atts['id']);
	$behance_user = get_the_author_meta( 'behance', $atts['id']);
	$dribble_user = get_the_author_meta( 'dribble', $atts['id']);
	
	$avatar = get_avatar( $atts['id'], '100', '', '<span class="icon-user"></span>' );
	
	$data =  '<div class="textwidget author_widget clearfix"><div class="row-fluid"><div class="span4"><a href="'.  get_author_posts_url($atts['id']) .'">'. $avatar .'</a></div><div class="span8"><h3><a href="'. get_author_posts_url($atts['id']).'">'. $user->display_name .'</a></h3><p>'. $position_user .'</p><ul class="social-icons clearfix">';
	
	if($facebook_user != ''){
		$data = $data . '<li><a href="http://www.facebook.com/people/@/'.$facebook_user.'" class="icon-facebook"></a></li>';
	}
	
	if($twitter_user != ''){
		$data = $data . '<li><a href="http://www.twitter.com/'.$twitter_user.'" class="icon-twitter"></a></li>';
	}
	
	if($google_plus_user != ''){
		$data = $data . '<li><a href="'.$google_plus_user.'" class="icon-google-plus"></a></li>';
	}
	
	if($behance_user != ''){
		$data = $data . '<li><a href="'.$behance_user.'" class="code125-social-behance"></a></li>';
	}
	
	if($dribble_user != ''){
		$data = $data . '<li><a href="'.$dribble_user.'" class="code125-social-dribble"></a></li>';
	}
	
	if($user->user_email != ''){
		$data = $data . '<li><a href="mailto:'.$user->user_email.'" class="icon-envelope-alt"></a></li>';
	}
	
	if($user->user_url != ''){
		$data = $data . '<li><a href="'.$user->user_url.'" class="icon-link"></a></li>';
	}
	
	$data = $data . '</li></ul></div></div>';
	
	$data = $data . '<p class="author_description"><span class="arrow-up"></span>'.$user->user_description.'</p>';
	
	$data = $data . '</div>';
	
	return $data;
	
}








/**
 * Shortcode: 4cols_posts
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_4col_posts($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array('type' => 'portfolio',
		  'orderby'=> 'date',
        'meta_key' => '', 
		  'order'=>'DESC',
		  'title' =>'Latest Projects',
		  'category' =>'' ), $atts);


    
 	
 	if($atts['category']==''){
 		$args = array(
 		'posts_per_page' => 8, /* you can change this to show more */
 		'post_type' => array( $atts['type'] ),
 		
 		'order'=>$atts['order'],
 		'orderby' => $atts['orderby']
 		);
 	}else {
 		$args = array(
 		'posts_per_page' => 8, /* you can change this to show more */
 		'post_type' => array( $atts['type'] ),
 		
 		'order'=>$atts['order'],
 		'orderby' => $atts['orderby'],
 		'tax_query' => array(
 				array(
 					'taxonomy' => get_tax_by_type($atts['type']),
 					'field' => 'id',
 					'terms' => $atts['category']
 				)
 			), 
 		);	
 	}
 	if($atts['orderby'] == 'meta_value_num'){
 		$args['meta_key'] = $atts['meta_key'];
 	}
 	
 	
 	$data ='<div class="shortcode_4col_posts " id="shortcode_4col_posts"><h3 class="title"><span class="roll-link-html "><span class="text"> '.$atts['title'].'</span><span class="hover">'.$atts['title'].'</span></span></h3>';
 	
 	
 	$data = $data . '<div class="4cols_anmi"><ul class="slides_4col col_3_4">';
 	
 	
     query_posts($args);
     if (have_posts()) : while (have_posts()) : the_post();
     
     ob_start();
     the_permalink();
     $permalink = ob_get_contents();
     ob_end_clean();
       
     ob_start();
     the_title();
     $the_title = ob_get_contents();
     ob_end_clean();
               
       
     	$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , '4-col');
     	
     	$type = get_post_type(get_the_ID());
     	if ($type == 'portfolio') {
     	    $tax = 'portfolio_cat';
     	    $icons_code = '';
     	}elseif ($type == 'team') {
     	    $tax = 'hierarchy';
     	    $meta_values = get_post_custom(get_the_ID());
     	    if(isset($meta_values['social_icons'][0])){
     	    $icons_social = unserialize($meta_values['social_icons'][0]) ;
     	    
     	    $width = count($icons_social) * 30;
     	    $icons_code =  '<div class="social-mini-icons-wrap-style"><div class="social-mini-icons" style="width:'.$width.'px">';
     	    if(is_array($icons_social)){
     	    foreach ($icons_social as $icon ) {
     	    	if($icon['type'] == 'email'){
     	    		$icons_code = $icons_code . '<a href="mailto:'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
     	    	}else {
     	    		$icons_code = $icons_code . '<a href="'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
     	    	}
     	    }
     	    }
     	    $icons_code = $icons_code . '</div></div>';
     	    }else {
     	    	$icons_code = '';
     	    }
     	    
     	} else {
     	    $tax = 'category';
     	    $icons_code = '';
     	}
     	
     	$terms = wp_get_post_terms(get_the_ID(), $tax);
     	$cats = '';
     	$cat_echo = '';
     	foreach ($terms as $term) {
     	    $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
     	    
     	}
     	
     	$id_link = get_post_thumbnail_id();
     	
     	$image_url = wp_get_attachment_image_src($id_link, "full");
    
    	$data = $data . '<li class="'.$tax.'-'.$terms[0]->term_id.'"><div class="image-wrap">' . $the_post_thumbnail . '<div class="more-wrap-wrap"><div class="more-wrap clearfix"><a  class=" more " href="' . $permalink . '"><span class="icon-link"></span></a></div><div class="more-wrap  clearfix"><a  class="fancybox more more2" href="'.$image_url[0].'"><span class="icon-search-1"></span></a></div></div></div><hgroup class="data-title"><div class="alpha-div"></div><a class="title" href="'. $permalink .'" >' . get_the_title()  .'</a><p class="portfolio-cats">'.$cats.'</p>'.$icons_code.'</hgroup></li>';
    
    endwhile;
    endif;
   $data = $data . '</ul></div></div>';

wp_reset_query();

return $data;

}




/**
 * Shortcode: testimonials
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_testimonials($atts, $content = null){

global $post;
$atts = shortcode_atts(
	array(
		  'title' =>'Testimonials',
		  'posts_per_page' =>'8'), $atts);


    
 	
 		$args = array(
 		'posts_per_page' => $atts['posts_per_page'], /* you can change this to show more */
 		'post_type' => array('testimonial')
 		);
 	 	
 	
 	$data ='<div class="testimonials_slider" id="testimonials_slider"><h3 class="title"><span class="title" data-title="'.$atts['title'].'">'.$atts['title'].'</span></h3>';
 	
 	$tabs= '';
 	
 	
     query_posts($args);
     if (have_posts()) : while (have_posts()) : the_post();
     
     ob_start();
     the_permalink();
     $permalink = ob_get_contents();
     ob_end_clean();
       
     ob_start();
     the_title();
     $the_title = ob_get_contents();
     ob_end_clean();
     
     ob_start();
     the_content();
     $the_content = ob_get_contents();
     ob_end_clean();
               
       
     	$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , '100x100');
     	
     	$tabs = $tabs . '<li><div class="row-fluid"><div class="span3">'.$the_post_thumbnail.'</div><div class="span9"><div class="box-container margin_1">'.$the_content.'</div></div></div></li>';
    
    endwhile;
    endif;
    
   
    $return = $data .  '<div class="flexslider features clearfix"><ul class="slides clearfix">' .  $tabs . "\n" . '</ul></div></div>';

wp_reset_query();

return $return;

}






 

/**
 * Shortcode: title
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_title($atts, $content = null) {
    $atts = shortcode_atts(array('title' => '','animated' => 'yes','icon'=>'', 'id'=>''), $atts);
    if($atts['icon'] !='' && $atts['icon']!='none'){
    	$icon = '<span class="title-icon '.$atts['icon'].'"></span>';
    }else {
    	$icon = '';
    }
    if($atts['id'] !=''){
    	$id = 'id="'.$atts['id'].'"';
    }else {
    	$id = '';
    }
    if($atts['animated']=='yes'){
   		return '<h3 class="title"><span class="roll-link-html "><span class="text">' . $atts['title'] . '</span><span class="hover">' . $atts['title'] . '</span></span>'  . $icon . '</h3>';
    }else {
    	return '<h3 class="title"><span class="roll-link-html2 "><span class="text">' . $atts['title'] . '</span></span>'  . $icon . '</h3>';
    }
}



/**
 * Shortcode: ad_728x90
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ad_728x90($atts, $content = null) {
    $atts = shortcode_atts(array('title' => ''), $atts);
   return '<div class="ad_728x90">' . html_entity_decode($content). '</div>';
}

/**
 * Shortcode: ad_468x60
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ad_468x60($atts, $content = null) {
    $atts = shortcode_atts(array('title' => ''), $atts);
   return '<div class="ad_468x60">' . html_entity_decode($content). '</div>';
}

/**
 * Shortcode: ad_300x250
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ad_300x250($atts, $content = null) {
    $atts = shortcode_atts(array('title' => ''), $atts);
   return '<div class="ad_300x250">' . html_entity_decode($content). '</div>';
}
/**
 * Shortcode: ad_300x50
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_ad_300x50($atts, $content = null) {
    $atts = shortcode_atts(array('title' => ''), $atts);
    if(wp_is_mobile()){
  	 return '<div class="ad_300x50">' . html_entity_decode($content). '</div>';
   }else {
   	return '';
   }
}


/**
 * Shortcode: sidebar
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_sidebar($atts, $content = null) {
    $atts = shortcode_atts(array('slug' => ''), $atts);
    
    ob_start();
    dynamic_sidebar($atts['slug']);
    $sidebar = ob_get_contents();
    ob_end_clean();
    
     
    
    return '<div class="sidebar  clearfix" role="complementary">'.$sidebar.'</div>';
}


/**
 * Shortcode: menu
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_menu($atts, $content = null) {
    $atts = shortcode_atts(array(
    		'location' => '',
    		'bg_mode' => '',
    		'style' => '',
    		'responsive' => 'responsive'
    		), $atts);
   if ( has_nav_menu( $atts['location'] ) ) { 
   $menu = wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => 'The Main Menu',                           // nav name
    	'menu_class' => ' top-nav menu-sc-nav clearfix',         // adding custom nav class
    	'theme_location' => $atts['location'],                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 3,
        'echo' => 0,
        'walker' => new description_walker() 	));
    
    
     
    if($atts['style']=='sidebar'){
    	$atts['responsive'] = 'no_responsive';
    }
    return '<nav role="navigation" class="navigation-shortcode '.$atts['responsive'].' '.$atts['bg_mode'].' '.$atts['style'].' top-menu-nav clearfix"><div class="responsive-controller clearfix"><p>'.__('Navigation','code125').'</p><span class="icon-menu"></span></div>'. $menu . '</nav>';
    }else {
    	return '';
    }
}



/**
 * Shortcode: slider
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_slider($atts, $content) {
	
    $GLOBALS['slides_count'] = 0;
    unset($GLOBALS['slide']);

    do_shortcode($content);
    $counter =1;
    if (is_array($GLOBALS['slide'])) {
        
        
        
        $counter = 0;
        $tabs = '';
        
        foreach ($GLOBALS['slide'] as $tab) {
        	
        	
        		$meta_values = get_post_custom($tab['id']);
        		
        		if( $meta_values['meta_slide_type'][0] == "type_1"){
        			query_posts('p=' . $tab['id'] . '&post_type=slides');
        			while (have_posts()) : the_post();
        			ob_start();
        					the_permalink();
        					 $permalink = ob_get_contents();
        					 ob_end_clean();
        			
        					 ob_start();
        					 the_title();
        					 $the_title = ob_get_contents();
        					 ob_end_clean();
        			
        					 $the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'slide-half');
        					 
        			
        			
        			
        			$slide = '<li><div class="slider-bg-wrap"><div class="width_50_left">'.$the_post_thumbnail.'</div><div class="width_50_right hide"><div class="padding-slide"><a href="javascript:void(0)" class="author">'.$the_title.'</a><div class="slide_rest hide"><p>'.get_the_content().'</p>';
        			
        			if($meta_values['slides_button_link'][0] !=''){
        				$slide =  $slide .do_shortcode('[button_3 color="'.$GLOBALS['primary_color'].'" size="button-med" float="left" icon="'.$meta_values['slides_icon'][0].'" text="'.$meta_values['slides_button_text'][0].'" link="'.$meta_values['slides_button_link'][0].'"]');
        			}
        			
        			$slide =  $slide.'</div></div></div></div></li>';
        			
        			        			
        			$tabs = $tabs . $slide;
        			
        			endwhile;
        			wp_reset_query();
        		
        		}elseif ($meta_values['meta_slide_type'][0] == "type_2" ) {
        			query_posts('p=' . $tab['id'] . '&post_type=slides');
        			while (have_posts()) : the_post();
        			
        			
        			ob_start();
        					the_permalink();
        					 $permalink = ob_get_contents();
        					 ob_end_clean();
        			
        					 ob_start();
        					 the_title();
        					 $the_title = ob_get_contents();
        					 ob_end_clean();
        			
        					 
        					 	$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'slide-half');
        					 
        			
        			
        			
        			$slide = '<li><div class="slider-bg-wrap"><div class="width_50_left">';
        			
        			if($meta_values['meta_video_type'][0] == 'vimeo'){
        					$video = do_shortcode(' [vimeo clip_id="'.$meta_values['meta_slide_video_link'][0].'" width="100%" height="398"] ');
        			}elseif ($meta_values['meta_video_type'][0] == 'youtube') {
        					$video =  do_shortcode(' [youtube id="'.$meta_values['meta_slide_video_link'][0].'" width="100%" height="398"] ');
        			}elseif ($meta_values['meta_video_type'][0] == 'dailymotion') {
        					$video = do_shortcode(' [dailymotion id="'.$meta_values['meta_slide_video_link'][0].'" width="100%" height="398"] ');
        			}
        			
        			$slide =  $slide. $video .'</div><div class="width_50_right hide"><div class="padding-slide"><a href="javascript:void(0)" class="author">'.$the_title.'</a><div class="slide_rest hide"><p>'.get_the_content().'</p>';
        			
        			if($meta_values['slides_button_link'][0] !=''){
        				$slide =  $slide .do_shortcode('[button_3 color="'.$GLOBALS['primary_color'].'" size="button-med" float="left" icon="'.$meta_values['slides_icon'][0].'" text="'.$meta_values['slides_button_text'][0].'" link="'.$meta_values['slides_button_link'][0].'"]');
        			}
        			
        			$slide =  $slide.'</div></div></div></div></li>';
        			
        			        			
        			$tabs = $tabs . $slide;
        			
        			
        			
        			endwhile;
        			wp_reset_query();
        			
        		}elseif ($meta_values['meta_slide_type'][0] == "type_3" || $meta_values['meta_slide_type'][0] == "type_4" || $meta_values['meta_slide_type'][0] == "type_5" ) {
        			
        			if ($meta_values['meta_slide_type'][0] == "type_3" ) {
	        			$type = 'post';
        			}elseif ( $meta_values['meta_slide_type'][0] == "type_4") {
        				$type = 'portfolio';
        			}elseif ( $meta_values['meta_slide_type'][0] == "type_5") {
        				$type = 'team';
        			}
        			
        			query_posts('p=' . $meta_values['meta_slide_post'][0] . '&post_type='. $type);
        			while (have_posts()) : the_post();
        						ob_start();
        						the_permalink();
        						 $permalink = ob_get_contents();
        						 ob_end_clean();
        				
        						 ob_start();
        						 the_title();
        						 $the_title = ob_get_contents();
        						 ob_end_clean();
        				
        						
        								ob_start();
        								the_author_posts_link();
        								$the_author_posts_link = ob_get_contents();
        								ob_end_clean();
        				
        				
        						$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'slide-half');
        				
        						 ob_start();
        						 the_excerpt_max_charlength(100);
        						 $the_excerpt_max_charlength = ob_get_contents();
        						 ob_end_clean();
        						
        						
        						 
        				$slide = '<li><div class="slider-bg-wrap"><div class="width_50_left">'.$the_post_thumbnail.'</div><div class="width_50_right hide"><div class="padding-slide"><a href="'.$permalink.'" class="author">'.$the_title.'</a><div class="slide_rest hide"><p>'.$the_excerpt_max_charlength.'</p>';
        				
        				$slide =  $slide .do_shortcode('[button_3 color="'.$GLOBALS['primary_color'].'" size="button-med" float="left" icon="" text="'.__('Read More','code125').'" link="'.$permalink.'"]');
        				
        				
        				$slide =  $slide.'</div></div></div></div></li>';
        				
        				
        				
        				
        			endwhile;
        			wp_reset_query();
        				
        			
        			
        			
        			
        			
        			$tabs = $tabs . $slide;
        			
        			
        		}
        	
        	
        	$counter++;
        }
        $return = "\n" . '<div class="flexslider main-slider features clearfix"><ul class="slides clearfix">' .  $tabs . "\n" . '</ul></div>';
        
    }
    
    
    return $return;
}


/**
 * Shortcode: slide
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_slide($atts, $content) {
	
	$atts = shortcode_atts(array('id' => ''), $atts);
	
    $x = $GLOBALS['slides_count'];
    $GLOBALS['slide'][$x] = array('id' => $atts['id']);

    $GLOBALS['slides_count']++;
}

/**
 * Shortcode: slider_with_title
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_slider_with_title($atts, $content) {
	$atts = shortcode_atts(array(
	   'title' => ''),$atts);

    $GLOBALS['slider_with_title_count'] = 0;
   unset($GLOBALS['slider_with_title']);

    do_shortcode($content);
    if (is_array($GLOBALS['slider_with_title'])) {
        $tabs = '';
        foreach ($GLOBALS['slider_with_title'] as $tab) {
        	$tabs = $tabs . '<li>'.do_shortcode($tab['content']).'</li>';
        }
        
        $return = "\n" . '<h3 class="title"><span class="title" data-title="'.$atts['title'].'">'.$atts['title'].'</span></h3><div class="flexslider slider_with_title features clearfix"><ul class="slides clearfix">' .  $tabs . "\n" . '</ul></div>';
        
    }
    
     
    return $return;
}


/**
 * Shortcode: slide_with_title
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_slide_with_title($atts, $content) {
	
    $x = $GLOBALS['slider_with_title_count'];
    $GLOBALS['slider_with_title'][$x] = array('content' => $content);

    $GLOBALS['slider_with_title_count']++;
}



/**
 * Shortcode: flexslider
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_flexslider($atts, $content) {

    $GLOBALS['flexslider_count'] = 0;
   unset($GLOBALS['flexslider']);

    do_shortcode($content);
    if (is_array($GLOBALS['flexslider'])) {
        $tabs = '';
        foreach ($GLOBALS['flexslider'] as $tab) {
        	$tabs = $tabs . '<li>'.do_shortcode($tab['content']).'</li>';
        }
        $return = "\n" . '<div class="flexslider features clearfix"><ul class="slides clearfix">' .  $tabs . "\n" . '</ul></div>';
        
    }
    
     
    return $return;
}


/**
 * Shortcode: flexslider_slide
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_flexslider_slide($atts, $content) {
	
    $x = $GLOBALS['flexslider_count'];
    $GLOBALS['flexslider'][$x] = array('content' => $content);

    $GLOBALS['flexslider_count']++;
}



/**
 * Shortcode: posts_slider
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_posts_slider($atts, $content) {
	$atts = shortcode_atts(array('width_type' => 'span8',
	
	'author_enable' => 'yes',
	'date_enable' => 'yes',
	'comments_count_enable' => 'yes',
	'cat_enable' => 'yes',
	'like_enable' => 'yes',
	'view_count_enable' => 'yes',
	'review_enable' => 'yes'
	
	), $atts);
	
	$GLOBALS['author_enable'] = $atts['author_enable'];
	$GLOBALS['date_enable'] = $atts['date_enable'];
	$GLOBALS['comments_count_enable'] = $atts['comments_count_enable'];
	$GLOBALS['cat_enable'] = $atts['cat_enable'];
	$GLOBALS['like_enable'] = $atts['like_enable'];
	$GLOBALS['view_count_enable'] = $atts['view_count_enable'];
	$GLOBALS['review_enable'] = $atts['review_enable'];
	
    $GLOBALS['posts_slider_count'] = 0;
   unset($GLOBALS['posts_slider']);
	
	$tabs = '';
    do_shortcode($content);
    if (is_array($GLOBALS['posts_slider'])) {
        foreach ($GLOBALS['posts_slider'] as $tab) {
        	
        	query_posts('p=' . $tab['id'] . '&post_type=' . $tab['type'] . '');
        	
        	
        	while (have_posts()) : the_post();
        				$permalink = get_permalink();
        				
        				$the_title = get_the_title();
        				
        				
        				ob_start();
        				the_author_posts_link();
        				$the_author_posts_link = ob_get_contents();
        				ob_end_clean();
        				
        				
        				$comments_number = do_shortcode('[post_comments_count post_id="'.get_the_ID().'" method="text"]');
        				
        				
        				$cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');
        				
        				  
        				 if($atts['width_type'] == 'span12'){
	        				 $the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'slide');
        				  }else {
        				  	$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , 'blog-post-thumb');
        				  }
        		
        		if($the_post_thumbnail!=''){
        				
        		$slide = '<li>'.$the_post_thumbnail.'<div class="width_50_right post-slider hide"><a href="'.$permalink.'" class="author">'.$the_title.'</a><div class="slide_rest hide">';
        		
        		$data = '';
        		
        		
        		
        		include(get_template_directory() . '/library/includes/templates/meta-data.php');
        		
        		
        		$slide = $slide .$data .'</div></div></li>';
        		
        		
        		
        		
        		$tabs = $tabs . $slide;
        		
        		}
        		
        		
        	endwhile;
        	wp_reset_query();
        }
        if($tabs!=''){
        $return = "\n" . '<div class="flexslider  features posts_slider clearfix"><ul class="slides clearfix">' .  $tabs . "\n" . '</ul></div>';
        }else {
        	 $return = "";
        }
        
    }
    
     
    return $return;
}


/**
 * Shortcode: posts_slide
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_posts_slide($atts, $content) {
	$atts = shortcode_atts(array('id' => '','type' => ''), $atts);
	
    $x = $GLOBALS['posts_slider_count'];
    $GLOBALS['posts_slider'][$x] = array('id' => $atts['id'],'type' => $atts['type']);

    $GLOBALS['posts_slider_count']++;
}





/**
 * Shortcode: image
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_image($atts, $content = null) {

    $atts = shortcode_atts(array('width' => '',
        'height' => '',
        'caption' => '',
        'src' => '',
        'float' => 'left'), $atts);
    if ($atts['width']) {
        $width = 'width="' . $atts['width'] . '"';
    } else {
        $width = '';
    }
    if ($atts['height']) {
        $height = 'height="' . $atts['height'] . '"';
    } else {
        $height = '';
    }
    
    
    if ($atts['caption']) {
        $caption = '<p>' . $atts['caption'] . '</p>';
    } else {
        $caption = '';
    }

    $data = '<div class="image_wrap_shortcode '.$atts['float'].'"><img ' . $width . ' ' . $height . ' src="' . $atts['src'] . '"  />' . $caption . '</div>';

    return $data;
}

/**
 * Shortcode: video
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_video($atts, $content = null) {
    
    
    wp_enqueue_script( 'jquery_flowplayer' );
    
    $atts = shortcode_atts(array(
       'src' => '',
        'width' => 'auto',
        'height' => '400px'
            ),$atts);

    $src = $atts['src'];
    $width = $atts['width'];
    
    $height = $atts['height'];
	
	
	
    $output = '<a href="' . $src . '" style="display:block;width:' . $width . ';height:' . $height . ';margin:10px auto" id="player"></a>' . "\n";
    $output .= '<script type="text/javascript">
	flowplayer("player", "' . get_template_directory_uri() . '/library/includes/shortcodes/player/flowplayer-3.2.11.swf", {
        clip: {
               autoPlay: false,
               autoBuffering: true
}
});
</script>' . "\n";
    return $output;
}

/**
 * Shortcode: vimeo
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_vimeo($atts, $content = null) {
global $post;

if(is_home()){
	$meta_values = get_post_custom( ot_get_option( 'homepage' ) );
}else{
	$meta_values = get_post_custom($post->ID);
}

//Main Color
if( isset($meta_values['meta_custom_color'])  ){
	$primary_color = $meta_values['meta_custom_color'][0] ;
	if($primary_color == ""){
		$primary_color = ot_get_option( 'primary_color' );
	}
}else{
	$primary_color = ot_get_option( 'primary_color' );
}



    $atts = shortcode_atts(array(
                'clip_id' => '',
                'width' => '400',
                'height' => '225',
                'title' => '1',
                'byline' => '1',
                'portrait' => '1',
                'color' =>  substr($primary_color, 1),
                'html5' => '1'
                    ),$atts);

    $clip_id = $atts['clip_id'];
    $width = $atts['width'];
    $height = $atts['height'];
    $title = $atts['title'];
    $byline = $atts['byline'];
    $portrait = $atts['portrait'];
    $color = $atts['color'];
    $html5 = $atts['html5'];

    if (empty($clip_id) || !is_numeric($clip_id))
        return '<!-- Code125 Vimeo: Invalid clip_id -->';
    if ($height && !$atts['width'])
        $width = intval($height * 16 / 9);
    if (!$atts['height'] && $width)
        $height = intval($width * 9 / 16);

    return $html5 ?
            "<iframe  class='iframe_video' src='http://player.vimeo.com/video/$clip_id?title=$title&amp;byline=$byline&amp;portrait=$portrait&color=$color' width='$width' height='$height'  frameborder='0'></iframe>" :
            "<object  class='iframe_video' width='$width' height='$height'><param name='allowfullscreen' value='true' />" .
            "<param name='allowscriptaccess' value='always' />" .
            "<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$clip_id&amp;server=vimeo.com&amp;show_title=$title&amp;show_byline=$byline&amp;show_portrait=$portrait&amp;color=$color&amp;fullscreen=1' />" .
            "<embed src='http://vimeo.com/moogaloop.swf?clip_id=$clip_id&amp;server=vimeo.com&amp;show_title=$title&amp;show_byline=$byline&amp;show_portrait=$portrait&amp;color=$color&amp;fullscreen=1' type='application/x-shockwave-flash' allowfullscreen='true' allowscriptaccess='always' width='$width' height='$height'></embed></object>";
}

/**
 * Shortcode: youtube
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_youtube($atts) {
    $atts = shortcode_atts(array(
        "id" => '',
        "width" => '475',
        "height" => '350'
            ),$atts);
    $id = $atts['id'];
    $width = $atts['width'];
    $height = $atts['height'];

    return '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';
}
/**
 * Shortcode: dailymotion
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_dailymotion($atts) {
    $atts = shortcode_atts(array(
        "id" => '',
        "width" => '475',
        "height" => '350'
            ),$atts);

    $id = $atts['id'];
    $width = $atts['width'];
    $height = $atts['height'];

    return '<iframe width="' . $width . '" height="' . $height . '" frameborder="0"  src="http://www.dailymotion.com/embed/video/' . $id . '" ></iframe>';
}
/**
 * Shortcode: video5
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 function code125_video5($atts) {
    $atts = shortcode_atts(array(
        "src" => '',
        "width" => '',
        "height" => ''
            ),$atts);

    $src = $atts['src'];
    $width = $atts['width'];
    $height = $atts['height'];
    return '<video src="' . $src . '" width="' . $width . '" height="' . $height . '" controls autobuffer>';
}


function code125_audio( $atts, $content = null ) {
	extract(shortcode_atts(array(
	        "src" => '',
	        "autoplay" => 'false',
	        "preload"=> 'true',
	        "loop" => '',
	        "controls"=> ''
	    ), $atts));
	    return '<audio src="'.$src.'" preload="'.$preload.'" loop="'.$loop.'" controls="'.$controls.'" autobuffer ></audio>';
	
}



/**
 * Shortcode: contact_form
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_contact_form($atts, $content = null) {

$atts = shortcode_atts(array('name' => '', 'email'=>'', 'message'=>'', 'send'=>''), $atts);

$data = '<form id="contact-form" class="clearfix" method="post" action="">';

$data = $data . '<div class="row-fluid">';

$data = $data . '<div class="span6">[input placeholder="'.$atts['name'].'" id="name" icon="icon-user"]</div>';
$data = $data . '<div class="span6">[input placeholder="'.$atts['email'].'" id="email" icon="icon-mail"]</div></div>';
$data = $data . '[textarea placeholder="'.$atts['message'].'" id="message" icon="icon message"]';
$data = $data . '[button_2 color="'.$GLOBALS['primary_color'].'" size="button-med" float="left" text="'.$atts['send'].'" id="contact_button_send" link="#" icon="icon-paper-plane"]';
  
 
$data = $data . '</form><div class="message_contact_true box success"><p>'.__('Sent ','code125').'<span class="message">'.__('Your Message was sent, Thank you.','code125').'</span></p></div><div class="message_contact_false box warning"><p>'.__('Failed ','code125').'<span class="message">'.__('Your Message was not sent, Please try again.','code125').'</span></p></div>';

return do_shortcode($data);
}



/**
 * Shortcode: fancybox
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_fancybox($atts, $content) {

    $atts = shortcode_atts(array('w' => '', 'h' => '', 'src' => '', 'caption' => ''), $atts);

    $data = '<a class="fancybox clearfix" href="' . $atts['src'] . '" title="' . $atts['caption'] . '">';
    $data = $data . '<img class="lightbox_thumb" src="' . $atts['src'] . '" width="' . $atts['w'] . 'px" height="' . $atts['h'] . 'px" />';
    $data = $data . '</a>';

    return $data;
}

/**
 * Shortcode: box
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_box($atts, $content) {

    $atts = shortcode_atts(array('type' => '', 'title' => '', 'message' => ''), $atts);

   $data = '<div class="box '.$atts['type'].'"><p>' . $atts['title'] . ':  <span class="message">' . html_entity_decode($atts['message']) . '</span></p></div>';

    return $data;
}

/**
 * Shortcode: divider
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_divider($atts, $content = null) {
    return '<div class="divider_shortcode"></div>';
}

/**
 * Shortcode: shadow
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_shadow($atts, $content = null) {
    return '<div class="shadow-wrap"><div class="shadow3"></div></div>';
}



/**
 * Shortcode: space
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_space($atts, $content = null) {
    return '<div class="clearfix"></div><div class="divider_space"></div>';
}

/**
 * Shortcode: space_30
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_space_30($atts, $content = null) {
    return '<div class="clearfix"></div><div class="divider_space_30"></div>';
}

/**
 * Shortcode: featured_image
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html 
 */
function code125_featured_image($atts, $content = null) {
	$atts = shortcode_atts(array('size' => '','style' => ''), $atts);
  	
  	global $post;
  	
  	$id_link = get_post_thumbnail_id($post->ID);
  	
  	$image_url = wp_get_attachment_image_src( $id_link, $atts['size']);
  	
  	$data = '<div class="'.$atts['style'].'"><img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" /></div>';
  	
  	return $data;
  	
}



/**
 * Shortcode: shortcode_test
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_shortcode_test($atts, $content = null) {

    $atts = shortcode_atts(array( 'shortcode' => ''), $atts);
    
    
    require_once(get_template_directory() .'/library/includes/shortcodes/lib/available.php');
    
    $shortcodes_builder = code125_shortcodes();
    if(isset($_POST['shortcode_name'])){
    	$atts['shortcode']	= $_POST['shortcode_name'];
    }
    
    foreach ($shortcodes_builder as $key => $value) {
    	if( $key == $atts['shortcode'] ){
    		$shortcode_atts= $value['atts'];
    		if(isset($value['content'])){
    			$shortcode_content= 'on';
    		}else {
    			$shortcode_content= 'off';
    		} 
    	}
    }
     
    $data = '<h3 class="title"><span class="title" data-title="'.$atts['shortcode'].'">'.$atts['shortcode'].'</span></h3><form  method="post" action="" class="shortcode-test"><input type="hidden" name="shortcode_name" class="element-block " id="shortcode_name" value="'.$atts['shortcode'].'" size="20">';
     
    foreach ($shortcode_atts as $key => $value) {
    	$data = $data . '<div class="row-fluid"><div class="span4"><label for="'.$key.'">'.$value['desc'].'</label></div><div class="span8">';
    	
    	if(isset($_POST[$key])){
    		$current_value = $_POST[$key];
    	}else {
    		$current_value = $value['default'];
    	}
    	if(count($value['values'])!=0){
    		$data = $data . '<select name="'.$key.'" id="'.$key.'" class="postform">';
    		foreach ($value['values'] as $key2 => $value2) {
    			if($current_value == $key2){
    				$selected= 'selected="selected"';
    			}else {
    				$selected= '';
    			}
    			$data = $data . '<option class="level-0" value="'.$key2.'" '.$selected.'>'.$value2.'</option>';
    			
    		}
    		$data = $data . '</select>';
    	}else {
    		$data = $data . '<input type="input" name="'.$key.'" class="element-block" id="'.$key.'" value="'.$current_value.'" size="20">';
    	}
    	
    	$data = $data . '</div></div>';
    }
    if($shortcode_content=='on'){
    	$data = $data . '<textarea id="content-data" name="content-data" class="element-block  " tabindex="4"></textarea>';
    }
    

	$data = $data . '<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Show Result"></form>';
	
	$code = '';

	if(isset($_POST['shortcode_name'])){
	
	$code = '['. $_POST['shortcode_name'] .' ';
	foreach ($shortcode_atts as $key => $value) {
	
	$code = $code . $key . '="'.$_POST[$key].'" ';
	}
	$code = $code .']';
	
	if($shortcode_content=='on'){
		$code = $code  .$_POST['content-data']. '[/'.$_POST[$key].']';
	}
	
	
	}
	$data = $data . '<div class="clearfix"></div><p class="genertated-shortcode">'.$code.'</p><div class="clearfix"></div><div class="divider_space"></div><div class="divider_space"></div>' . do_shortcode($code);
    return $data;
}


add_shortcode( 'shortcode_test', 'code125_shortcode_test' );
add_shortcode( 'shortcodes_tester', 'code125_shortcodes_tester' );

/**
 * Shortcode: shortcodes_tester
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
 
function code125_shortcodes_tester($atts, $content = null) {

    $atts = shortcode_atts(array( ), $atts);
    
    
    require_once(get_template_directory() .'/library/includes/shortcodes/lib/available.php');
    
    $shortcodes_builder = code125_shortcodes();
    $current_value = '';
    $current = '';
    if(isset($_POST['shortcode-name-choose'])){
    	$current = 'yes';
    	$current_value = $_POST['shortcode-name-choose'];
    }
    if(isset($_POST['shortcode_name'])){
    	$current = 'yes';
    	$current_value = $_POST['shortcode_name'];
    }
    
    $dont_include = array('row' , 'row_fluid' , '1_12' , '2_12' , '3_12' , '4_12' , '5_12' , '6_12' , '7_12' , '8_12' , '9_12' , '10_12' , '11_12' , '12_12','review_box' );
    
    foreach ($shortcodes_builder as $key => $value) {
    	if(isset( $value['child'])){
    		$dont_include[]= $value['child']; 
    	}
    }
    
    $dont_include_type = array('opengroup' , 'closegroup');
     
    $data = '<h3 class="title"><span class="title" data-title="Choose Your Shortcode">Choose Your Shortcode</span></h3><form  method="post" action="" class="shortcode-test">';
     $data = $data . '<div class="row-fluid"><div class="span4"><label for="shortcode-name-choose">Shortcode:</label></div><div class="span8">';
     
    	
    		$data = $data . '<select name="shortcode-name-choose" id="shortcode-name-choose" class="postform">';
    		foreach ($shortcodes_builder as $key2 => $value2) {
    			$include = 1;
    			foreach ($dont_include as  $dont_include_name) {
    				if($dont_include_name == $key2){
    					$include = 0; 
    				}
    				
    			}
    			
    			foreach ($dont_include_type as  $dont_include_name) {
    				if($dont_include_name == $value2['type']){
    					$include = 0; 
    				}
    				
    			}
    			
    			
    			if($include == 1){
    			if($current_value == $key2){
    				$selected= 'selected="selected"';
    			}else {
    				$selected= '';
    			}
    			$data = $data . '<option class="level-0" value="'.$key2.'" '.$selected.'>'.$key2.'</option>';
    			}
    			
    		}
    		$data = $data . '</select>';
    		$data = $data . '</div></div>';
    	
    		$data = $data . '<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Show Result"></form>';
    
    if($current=='yes'){
    	$data = $data . do_shortcode('<div class="clearfix"></div>[space][space][shortcode_test shortcode="'.$_POST['shortcode-name-choose'].'"]');
    }
    


    return $data;
}


/**
 * Shortcode: twitter
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_twitter($atts, $content = null) {
    
    
    $atts = shortcode_atts(array(
    	'consumerkey' => '',
    	'consumersecret' => '',
    	'accesstoken' => '',
    	'accesstokensecret' => '',
    	'cachetime' => '',
    	'username' => '',
    	'count' => '5'), $atts);


    //check if cache needs update
    	$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
    	$diff = time() - $tp_twitter_plugin_last_cache_time;
    	$crt = $atts['cachetime'] * 3600;
    	
    	$data = '';
     //	yes, it needs update			
    	if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){
    		
    		if(!require_once( get_template_directory() . '/library/includes/twitteroauth.php' )){ 
    			$data = $data . '<strong>Couldn\'t find twitteroauth.php!</strong>' ;
    			return;
    		}
    									  
    		$connection = getConnectionWithAccessToken($atts['consumerkey'], $atts['consumersecret'], $atts['accesstoken'], $atts['accesstokensecret']);
    		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$atts['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');
    		
    									
    		if(!empty($tweets->errors)){
    			if($tweets->errors[0]->message == 'Invalid or expired token'){
    				$data = $data . '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!';
    			}else{
    				$data = $data . '<strong>'.$tweets->errors[0]->message.'</strong>' ;
    			}
    			return;
    		}
    		
    		for($i = 0;$i <= count($tweets); $i++){
    			if(!empty($tweets[$i])){
    				$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
    				$tweets_array[$i]['text'] = $tweets[$i]->text;			
    				$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
    			}	
    		}							
    		
    		//save tweets to wp option 		
    			update_option('tp_twitter_plugin_tweets',serialize($tweets_array));							
    			update_option('tp_twitter_plugin_last_cache_time',time());
    			
    		$data = $data . '<!-- twitter cache has been updated! -->';
    	}
    	
    	
    						
    						
    						
    						$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
    						if(!empty($tp_twitter_plugin_tweets)){
    							$data = $data . '<div class="tp_recent_tweets"><ul>';
    								$fctr = '1';
    								foreach($tp_twitter_plugin_tweets as $tweet){								
    									$data = $data . '<li><span class="icon-twitter"> </span> <span>'.convert_links($tweet['text']).'</span><br /><a class="twitter_time" target="_blank" href="http://twitter.com/'.$atts['username'].'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></li>';
    									if($fctr == $atts['count']){ break; }
    									$fctr++;
    								}
    							
    							$data = $data . '</ul></div>';
    						}
	return $data;
}

add_shortcode('twitter', 'code125_twitter');


/**
 * Shortcode: flickr
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_flickr($atts, $content = null) {
	
	
	$atts = shortcode_atts(array('id' => '','count' =>'' ), $atts);
	
	$username = $atts['id'];
	
	$count = $atts['count'];
	
	$data = '<div class="flickr clearfix">'. parseFlickrFeed($username,$count) . '</div>';
	return $data;
	
}
function attr($s,$attrname) { // return html attribute
    preg_match_all('#\s*('.$attrname.')\s*=\s*["|\']([^"\']*)["|\']\s*#i', $s, $x);
    if (count($x)>=3) return $x[2][0]; else return "";
}
 
// id = id of the feed
// n = number of thumbs
function parseFlickrFeed($id,$n) {
    $url = "http://api.flickr.com/services/feeds/photos_public.gne?id={$id}&lang=it-it&format=rss_200";
    $s = file_get_contents($url);
    preg_match_all('#<item>(.*)</item>#Us', $s, $items);
    $out = "";
    for($i=0;$i<count($items[1]);$i++) {
        if($i>=$n) return $out;
        $item = $items[1][$i];
        preg_match_all('#<link>(.*)</link>#Us', $item, $temp);
        $link = $temp[1][0];
        preg_match_all('#<title>(.*)</title>#Us', $item, $temp);
        $title = $temp[1][0];
        preg_match_all('#<media:thumbnail([^>]*)>#Us', $item, $temp);
        $thumb = attr($temp[0][0],"url");
        $class_i = $i+1;
        if( $class_i % 3){
			$class='class=""';        
        }else{
        	$class='class="last_col"';
        }
        
        $out.="<a href='$link' $class target='_blank' title=\"".str_replace('"','',$title)."\"><img src='$thumb' alt=''/></a>";
    }
    return $out;
}


/**
 * Shortcode: googlemap_side
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */

function code125_googlemap_side($atts, $content = null) {
	
	add_action('wp_head', 'code125_gmaps_header');
	
	$atts = shortcode_atts(array('long' => '','lat' =>'' ), $atts);
	
	$data = '<div class="googlemap_side clearfix"><div class="width_55">'.do_shortcode('[googlemap lat="'.$atts['lat'].'" lon="'.$atts['long'].'" w="100%" h="400" z="17" ]').'</div><div class="width_45"><div class="strips"><div class="shine_2">'.do_shortcode($content).'</div></div></div></div>';
	
	return $data;
	
}

/**
 * Shortcode: googlemap
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */


function code125_googlemap($attr) {

   
   	?>
   	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false"></script>
   	<style type="text/css">
   	    .entry-content img {max-width: 100000%; /* override */}
   	</style> 
   	<?php
    // default atts
    $attr = shortcode_atts(array(
        'lat' => '0',
        'lon' => '0',
        'id' => 'map',
        'z' => '1',
        'w' => '400',
        'h' => '300',
        'maptype' => 'ROADMAP',
        'address' => '',
        'kml' => '',
        'kmlautofit' => 'yes',
        'marker' => '',
        'markerimage' => '',
        'traffic' => 'no',
        'bike' => 'no',
        'fusion' => '',
        'start' => '',
        'end' => '',
        'infowindow' => '',
        'infowindowdefault' => 'yes',
        'directions' => '',
        'hidecontrols' => 'false',
        'scale' => 'false',
        'scrollwheel' => 'false'
            ), $attr);

	if(!isset( $GLOBALS['map_count'] ) ){
		$GLOBALS['map_count'] = 1;
	}else {
		$GLOBALS['map_count']++;
	}
	
	 $attr['id'] = $attr['id'] . $GLOBALS['map_count'];
	 
	 
    $returnme = '
    <div id="' . $attr['id'] . '" class="googlemap" style="width:' . $attr['w'] . 'px;height:' . $attr['h'] . 'px;"></div>
	';

    


    $returnme .= '<script type="text/javascript">
    var map;
    function initialize() {
      var mapOptions = {
        zoom: ' . $attr['z'] . ',
        center: new google.maps.LatLng(' . $attr['lat'] . ', ' . $attr['lon'] . '),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("' . $attr['id'] . '"),
          mapOptions);
    }
    
    google.maps.event.addDomListener(window, \'load\', initialize); </script>';

    return $returnme;
}
/**
 * Shortcode: social_box
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_social_box($atts, $content = null) {
	
    global $wpdb;

    $data = '<div class="social_box_count clearfix">';
    //Facebook
    $facebook_id = ot_get_option( 'facebook' );
    if ($facebook_id) {

        $fb_count = code125_fb_fan_count($facebook_id);
        if (is_numeric($facebook_id)) {
			$data = $data . '<div class="count facebook_count"><a class="clearfix" href="https://www.facebook.com/profile.php?id=' . $facebook_id . '"><span class="social-box-top icon-facebook"></span><span class="social-box-bottom">' . custom_number_format($fb_count) . '</span></a></div>' ;
            
        } else {        
        	$data = $data . '<div class="count facebook_count"><a class="clearfix" href="https://www.facebook.com/' . $facebook_id . '"><span class="social-box-top icon-facebook"></span><span class="social-box-bottom">' . custom_number_format($fb_count) . '</span></a></div>' ;  
        	
            
        }
    }
    
    
    //twitter
    $twitter_id = ot_get_option( 'twitter' );
    if ($twitter_id) {
        $tw_count = code125_twitter_followers($twitter_id);
        
        $data = $data . '<div class="count twitter_count"><a class="clearfix" href="https://www.twitter.com/' . $twitter_id . '"><span class="social-box-top icon-twitter"></span><span class="social-box-bottom">' . custom_number_format($tw_count) . '</span></a></div>' ;
       
    }
    //RSS
    $rss_id = ot_get_option( 'rss' );
    if ($rss_id) {

		

        $data = $data . '<div class="count rss_count"><a class="clearfix" href="' . $rss_id . '"><span class="social-box-top icon-rss"></span><span class="social-box-bottom">' . __('Follow','code125') . '</span></a></div>' ;
        
        
      
    }
    $comments_count_enable = ot_get_option( 'comments_count_enable' );
    
    if($comments_count_enable !='no'){
    $numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
    
    
    $fb_comments = get_option('total_fb_comment_count');
    
    if($fb_comments==''){
    	$fb_comments = 0;
    }
	$numcomms = $numcomms + $fb_comments;
	
	$data = $data . '<div class="count comments_count"><a class="clearfix" href="' . home_url() . '"><span class="social-box-top icon-comment"></span><span class="social-box-bottom">' . custom_number_format($numcomms) . '</span></a></div>' ;
	}

        $data = $data . '</div>';


    
    return $data;
}


/**
 * Shortcode: today
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_today($atts, $content = null) {

return date_i18n(get_option('date_format'));
}


/**
 * Shortcode: social_bar
 *
 * @param array $atts Shortcode attributes
 * @param string $content
 * @return string Output html
 */
function code125_social_bar($atts, $content = null) {

    $data = '<div id="social_icons" class="clearfix">';
    	
    	$social_icons = ot_get_option('social_icons');
    	if(is_array($social_icons)){
    	foreach ($social_icons as $social_icon) {
    	
    		
    	if($social_icon['type'] == 'search' ){
    	
    	
    	
    	$data = $data .'<div title="'. $social_icon['title'].'" class="element '. $social_icon['type'].' dropdown"><a class="'. $social_icon['icon'] .' dropdown-toggle" data-toggle="dropdown"  href="#"></a>';
    	
    	$data = $data .'<form role="search" method="get" id="searchform" action="'. home_url( '/' ).'" class="dropdown-menu" ><div class="input-wrap"><input class="element-block " type="text" value="'. get_search_query() .'" name="s" id="s" placeholder="'. __('Type and Hit Enter','code125') .'" /><span class=" icon-search"></span></div>';
    	
    	
    	 $search_cat = ot_get_option('search_cat');
    	 if($search_cat == 'yes'){
    	 $post_type = ot_get_option('search_post');
    	 
    	 $tax = get_tax_by_type($post_type );
    	 
    	 $terms=get_terms($tax);
    	 	$data = $data. '<select  name="'.$tax.'" id="'.$tax.'">';
    	 	$data = $data. '<option value="">' .  __('All Categories','code125'). '</option>';
    	 foreach ($terms as $term) {
			if(isset($_GET[$tax])){
			$select = $_GET[$tax];
			}else {
				$select = '';
			}
			$selected =  $select ==$term->term_id ? ' selected="selected"' : '';
			$data = $data .'<option value="' . $term->term_id . '" ' .$selected. '>' . $term->name . '</option>';
				
		 }
    	 $data = $data .'</select>';
    	 }
    	 $data = $data .'</form></div>';
    	
    	
    	
    	}elseif ( $social_icon['type'] == 'languages') {
		    if(function_exists('icl_get_languages')){
		    $data = $data .'<div title="'. $social_icon['title'].'" class="element '. $social_icon['type'].' dropdown">
		    	<a class="'. $social_icon['icon'].' dropdown-toggle" data-toggle="dropdown"  href="#"></a>';
		    
		    $data = $data . '<div class="dropdown-menu">';
		    
		    
		    
		    $languages = icl_get_languages('skip_missing=0&orderby=custom');
		    if(!empty($languages)){
		        foreach($languages as $l){
		            $data = $data . '<div class="language-class">';
		            if($l['country_flag_url']){
		                if(!$l['active']) $data = $data . '<a href="'.$l['url'].'">';
		                $data = $data . '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
		                if(!$l['active']) $data = $data . '</a>';
		            }
		            if(!$l['active']) $data = $data . '<a href="'.$l['url'].'">';
		            $data = $data . icl_disp_language($l['native_name'], $l['translated_name']);
		            if(!$l['active']) $data = $data . '</a>';
		            $data = $data . '</div>';
		        }
		    }
		    $data = $data .'</div></div>';
		    }
		
	}elseif($social_icon['type'] == 'account'){
    
    	
    	$data = $data .'<div title="'. $social_icon['title'].'" class="element '. $social_icon['type'].' dropdown">
    		<a class="'. $social_icon['icon'].' dropdown-toggle" data-toggle="dropdown"  href="#"></a>';
    	
    	$data = $data . get_login_form('dropdown-menu');
    	
    	$data = $data .'</div>';
    	
    
    	
    	}elseif($social_icon['type'] == 'email'){
    	
    	$data = $data .'<div title="'. $social_icon['title'].'" class="element'.  $social_icon['type'].'"><a target="_blank" class="'. $social_icon['icon'].'"  href="mailto:'. $social_icon['link'].'"></a></div>';
    	
    
    	}else{
    	
    	$data = $data .'<div title="'. $social_icon['title'].'" class="element '. $social_icon['type'].'"><a target="_blank" class="'. $social_icon['icon'].'"  href="'. $social_icon['link'].'"></a></div>';
    	
    	} }
    	}
    
    $data = $data .'</div><div class="clearfix"></div>';    return $data;
}


function code125_twitter_followers($username) {
	
	
	
	
	$cache = get_transient('twitterfollowerscount' . $username);
	
	if ($cache) {
	    $count = get_option('twitterfollowerscount' . $username);
	    if($count ==0){
	    	$url = 'http://twitter.com/users/show/' . urlencode($username);
	    	$xml=file_get_contents($url);
	    	if (preg_match('/followers_count>(.*)</',$xml,$match)!=0) {
	    	$count = $match[1];
	    	}
	    	set_transient('twitterfollowerscount' . $username, 'true',  60 * 30);
	    	update_option('twitterfollowerscount' . $username, $count);
	    }
	} else {
		$url = 'http://twitter.com/users/show/' . urlencode($username);
		$xml=file_get_contents($url);
		if (preg_match('/followers_count>(.*)</',$xml,$match)!=0) {
		$count = $match[1];
		}
		set_transient('twitterfollowerscount' . $username, 'true',  60 * 30);
		update_option('twitterfollowerscount' . $username, $count);
	}
 return $count;
}

function code125_fb_fan_count($fb_id) {

    $count = 0;
    
    $cache = get_transient('facebook_count_' . $fb_id);
	if ($cache) {
	    $count = get_option('facebook_count_' . $fb_id);
	    if($count ==0){
	    	if (is_numeric($fb_id)) {
	    	    $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=' . $fb_id . '');
	    	} else {
	    	    $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20username="' . $fb_id . '"');
	    	}
	    	if (is_wp_error($data)) {
	    	    return 'Error getting number';
	    	} else {
	    	    $count = strip_tags($data['body']);
	    	}
	    	
	    	set_transient('facebook_count_' . $fb_id, 'true',  60 * 30);
	    	update_option('facebook_count_' . $fb_id, $count);
	    }
	} else {
		if (is_numeric($fb_id)) {
		    $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=' . $fb_id . '');
		} else {
		    $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20username="' . $fb_id . '"');
		}
		if (is_wp_error($data)) {
		    return 'Error getting number';
		} else {
		    $count = strip_tags($data['body']);
		}
		
		set_transient('facebook_count_' . $fb_id, 'true',  60 * 30);
		update_option('facebook_count_' . $fb_id, $count);
	}
	
    
    return $count;
}

function code125_fb_count($fb_user) {

    $url = 'https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=' . urlencode($fb_user);
    
    
    $result = wp_remote_retrieve_body(wp_remote_get($url));
	
	$data = json_decode($result);

$xml = new SimpleXMLElement(stripslashes($result));
			$status = $xml->attributes();
			
			if ($status == 'ok') {
				$count = $xml->feed->entry->attributes()->circulation;
			} else {
				$count = 0; // fallback
			}

    return $count;
}

function code125_fb_count_run($feed) {

    $fb_subs = code125_fb_count($feed);
    $fb_option = "code125_fb_sub_value";
    $fb_subscount = get_option($fb_option);
    if (is_null($fb_subs)) {
        return $fb_subscount;
    } else {
        update_option($fb_option, $fb_subs);
        return $fb_subs;
    }
}

function code125_fb_sub_value($feed) {

    return code125_fb_count_run($feed);
}


/* Register oEmbed provider
   -------------------------------------------------------------------------- */

wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);


/* Register SoundCloud shortcode
   -------------------------------------------------------------------------- */



/**
 * SoundCloud shortcode handler
 * @param  {string|array}  $atts     The attributes passed to the shortcode like [soundcloud attr1="value" /].
 *                                   Is an empty string when no arguments are given.
 * @param  {string}        $content  The content between non-self closing [soundcloud]…[/soundcloud] tags.
 * @return {string}                  Widget embed code HTML
 */
function code125_soundcloud($atts, $content = null) {

  // Custom shortcode options
  $shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());

  // Turn shortcode option "param" (param=value&param2=value) into array
  $shortcode_params = array();
  if (isset($shortcode_options['params'])) {
    parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
  }
  $shortcode_options['params'] = $shortcode_params;

  // User preference options
  $plugin_options = array_filter(array(
    'iframe' => code125_soundcloud_get_option('player_iframe', true),
    'width'  => code125_soundcloud_get_option('player_width'),
    'height' =>  code125_soundcloud_url_has_tracklist($shortcode_options['url']) ? code125_soundcloud_get_option('player_height_multi') : code125_soundcloud_get_option('player_height'),
    'params' => array_filter(array(
      'auto_play'     => code125_soundcloud_get_option('auto_play'),
      'show_comments' => code125_soundcloud_get_option('show_comments'),
      'color'         => code125_soundcloud_get_option('color'),
      'theme_color'   => code125_soundcloud_get_option('theme_color'),
    )),
  ));
  // Needs to be an array
  if (!isset($plugin_options['params'])) { $plugin_options['params'] = array(); }

  // plugin options < shortcode options
  $options = array_merge(
    $plugin_options,
    $shortcode_options
  );

  // plugin params < shortcode params
  $options['params'] = array_merge(
    $plugin_options['params'],
    $shortcode_options['params']
  );

	if (isset($options['id'])) {
		$options['url'] = trim('http://api.soundcloud.com/tracks/'. $options['id']);
	}else{
  // The "url" option is required
  		if (!isset($options['url'])) {
    	   	return '';
    	} else {
    		$options['url'] = trim($options['url']);
  		}
  	}

  // Both "width" and "height" need to be integers
  if (isset($options['width']) && !preg_match('/^\d+$/', $options['width'])) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
  }
  if (isset($options['height']) && !preg_match('/^\d+$/', $options['height'])) { unset($options['height']); }

  // The "iframe" option must be true to load the iframe widget
  $iframe = code125_soundcloud_booleanize(true)
    // Default to flash widget for permalink urls (e.g. http://soundcloud.com/{username})
    // because HTML5 widget doesn’t support those yet
    ? preg_match('/api.soundcloud.com/i', $options['url'])
    : false;

  // Return html embed code
  if ($iframe) {
    return code125_soundcloud_iframe_widget($options);
  } else {
    return code125_soundcloud_flash_widget($options);
  }

}

/**
 * Plugin options getter
 * @param  {string|array}  $option   Option name
 * @param  {mixed}         $default  Default value
 * @return {mixed}                   Option value
 */
function code125_soundcloud_get_option($option, $default = false) {
  $value = get_option('code125_soundcloud_' . $option);
  return $value === '' ? $default : $value;
}

/**
 * Booleanize a value
 * @param  {boolean|string}  $value
 * @return {boolean}
 */
function code125_soundcloud_booleanize($value) {
  return is_bool($value) ? $value : $value === 'true' ? true : false;
}

/**
 * Decide if a url has a tracklist
 * @param  {string}   $url
 * @return {boolean}
 */
function code125_soundcloud_url_has_tracklist($url) {
  return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

/**
 * Parameterize url
 * @param  {array}  $match  Matched regex
 * @return {string}          Parameterized url
 */
function code125_soundcloud_oembed_params_callback($match) {
  global $code125_soundcloud_oembed_params;

  // Convert URL to array
  $url = parse_url(urldecode($match[1]));
  // Convert URL query to array
  parse_str($url['query'], $query_array);
  // Build new query string
  $query = http_build_query(array_merge($query_array, $code125_soundcloud_oembed_params));

  return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
}

/**
 * Iframe widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Iframe embed code
 */
function code125_soundcloud_iframe_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://w.soundcloud.com/player?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (code125_soundcloud_url_has_tracklist($options['url']) ? '450' : '166');

  return sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
}

/**
 * Legacy Flash widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Flash embed code
 */
function code125_soundcloud_flash_widget($options) {

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (code125_soundcloud_url_has_tracklist($options['url']) ? '255' : '81');

  return preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object>', $width, $height, $url, $width, $height, $url));
}






?>