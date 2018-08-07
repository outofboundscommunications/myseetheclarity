<?php
	
	/*
	  Plugin Name: Code125 Shortcodes Generator
	  Plugin URI: http://example.com/
	  Version: 1.0
	  Author: Author Name
	  Author URI: http://example.com/
	  Description: Plugin description
	  Text Domain: code125
	  Domain Path: /languages
	  License: GPL3
	 */
	
	
	function code125_shortcodes($name) {
		$_code125_shortcodes = get_option('_code125_shortcodes');
		foreach ( $_code125_shortcodes as $shortcode => $params ) {
			if ( $params['name'] == $name ){
				return $params;
			}
		}
	}
	
	
	/**
	 * Plugin initialization
	 */
	function code125_shortcode_plugin_init() {

		// Enable shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode' );

		
		

		// Fix for large posts, http://core.trac.wordpress.org/ticket/8553
		@ini_set( 'pcre.backtrack_limit', 500000 );

		// Register styles
		wp_register_style( 'shortcodes-generator', code125_plugin_url() . '/css/generator.css', false, 1.0, 'all' );
		
		
		
		// Register scripts
		wp_register_script( 'shortcodes', code125_plugin_url() . '/js/init.js', array( 'jquery' ), 1.0, false );
		wp_register_script( 'shortcodes-generator', code125_plugin_url() . '/js/generator.js', array( 'jquery' ), 1.0, false );
		

		
		// Scipts and stylesheets for editing pages (shortcode generator popup)
		if ( is_admin() ) {

			// Get current page type
			global $pagenow;

			// Pages for including
			$code125_generator_includes_pages = array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php', 'widgets.php','themes.php' );

			if ( in_array( $pagenow, $code125_generator_includes_pages ) ) {
				// Enqueue styles
				
				wp_enqueue_style( 'shortcodes-generator' );


				// Enqueue scripts
				wp_enqueue_script( 'shortcodes-generator' );
			}
		}
		
		
		
		
		$_code125_shortcodes = get_option('_code125_shortcodes');
		
		
		// Register shortcodes
		if(is_array($_code125_shortcodes)){
			foreach ( $_code125_shortcodes as $shortcode => $params ) {
				if ( $params['type'] != 'opengroup' && $params['type'] != 'closegroup' )
					add_shortcode( $shortcode, 'code125_' . $shortcode );
			}
		}
	}

	add_action( 'init', 'code125_shortcode_plugin_init', 500 );

	
	/**
	 * Returns current plugin url
	 *
	 * @return string Plugin url
	 */
	function code125_plugin_url() {
		return trailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Shortcode names prefix in compatibility mode
	 *
	 * @return string Special prefix
	 */
	function code125_compatibility_mode_prefix() {
		$prefix = 'code125_';
		return $prefix;
	}

	
	/*
	 * Custom shortcode function for nested shortcodes code125pport
	 */

	function code125_do_shortcode( $content, $modifier ) {
		if ( strpos( $content, '[_' ) !== false ) {
			$content = preg_replace( '@(\[_*)_(' . $modifier . '|/)@', "$1$2", $content );
		}
		return do_shortcode( $content );
	}

		


	/**
	 * Add generator button to Upload/Insert buttons
	 */
	function code125_add_generator_button( $page = null, $target = null ) {
		echo '<a href="#TB_inline?width=640&height=600&inlineId=code125-generator-wrap" class="thickbox" title="' . __( 'Insert shortcode', 'code125-admin' ) . '" data-page="' . $page . '" data-target="' . $target . '"><img src="' . code125_plugin_url() . '/images/admin/media-icon.png" alt="" /></a>';
	}
	

	add_action( 'media_buttons', 'code125_add_generator_button', 100 );

	/**
	 * Generator popup box
	 */
	function code125_generator_popup() {
		?>
		<div id="code125-generator-wrap" style="display:none">
			<div id="code125-generator">
				<div id="code125-generator-shell">
					<div id="code125-generator-header">
						<select id="code125-generator-select" data-placeholder="<?php _e( 'Select shortcode', 'code125-admin' ); ?>" data-no-recode125lts-text="<?php _e( 'Shortcode not found', 'code125-admin' ); ?>" class="option-tree-ui-select ">
							<option value="raw"><?php _e( 'Select shortcode', 'code125-admin' ); ?></option>
							<?php
							$_code125_shortcodes = get_option('_code125_shortcodes');
							foreach ( $_code125_shortcodes as $name => $shortcode ) {

								// Open optgroup
								if ( $shortcode['type'] == 'opengroup' )
									echo '<optgroup label="' . $shortcode['name'] . '">';

								// Close optgroup
								elseif ( $shortcode['type'] == 'closegroup' )
									echo '</optgroup>';

								// Option
								else
									echo '<option value="' . $name . '">' .  $shortcode['name']  . '</option>';
							}
							?>
						</select>
					</div>
					<div id="code125-generator-settings"></div>
					<input type="hidden" name="code125-generator-url" id="code125-generator-url" value="<?php echo code125_plugin_url(); ?>" />
					<input type="hidden" name="code125-compatibility-mode-prefix" id="code125-compatibility-mode-prefix" value="<?php echo code125_compatibility_mode_prefix(); ?>" />
				</div>
			</div>
		</div>
		<?php
	}

	add_action( 'admin_footer', 'code125_generator_popup' );
?>