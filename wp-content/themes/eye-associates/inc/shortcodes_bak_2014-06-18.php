<?php
/*********************************************
// Available Shortcodes

[home_url]
[site_url]
[admin_url]
[network_home_url]
[network_site_url]
[network_admin_url]
[content_url]
[plugins_url]
[wp_upload_dir]
[get_template_directory_uri]
[get_stylesheet_directory_uri]
[get_stylesheet_uri]
[get_theme_root_uri]
[year]
[site_title]
[permalink]
[title]
[template_url]
[stylesheet_url]
[container]

*********************************************/

function func_home_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => null
	), $atts ) );

	return home_url( $path, $scheme );
}
add_shortcode( 'home_url', 'func_home_url' );

function func_site_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => null
	), $atts ) );

	return site_url( $path, $scheme );
}
add_shortcode( 'site_url', 'func_site_url' );

function func_admin_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => 'admin'
	), $atts ) );

	return admin_url( $path, $scheme );
}
add_shortcode( 'admin_url', 'func_admin_url' );

function func_network_home_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => null
	), $atts ) );

	return network_home_url( $path, $scheme );
}
add_shortcode( 'network_home_url', 'func_network_home_url' );

function func_network_site_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => null
	), $atts ) );

	return network_site_url( $path, $scheme );
}
add_shortcode( 'network_site_url', 'func_network_site_url' );

function func_network_admin_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'scheme' => 'admin'
	), $atts ) );

	return network_admin_url( $path, $scheme );
}
add_shortcode( 'network_admin_url', 'func_network_admin_url' );

function func_content_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => ''
	), $atts ) );

	return content_url( $path );
}
add_shortcode( 'content_url', 'func_content_url' );

function func_plugins_url( $atts ) {
	extract( shortcode_atts( array(
		'path' => '',
		'plugin' => ''
	), $atts ) );

	return plugins_url( $path, $plugin );
}
add_shortcode( 'plugins_url', 'func_plugins_url' );

function func_wp_upload_dir( $atts ) {
	extract( shortcode_atts( array(
		'key' => 'baseurl'
	), $atts ) );

	$upload_dir = wp_upload_dir();
	return $upload_dir[$key];
}
add_shortcode( 'wp_upload_dir', 'func_wp_upload_dir' );

function func_get_template_directory_uri() {
	return get_template_directory_uri();
}
add_shortcode( 'get_template_directory_uri', 'func_get_template_directory_uri' );

function func_get_stylesheet_directory_uri() {
	return get_stylesheet_directory_uri();
}
add_shortcode( 'get_stylesheet_directory_uri', 'func_get_stylesheet_directory_uri' );

function func_get_stylesheet_uri() {
	return get_stylesheet_uri();
}
add_shortcode( 'get_stylesheet_uri', 'func_get_stylesheet_uri' );

function func_get_theme_root_uri() {
	return get_theme_root_uri();
}
add_shortcode( 'get_theme_root_uri', 'func_get_theme_root_uri' );

function func_current_year() {
	return date('Y');
}
add_shortcode( 'year', 'func_current_year' );

function func_site_title() {
	return esc_attr( get_bloginfo( 'name', 'display' ) );
}
add_shortcode( 'site_title', 'func_site_title' );

function func_permalink() {
	return esc_attr( get_permalink() );
}
add_shortcode('permalink', 'func_permalink');

function func_title() {
	return esc_attr( get_the_title() );
}
add_shortcode('title', 'func_title');

function func_template_url() {
	return esc_url( get_template_directory_uri() );
}
add_shortcode('template_url', 'func_template_url');

function func_stylesheet_url() {
	return esc_url( get_stylesheet_directory_uri() );
}
add_shortcode('stylesheet_url', 'func_stylesheet_url');

function func_container($params, $content = ''){
	extract(shortcode_atts(array(
        'background_color'=> 'F9F7F7',
        'color'           => '',
        'class'           => '',
        'id'              => '',
        'nomargin_top'    => false,
        'nomargin_bottom' => false,
		'nopadding_top'   => false,
		'nopadding_bottom'=> false,
    ), $params));
	
	$style = 'style="';
	$style .= ' background-color:#'.$background_color.';';
	if( !empty($color) ){
		$style .= ' color:#'.$color.';';
	}
	$style .= '"';
	
	$container_wrap_class = '';
	if( $nomargin_top ){
		$container_wrap_class .= ' nomargin_top';
	}
	if( $nomargin_bottom ){
		$container_wrap_class .= ' nomargin_bottom';
	}
	if( $nopadding_top ){
		$container_wrap_class .= ' nopadding_top';
	}
	if( $nopadding_bottom ){
		$container_wrap_class .= ' nopadding_bottom';
	}
	if( $class ){
		$container_wrap_class .= ' '.$class;
	}
	if( $id ){
		$id = 'id="'.$id.'"';
	}
	$result = '<div '.$id.' class="content-container'.$container_wrap_class.'" '.$style.'>';
		$result .= '<div class="container">';
			$result .= do_shortcode($content);
		$result .= '</div>';
	$result .= '</div>';
	return $result;
}
add_shortcode('container', 'func_container');

function func_container_fluid($params, $content = ''){
	extract(shortcode_atts(array(
		'background_color'=> 'F9F7F7',
		'color'           => '',
        'class'           => '',
		'nomargin_top'    => false,
		'nomargin_bottom' => false,
		'nopadding_top'   => false,
		'nopadding_bottom'=> false,
    ), $params));
	
	$style = 'style="';
	$style .= ' background-color:#'.$background_color.';';
	if( !empty($color) ){
		$style .= ' color:#'.$color.';';
	}
	$style .= '"';
	
	$container_wrap_class = '';
	if( $nomargin_top ){
		$container_wrap_class .= ' nomargin_top';
	}
	if( $nomargin_bottom ){
		$container_wrap_class .= ' nomargin_bottom';
	}
	if( $nopadding_top ){
		$container_wrap_class .= ' nopadding_top';
	}
	if( $nopadding_bottom ){
		$container_wrap_class .= ' nopadding_bottom';
	}
	
	$result = '<div class="content-container'.$container_wrap_class.'" '.$style.'>';
		$result .= '<div class="container-fluid '.$class.'">';
			$result .= do_shortcode($content);
		$result .= '</div>';
	$result .= '</div>';
	return $result;
}
add_shortcode('container_fluid', 'func_container_fluid');

function ea_button_function( $params ){
	extract(shortcode_atts(array(
		'link'        => '#',
		'title'       => 'click here',
		'color'       => 'A5C73C',
		'size'        => 'small',
		'class'       => '',
		'transparent' => false,
	), $params));
	
	$color = '#' . $color;
	if( $transparent ){
		$color = 'rgba(255, 255, 255, 0.2)';
	}
	
	$result = '<a href="' . $link . '" class="ea-btn-' . $size . ( $class ? ' '.$class : '' ) . '" style="background-color:' . $color . ';">';
		$result .= $title;
	$result .= '</a>';
	
	return $result;
}
add_shortcode('ea_button', 'ea_button_function');

function appointments_address_func($params){
	extract(shortcode_atts(array(
		'exclude' => '',
	), $params));
	$result = '';
	
	ob_start();
	?>
	<div class="appointments_address_display">
		<?php
		$my_query_args = array(
			'post_type'=> 'location',
			'orderby'  => 'date',
			'order'    => 'ASC',
			'post__not_in' => array( $exclude ),
		);
		$my_query = new WP_Query( $my_query_args );
		
		if ( $my_query->have_posts() ){
			?>
			<div class="appointments_select_location_wrapper">
				<select name="select_location" class="appointments_select_location">
					<option value="" data-location_id="address_blank">Select your location</option>
					<?php
					$post_count = 0;
					while ($my_query->have_posts()){
						$my_query->the_post();
						$post_count++;
						?>
						<option value="<?php echo get_the_ID();?>" data-location_id="address_<?php echo get_the_ID();?>"><?php echo the_title();?></option>
						<?php
					}
					?>
				</select>
			</div>
			<span class="location-q bs-popover" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Select your location from the drop down menu and you will then be displayed the various appointment request options available to you (phone, email or online request).">
				<i class="fa fa-question-circle"></i>
			</span>
			<div class="address_detail">
				<?php
				/*
				$post_count = 0;
				while ($my_query->have_posts()){
					$my_query->the_post();
					$post_count++;
					
					if( $post_count == 1 ){
						?>
							<div class="address_link">
								<?php
								$location_appointment_url = get_field('location_appointment_url');
								if( !$location_appointment_url ){
									$location_appointment_url = '#';
								}
								?>
								<a style="background-color:#CACACA;" class="ea-btn-large" href="<?php echo $location_appointment_url;?>" target="_blank">book appointment</a><br />
							</div>
							<div class="address_title">
								<h2>
									<?php
									$location_title = get_field('location_title');
									if( !$location_title ){
										$location_title = get_the_title();
									}
									echo $location_title;
									?>
								</h2>
							</div>
							<div class="address_contacts">
								<span class="address_contacts_phone">
									<span class="address_contacts_label">Phone:</span>
									<?php $location_phone_number = get_field('location_phone_number');?>
									<span class="address_contacts_data"><?php echo $location_phone_number;?></span>
								</span>
								<span class="address_contacts_fax">
									<span class="address_contacts_label">Fax:</span>
									<?php $location_fax_number = get_field('location_fax_number');?>
									<span class="address_contacts_data"><?php echo $location_fax_number;?></span>
								</span>
								<span class="address_contacts_email">
									<span class="address_contacts_data">
										<?php $location_email = get_field('location_email');?>
										<a class="green" href="mailto:<?php echo $location_email;?>">Email Us</a>
									</span>
								</span>
							</div>
						<?php
					}
				}
				*/
				?>
			</div>
			<div class="address_details" style="display:none;">
				<div id="address_blank">&nbsp;</div>
				<?php
				while ($my_query->have_posts()){
					$my_query->the_post();
					?>
					<div id="address_<?php echo get_the_ID();?>">
						<div class="address_link">
							<?php
							$location_appointment_url2 = get_field('location_appointment_url');
							if( !$location_appointment_url2 ){
								$location_appointment_url2 = '#';
							}
							?>
							<a style="background-color:#CACACA;" class="ea-btn-large" href="<?php echo $location_appointment_url2;?>">book appointment</a>
						</div>
						<div class="address_title">
							<h2>
								<?php
								$location_title = get_field('location_title');
								if( !$location_title ){
									$location_title = get_the_title();
								}
								echo $location_title;
							?>
							</h2>
						</div>
						<div class="address_contacts">
							<span class="address_contacts_phone">
								<span class="address_contacts_label">Phone:</span>
							<?php $location_phone_number2 = get_field('location_phone_number');?>
								<span class="address_contacts_data"><?php echo $location_phone_number2;?></span>
							</span>
							<span class="address_contacts_fax">
								<span class="address_contacts_label">Fax:</span>
								<?php $location_fax_number2 = get_field('location_fax_number');?>
								<span class="address_contacts_data"><?php echo $location_fax_number2;?></span>
							</span>
							<span class="address_contacts_email">
								<span class="address_contacts_data">
									<?php $location_email2 = get_field('location_email');?>
									<a class="green" href="mailto:<?php echo $location_email2;?>">Email Us</a>
								</span>
							</span>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		// Reset Query
		wp_reset_postdata();
		?>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.appointments_address_display .appointments_select_location').change(function() {
			location_id = $(this).val();
			/*
			if( location_id !== '' ){
				$('.address_detail').html($('.address_details #address_'+location_id).clone());
			}
			*/
			$('.address_detail').html($('.address_details #address_'+location_id).clone());
		});
	});
	</script>
	<?php
	$result .= ob_get_clean();
	// $result .= 'ssssssss';
	
	return $result;
}
add_shortcode('appointments_address', 'appointments_address_func');

/*
function location_menu_func_dump($params, $content = ''){
	extract(shortcode_atts(array(
		'style'           => 'default',
		'color'           => '',
		'class'           => '',
		'nomargin_top'    => false,
		'nomargin_bottom' => false,
		'nopadding_top'   => false,
		'nopadding_bottom'=> false,
    ), $params));

$key = md5(microtime().rand());
ob_start();
/ *
?>
<span class="location_menu_wrapper">
<span class="location_menu">
<span class="location_menu_label">Click Here</span>
<span class="location_menu_data">
	<ul class="location_menu">
		<li><a href="mailto:dinesh4monto@gmail.com">Overland Park</a></li>
		<li><a href="#">Shawnee</a></li>
		<li><a href="#">Prairie Village</a></li>
		<li><a href="#">Leawood</a></li>
		<li><a href="#">Olathe</a></li>
	</ul>
</span>
</span>
</span>
<?php
* /
$my_query_args = array(
	'post_type'=> 'location',
	'orderby'  => 'date',
	'order'    => 'ASC',
);
$my_query = new WP_Query( $my_query_args );

if ( $my_query->have_posts() ){
	?>
	<span class="hover_menu_wrapper style-default">
	<span class="hover_menu" data-toggle="popover" data-trigger="hover" data-title="" data-placement="bottom" data-popover_data_key="<?php echo $key;?>">Click Here</span>
	<div id="<?php echo $key;?>" class="popover_data" style="display:none;">
		<ul class="location_data">
			<?php
			while ($my_query->have_posts()){
				$my_query->the_post();
				
				$location_title        = get_the_title();
				$location_phone_number = get_field('location_phone_number');
				$location_fax_number   = get_field('location_fax_number');
				$location_email        = get_field('location_email');
				?>
				<li>
					<?php echo $location_title;?><br>
					<?php echo $location_phone_number;?><br>
					<?php echo $location_fax_number;?><br>
					<?php echo $location_email;?><br>
				</li>
				<?php
				}
			?>
		</ul>
	</div>
	</span>
	<?php
}
// Reset Query
wp_reset_postdata();

	$result .= ob_get_clean();
	return $result;
}
*/

function location_menu_func($params){
	extract(shortcode_atts(array(
		'title'           => '',
		'style'           => 'default',  // default, red
		'data'            => 'link',     // link, phone, fax, email, appointment
		'class'           => '',
		'icon'            => 'false',    // true, false, any font-awesome icon
		'color'           => 'A7C73B'
    ), $params));
	
	$key = md5(microtime().rand());
	ob_start();
	$location_data_args = array(
		'post_type'=> 'location',
		'orderby'  => 'date',
		'order'    => 'ASC',
	);
	$location_data = new WP_Query( $location_data_args );
	
	if ( $location_data->have_posts() ){
	?>
	<span class="hover_menu_wrapper style-<?php echo $style;?> data-<?php echo $data;?>">
		<span class="hover_menu_label" data-toggle="popover" data-trigger="hover" data-title="" data-placement="bottom" data-popover_data_key="<?php echo $key;?>" style="color:#<?php echo $color;?>;">
			<?php
			$text = '';
			if( !$title && $icon == 'false' ){
				$text .= 'click here.';
			}
			if( $title ){
				$text .= $title;
			}
			if( $icon != 'false' ){
				if( $title ){
					$text .= ' ';
				}
				if( $icon != 'true' ){
					$text .= '<i class="fa fa-'.$icon.'"></i>';
				}else{
					$text .= '<i class="fa fa-plus-circle"></i>';
				}
			}
			echo $text;
			?>
		</span>
		<span id="<?php echo $key;?>" class="hover_menu_data_wrapper" style="display:none;">
			<span class="hover_menu">
				<?php
				while ($location_data->have_posts()){
					$location_data->the_post();
					
					$post_id = $post->ID;
					
					$location_title           = get_the_title();
					$location_link            = get_permalink();
					$location_phone_number    = get_field('location_phone_number');
					$location_fax_number      = get_field('location_fax_number');
					$location_email           = get_field('location_email');
					$location_appointment_url = get_field('location_appointment_url', $post_id);
					?>
					<span class="hover_menu_item">
						<?php
						if( $data == 'link' ){
							echo '<a href="'.$location_link.'">'.$location_title.'</a>';
						}elseif( $data == 'email' ){
							echo '<a href="mailto:'.$location_email.'">'.$location_title.'</a>';
						}elseif( $data == 'fax' ){
							echo '<span class="location_name">'.$location_title.'</span>: <span class="location_fax">'.$location_fax_number.'</span>';
						}elseif( $data == 'phone' ){
							echo '<span class="location_name">'.$location_title.'</span>: <span class="location_fax"><a href="tel:'.$location_phone_number.'">'.$location_phone_number.'</a></span>';
						}elseif( $data == 'appointment' ){
							echo '<a href="'.$location_appointment_url.'">'.$location_title.'</a>';
						}else{
							echo '<a href="'.$location_link.'">'.$location_title.'</a>';
						}
						?>
					</span>
					<?php
				}
				?>
			</span>
		</span>
	</span>
	<?php
	}
	// Reset Query
	wp_reset_postdata();
	
	$result .= ob_get_clean();
	return $result;
}
add_shortcode('location_menu', 'location_menu_func');


function home_locations_func(){
	ob_start();
	?>
	<div class="inner-locations-wrapper">
		<?php
		get_template_part( 'content/content', 'home-locations' );
		?>
	</div>
	<?php
	$result .= ob_get_clean();
	return $result;
}
add_shortcode('home_locations', 'home_locations_func');

function home_doctors_func(){
	ob_start();
	query_posts( array(
		'post_type'=> 'doctor',
		'orderby'  => 'date',
		'order'    => 'ASC',
	));
	if ( have_posts() ){
		?>
		<div class="home-doctors">
			<?php
			while ( have_posts() ) {
				the_post();
				
				$post_id = $post->ID;
				
				if( has_post_thumbnail( $post_id ) ){
					$block_image_size   = 'doctor_home';
					$block_image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $child_id ), $block_image_size );
					$block_image_src    = $block_image_data[0];
					$block_image_width  = $block_image_data[1];
					$block_image_height = $block_image_data[2];
				}else{
					$block_image_src    = get_stylesheet_directory_uri().'/images/default/doctor_home_174x174.png';
					$block_image_width  = '174';
					$block_image_height = '74';
				}
				$location_email = get_field('location_email');
				?>
				<div class="home-doctor">
					<div class="home-doctor-image">
						<a href="<?php echo get_permalink();?>">
							<img alt="<?php echo get_the_title();?>" class="doctor-image" src="<?php echo $block_image_src;?>">
						</a>
					</div>
					<div class="home-doctor-link">
						<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php
			}
			?>
			<div class="clearfix"></div>
		</div>
		<?php
	}
	// Reset Query
	wp_reset_query();
	$result .= ob_get_clean();
	return $result;
}
add_shortcode('home_doctors', 'home_doctors_func');
?>