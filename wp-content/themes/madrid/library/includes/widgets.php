<?php 

add_action( 'widgets_init', 'code125_widgets' );


function code125_widgets() {
	register_widget( 'code125_widget_login' );
	register_widget( 'code125_widget_facebook' );
	register_widget( 'code125_widget_vimeo' );
	register_widget( 'code125_widget_youtube' );
	register_widget( 'code125_widget_Dailymotion' );
	register_widget( 'code125_widget_news_photos' );
	register_widget( 'code125_widget_get_connected' );
	register_widget( 'code125_widget_flickr' );
	register_widget( 'code125_widget_blog' );
	register_widget( 'code125_widget_ad_300');
	register_widget( 'code125_widget_ad_160x600');
	register_widget( 'code125_widget_ad_4_4');
	register_widget( 'code125_widget_ad_2_125');
	register_widget( 'code125_widget_posts');
	register_widget( 'code125_widget_menu');
	register_widget( 'code125_widget_featured_post');
	register_widget( 'code125_widget_latest_posts_list');
	register_widget( 'code125_widget_review');
	register_widget( 'code125_widget_author');
	register_widget( 'code125_widget_feedburner');
	
	register_widget('code125_widget_recent_tweets');
	
	
}
// widget function
	class code125_widget_recent_tweets extends WP_Widget {
		
		
		function code125_widget_recent_tweets() {
			$widget_ops = array( 'classname' => 'clearfix twitter-widget', 'description' => 'Display recent tweets');
			
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter-widget' );
			
			$this->WP_Widget( 'twitter-widget','Code125 Recent Tweets', $widget_ops, $control_ops );
		}
		
		
		//widget output
			 function widget($args, $instance) {
				extract($args);
				if(!empty($instance['title'])){ $title = apply_filters( 'widget_title', $instance['title'] ); }
				
				echo $before_widget;				
				if ( ! empty( $title ) ){ echo $before_title . $title . $after_title; }

				
					//check settings and die if not set
						if(empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])){
							echo '<strong>Please fill all widget settings!</strong>' . $after_widget;
							return;
						}
					
										
					//check if cache needs update
						$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
						$diff = time() - $tp_twitter_plugin_last_cache_time;
						$crt = $instance['cachetime'] * 3600;
						
					 //	yes, it needs update			
						if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){
							
							if(!require_once('twitteroauth.php')){ 
								echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
								return;
							}
														
														  
							  							  
							$connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
							$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');
							
														
							if(!empty($tweets->errors)){
								if($tweets->errors[0]->message == 'Invalid or expired token'){
									echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
								}else{
									echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
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
								
							echo '<!-- twitter cache has been updated! -->';
						}
						
						
							
					
					$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
					if(!empty($tp_twitter_plugin_tweets)){
						print '
						<div class="tp_recent_tweets">
							<ul>';
							$fctr = '1';
							foreach($tp_twitter_plugin_tweets as $tweet){								
								print '<li><span class="icon-twitter"> </span> <span>'.convert_links($tweet['text']).'</span><br /><a class="twitter_time" target="_blank" href="http://twitter.com/'.$instance['username'].'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></li>';
								if($fctr == $instance['tweetstoshow']){ break; }
								$fctr++;
							}
						
						print '
							</ul>
						</div>';
					}
				
				
				
				echo $after_widget;
			}
			
		
		//save widget settings 
			 function update($new_instance, $old_instance) {				
				$instance = array();
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['consumerkey'] = strip_tags( $new_instance['consumerkey'] );
				$instance['consumersecret'] = strip_tags( $new_instance['consumersecret'] );
				$instance['accesstoken'] = strip_tags( $new_instance['accesstoken'] );
				$instance['accesstokensecret'] = strip_tags( $new_instance['accesstokensecret'] );
				$instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
				$instance['username'] = strip_tags( $new_instance['username'] );
				$instance['tweetstoshow'] = strip_tags( $new_instance['tweetstoshow'] );

				if($old_instance['username'] != $new_instance['username']){
					delete_option('tp_twitter_plugin_last_cache_time');
				}
				
				return $instance;
			}
			
			
		//widget settings form	
			 function form($instance) {
				$defaults = array( 'title' => '', 'consumerkey' => '', 'consumersecret' => '', 'accesstoken' => '', 'accesstokensecret' => '', 'cachetime' => '', 'username' => '', 'tweetstoshow' => '' );
				$instance = wp_parse_args( (array) $instance, $defaults );
						
				echo '
				<p><label>Title:</label>
					<input type="text" name="'.$this->get_field_name( 'title' ).'" id="'.$this->get_field_id( 'title' ).'" value="'.esc_attr($instance['title']).'" class="widefat" /></p>
				<p><label>Consumer Key:</label>
					<input type="text" name="'.$this->get_field_name( 'consumerkey' ).'" id="'.$this->get_field_id( 'consumerkey' ).'" value="'.esc_attr($instance['consumerkey']).'" class="widefat" /></p>
				<p><label>Consumer Secret:</label>
					<input type="text" name="'.$this->get_field_name( 'consumersecret' ).'" id="'.$this->get_field_id( 'consumersecret' ).'" value="'.esc_attr($instance['consumersecret']).'" class="widefat" /></p>					
				<p><label>Access Token:</label>
					<input type="text" name="'.$this->get_field_name( 'accesstoken' ).'" id="'.$this->get_field_id( 'accesstoken' ).'" value="'.esc_attr($instance['accesstoken']).'" class="widefat" /></p>									
				<p><label>Access Token Secret:</label>		
					<input type="text" name="'.$this->get_field_name( 'accesstokensecret' ).'" id="'.$this->get_field_id( 'accesstokensecret' ).'" value="'.esc_attr($instance['accesstokensecret']).'" class="widefat" /></p>														
				<p><label>Cache Tweets in every:</label>
					<input type="text" name="'.$this->get_field_name( 'cachetime' ).'" id="'.$this->get_field_id( 'cachetime' ).'" value="'.esc_attr($instance['cachetime']).'" class="small-text" /> hours</p>																			
				<p><label>Twitter Username:</label>
					<input type="text" name="'.$this->get_field_name( 'username' ).'" id="'.$this->get_field_id( 'username' ).'" value="'.esc_attr($instance['username']).'" class="widefat" /></p>																			
				<p><label>Tweets to display:</label>
					<select type="text" name="'.$this->get_field_name( 'tweetstoshow' ).'" id="'.$this->get_field_id( 'tweetstoshow' ).'">';
					$i = 1;
					for(i; $i <= 10; $i++){
						echo '<option value="'.$i.'"'; if($instance['tweetstoshow'] == $i){ echo ' selected="selected"'; } echo '>'.$i.'</option>';						
					}
					echo '
					</select></p>';		
			}
	}

class code125_widget_facebook extends WP_Widget {

	function code125_widget_facebook() {
		$widget_ops = array( 'classname' => 'clearfix facebook', 'description' => 'Show Facebook Like Box');
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook-widget' );
		
		$this->WP_Widget( 'facebook-widget','Code125 Facebook Like Box', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];

		echo $before_widget;
		
		$after_title = '<span class="side-icon icon-facebook"></span><span class="arrow"></span></h3>';

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $username ){
			echo '<div class="textwidget">';
			echo '<div class="fb-like-box" data-href="http://www.facebook.com/'.$username.'" data-width="306" data-show-faces="true" data-stream="false" data-header="false"></div>';
			echo '</div>';
		}
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Find Us On Facebook', 'username' => ot_get_option( 'facebook' ) );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Page Username:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" class="widefat" />
		</p>
		

	<?php
	}
}



class code125_widget_login extends WP_Widget {

	function code125_widget_login() {
		$widget_ops = array( 'classname' => 'clearfix login', 'description' => __('Show the login/register Forms', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'login-widget' );
		
		$this->WP_Widget( 'login-widget', __('Code125 Login Form', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		// Display the widget title
		
		if ( $title )
			echo $before_title . $title . $after_title;

			echo '<div class="textwidget clearfix">';
			
			echo get_login_form();
			echo '</div>';

		
		echo $after_widget;
	
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Login', 'code125-admin') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

				

	<?php
	}
}



class code125_widget_vimeo extends WP_Widget {

	function code125_widget_vimeo() {
		$widget_ops = array( 'classname' => 'clearfix vimeo', 'description' => 'Vimeo Video Widget');
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vimeo-widget' );
		
		$this->WP_Widget( 'vimeo-widget','Code125 Vimeo Video Widget', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $username ){
			echo '<div class="textwidget">';
			echo do_shortcode('[vimeo clip_id="'.$username.'" width="100%" height="200px"]');
			echo '</div>';
		}
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Vimeo Video', 'username' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Video ID:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" class="widefat" />
		</p>
		

	<?php
	}
}


class code125_widget_youtube extends WP_Widget {

	function code125_widget_youtube() {
		$widget_ops = array( 'classname' => 'clearfix youtube', 'description' => 'Youtube Video Widget');
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'youtube-widget2' );
		
		$this->WP_Widget( 'youtube-widget2','Code125 Youtube Video Widget', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $username ){
			echo '<div class="textwidget">';
			echo do_shortcode('[youtube id="'.$username.'" width="100%" height="200px"]');
			echo '</div>';
		}
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Vimeo Video', 'username' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Video ID:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" class="widefat" />
		</p>
		

	<?php
	}
}


class code125_widget_dailymotion extends WP_Widget {

	function code125_widget_dailymotion() {
		$widget_ops = array( 'classname' => 'clearfix dailymotion', 'description' => 'Dailymotion Video Widget');
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dailymotion-widget' );
		
		$this->WP_Widget( 'dailymotion-widget','Code125 Dailymotion Video Widget', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $username ){
			echo '<div class="textwidget">';
			echo do_shortcode('[dailymotion id="'.$username.'" width="100%" height="200px"]');
			echo '</div>';
		}
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Vimeo Video', 'username' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Video ID:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" class="widefat" />
		</p>
		

	<?php
	}
}


class code125_widget_get_connected extends WP_Widget {

	function code125_widget_get_connected() {
		$widget_ops = array( 'classname' => 'clearfix get_connected', 'description' => 'Show Get Connected Box');
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'get_connected-widget' );
		
		$this->WP_Widget( 'get_connected-widget','Code125 Social Box', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

			echo '<div class="textwidget">';
			echo do_shortcode('[social_box]');;
			echo '</div>';
		
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Get Connected');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		
		

	<?php
	}
}



class code125_widget_review extends WP_Widget {

	function code125_widget_review() {
		$widget_ops = array( 'classname' => 'clearfix review', 'description' => __('Show the Review Box in Articles when availble.', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'review-widget' );
		
		$this->WP_Widget( 'review-widget', __('Code125 Review Box', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		
		global $post;
		// Display the widget title
		if(is_single() && has_review($post->ID) && !post_password_required()){
			echo $before_widget;
		
			if ( $title )
				echo $before_title . $title . $after_title;

			echo '<div class="textwidget clearfix">';
			
			
			
			echo get_reviewbox($post->ID); 
			
			echo '</div>';

			echo $after_widget;
				
			$GLOBALS['show_review_box'] = false;
		}
	
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Review', 'code125-admin') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

				

	<?php
	}
}



class code125_widget_author extends WP_Widget {

	function code125_widget_author() {
		$widget_ops = array( 'classname' => 'clearfix author', 'description' => __('Show the Author Box in Articles.', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'author-widget' );
		
		$this->WP_Widget( 'author-widget', __('Code125 Author Widget', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		
		global $post;
		// Display the widget title
		if(is_single()){
			echo $before_widget;
		
			if ( $title )
				echo $before_title . $title . $after_title;
			
			$user = get_userdata($post->post_author);
			
			$facebook_user = get_the_author_meta( 'facebook', $post->post_author);
			$twitter_user = get_the_author_meta( 'twitter', $post->post_author);
			$position_user = get_the_author_meta( 'position', $post->post_author);
			
			$google_plus_user = get_the_author_meta( 'google_plus', $post->post_author);
			$behance_user = get_the_author_meta( 'behance', $post->post_author);
			$dribble_user = get_the_author_meta( 'dribble', $post->post_author);
			
			$avatar = get_avatar( $post->post_author, '64', '', '<span class="icon-user"></span>' );
			
			echo '<div class="textwidget author_widget  box-container clearfix">';
			?>
			<div class="row-fluid">
			<div class="span4"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $avatar; ?></a></div>
			<div class="span8"><h3><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo $user->display_name; ?></a></h3><p><?php echo $position_user; ?></p><ul class="social-icons clearfix">
			<?php 
			if($facebook_user != ''){
				echo '<li><a href="http://www.facebook.com/people/@/'.$facebook_user.'" class="icon-facebook"></a></li>';
			}
			
			if($twitter_user != ''){
				echo '<li><a href="http://www.twitter.com/'.$twitter_user.'" class="icon-twitter"></a></li>';
			}
			
			if($google_plus_user != ''){
				echo '<li><a href="'.$google_plus_user.'" class="icon-gplus-1"></a></li>';
			}
			
			if($behance_user != ''){
				echo '<li><a href="'.$behance_user.'" class="icon-behance"></a></li>';
			}
			
			if($dribble_user != ''){
				echo '<li><a href="'.$dribble_user.'" class="icon-dribble"></a></li>';
			}
			
			if($user->user_email != ''){
				echo '<li><a href="mailto:'.$user->user_email.'" class="icon-mail"></a></li>';
			}
			
			if($user->user_url != ''){
				echo '<li><a href="'.$user->user_url.'" class="icon-link"></a></li>';
			}
			
			
			 ?>
			</li></ul></div>
			</div>
			
			<?php
			echo '<p class="user_description">'.$user->user_description.'</p>';
			
			echo '</div>';

			echo $after_widget;
		}
	
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Review', 'code125-admin') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

				

	<?php
	}
}


class code125_widget_ad_160x600 extends WP_Widget {

	function code125_widget_ad_160x600() {
		$widget_ops = array( 'classname' => 'clearfix ad_160x600_widget', 'description' => __('Add Ads Area with dimension 160x600', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ad-160x600-widget' );
		
		$this->WP_Widget( 'ad-160x600-widget', __('Code125 Ad 160x600', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$ad_content = $instance['ad_content'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $ad_content )
			echo '<div class="textwidget"><div class="ad_wrap"><div class="ad_160x600">' . html_entity_decode( $ad_content ) . '</div></div></div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad_content'] =  htmlspecialchars( $new_instance['ad_content'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Ads', 'code125-admin'), 'ad_content' => ' ' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_content' ); ?>"><?php _e('Ad Content:', 'code125-admin'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'ad_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_content']; ?></textarea>
		</p>
		

	<?php
	}
}



class code125_widget_ad_300 extends WP_Widget {

	function code125_widget_ad_300() {
		$widget_ops = array( 'classname' => 'clearfix ad_300_widget', 'description' => __('Add Ads Area with the width of 300', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ad-300-widget' );
		
		$this->WP_Widget( 'ad-300-widget', __('Code125 Ad 300x250', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$ad_content = $instance['ad_content'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $ad_content )
			echo '<div class="textwidget"><div class="ad_wrap"><div class="ad_300">' . html_entity_decode( $ad_content ) . '</div></div></div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad_content'] =  htmlspecialchars( $new_instance['ad_content'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Ads', 'code125-admin'), 'ad_content' => ' ' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_content' ); ?>"><?php _e('Ad Content:', 'code125-admin'); ?></label>
			
			<textarea id="<?php echo $this->get_field_id( 'ad_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_content']; ?></textarea>
		</p>
		

	<?php
	}
}


class code125_widget_ad_4_4 extends WP_Widget {

	function code125_widget_ad_4_4() {
		$widget_ops = array( 'classname' => 'clearfix ad_4_4_widget', 'description' => 'Add 4x4 Ads Area' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ad_4_4-widget' );
		
		$this->WP_Widget( 'ad_4_4-widget', 'Code125 4 125x125 Ads', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$ad_1_content = $instance['ad_1_content'];
		$ad_2_content = $instance['ad_2_content'];
		$ad_3_content = $instance['ad_3_content'];
		$ad_4_content = $instance['ad_4_content'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		
			echo '<div class="textwidget"><div class="ad_wrap clearfix"><div class="ad_125">' . html_entity_decode( $ad_1_content ) . '</div><div class="ad_125">' . html_entity_decode( $ad_2_content ) . '</div><div class="ad_125">' . html_entity_decode( $ad_3_content ) . '</div><div class="ad_125">' . html_entity_decode( $ad_4_content ) . '</div></div></div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad_1_content'] =  htmlspecialchars( $new_instance['ad_1_content'] );
		$instance['ad_2_content'] =  htmlspecialchars( $new_instance['ad_2_content'] );
		$instance['ad_3_content'] =  htmlspecialchars( $new_instance['ad_3_content'] );
		$instance['ad_4_content'] =  htmlspecialchars( $new_instance['ad_4_content'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Ads', 'code125-admin'), 'ad_content' => ' ' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_1_content' ); ?>">Ad 1 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_1_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_1_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_1_content']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_2_content' ); ?>">Ad 2 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_2_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_2_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_2_content']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_3_content' ); ?>">Ad 3 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_3_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_3_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_3_content']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_4_content' ); ?>">Ad 4 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_4_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_4_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_4_content']; ?></textarea>
		</p>
		

	<?php
	}
}

class code125_widget_ad_2_125 extends WP_Widget {

	function code125_widget_ad_2_125() {
		$widget_ops = array( 'classname' => 'clearfix ad_2_125_widget', 'description' => 'Add 1x2 Ads Area' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ad_2_125-widget' );
		
		$this->WP_Widget( 'ad_2_125-widget', 'Code125 2 125x125 Ads', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$ad_1_content = $instance['ad_1_content'];
		$ad_2_content = $instance['ad_2_content'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		
			echo '<div class="textwidget"><div class="ad_wrap ads1x2_ads clearfix"><div class="ad_125">' . html_entity_decode( $ad_1_content ) . '</div><div class="ad_125">' . html_entity_decode( $ad_2_content ) . '</div></div></div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ad_1_content'] =  htmlspecialchars( $new_instance['ad_1_content'] );
		$instance['ad_2_content'] =  htmlspecialchars( $new_instance['ad_2_content'] );
		
		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Ads', 'code125-admin'), 'ad_content' => ' ' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_1_content' ); ?>">Ad 1 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_1_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_1_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_1_content']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ad_2_content' ); ?>">Ad 2 Content:</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_2_content' ); ?>" name="<?php echo $this->get_field_name( 'ad_2_content' ); ?>" style="width:100%;" class="widefat"  ><?php echo $instance['ad_2_content']; ?></textarea>
		</p>
		
	<?php
	}
}



class code125_widget_flickr extends WP_Widget {

	function code125_widget_flickr() {
		$widget_ops = array( 'classname' => 'clearfix flickr clearfix', 'description' => __('Show the Stream Photos from Flickr', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr-widget' );
		
		$this->WP_Widget( 'flickr-widget', __('Code125 Flickr Photostream', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$count = $instance['count'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $username )
			echo '<div class="textwidget">';
			echo do_shortcode('[flickr id="'.$username.'" count="'.$count.'"]');
			echo '</div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Flickr Photostream', 'code125-admin'), 'username' => '','count' =>'9' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('ID:', 'code125-admin'); ?></label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Photos:</label>
			<select name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" class="widefat">
				<?php
				$options = array('6','7','8','9','10','11','12');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p>

	<?php
	}
}



class code125_widget_featured_post extends WP_Widget {

	function code125_widget_featured_post() {
		$widget_ops = array( 'classname' => 'clearfix featured_post', 'description' => __('Featured Post', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'featured-widget' );
		
		$this->WP_Widget( 'featured-widget', __('Code125 Featured Post', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$post_id = $instance['post_id'];
		
		
		$type = get_post_type($post_id );
		$tax = get_post_tax($type );
		
		$terms = wp_get_post_terms($post_id , $tax);
		 
		echo $before_widget;
		?>
		<div class="<?php echo  $terms[0]->slug; ?>">
		<?php
		
		$after_title = '<span class="side-icon icon-bookmark"></span><span class="arrow"></span></h3>';
		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;


		$id_link = get_post_thumbnail_id($post_id);
			
			$image_url = wp_get_attachment_image_src( $id_link, '3-col');
			
			$image_url2 = wp_get_attachment_image_src( $id_link, 'full');
		?>
		
			<?php 
				$post2 = query_posts('p='.$post_id.'&post_type='.$type);
				while (have_posts()) : the_post();
			 ?>
			
			<div class="featured-post  <?php echo $tax.'-'.$terms[0]->term_id ; ?>">
			<?php if(is_array($image_url)){ 
				
				?>
				<a  href="<?php the_permalink(); ?>"><img src="<?php echo $image_url[0] ?>" width="<?php echo $image_url[1] ?>"  height="<?php echo $image_url[2] ?>"alt="" /></a>
			<?php } ?>
			<p class="dark-mini"><a  href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></p></div>
			</div>
			
	<?php
			endwhile;
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['post_id'] = strip_tags( $new_instance['post_id'] );
		return $instance;
	}

	
	function form( $instance ) {
		
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Featured Post', 'code125-admin'), 'post_id' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'code125-admin'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e('Post ID:', 'code125-admin'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $instance['post_id']; ?>" style="width:100%;" class="widefat" />
		</p>

						
	<?php
	}
}


class code125_widget_blog extends WP_Widget {

	function code125_widget_blog() {
		$widget_ops = array( 'classname' => 'clearfix blog', 'description' => __('Latest & Popular Posts', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'blog-widget' );
		
		$this->WP_Widget( 'blog-widget', __('Code125 Latest Posts', 'code125-admin'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$post_type = $instance['post_type'];

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
			
			?>
			<ul class="custom_tabs clearfix">
			  <li class="current first_li">
			    <a href="#"><span class="icon-comment"></span></a>
			  </li>
			  <li>
			    <a href="#"><span class="icon-clock"></span></a>
			  </li>
			  <?php 
			  $like_enable = ot_get_option('like_enable');
			   if($like_enable !='no'){
			   ?>
			  <li>
			    <a href="#"><span class="icon-heart"></span></a>
			  </li>
			  <?php } ?>
			  <?php 
			  $view_count_enable = ot_get_option('view_count_enable');
			   if($view_count_enable !='no'){
			   ?>
			  
			  <li>
			    <a href="#"><span class="icon-eye"></span></a>
			  </li>
			  <?php } ?>
			  
			  <?php 
			  $review_enable = ot_get_option('review_enable');
			   if($review_enable !='no'){
			   ?>
			  
			  <li>
			    <a href="#"><span class="icon-star"></span></a>
			  </li>
			  <?php } ?>
			  
			</ul>
			
			<div class="custom_tabs_wrap">
			  <div class="custom_tabs_content clearfix">
			    <?php echo do_shortcode('[posts type="'.$post_type.'" blog_style="7" thumb_view="comment" posts_per_page="3" paging="false" order="DESC" orderby="comment_count" meta_key="post_views_count" author_enable="no" date_enable="no" comments_count_enable="yes" cat_enable="no" like_enable="yes" view_count_enable="no" review_enable="no"]'); ?>
			    
			  </div>
			  <div class="custom_tabs_content clearfix">
			    <?php echo do_shortcode('[posts type="'.$post_type.'" blog_style="7" thumb_view="date" posts_per_page="3" paging="false" order="DESC" orderby="date" meta_key="post_views_count" author_enable="no" date_enable="no" comments_count_enable="yes" cat_enable="no" like_enable="yes" view_count_enable="no" review_enable="no"]'); ?>
			    
			  </div>
			  
			  
			  <?php 
			  $like_enable = ot_get_option('like_enable');
			   if($like_enable !='no'){
			   ?>
			  <div class="custom_tabs_content clearfix">
			    <?php echo do_shortcode('[posts type="'.$post_type.'" blog_style="7" thumb_view="like" posts_per_page="3" paging="false" order="DESC" orderby="meta_value_num" meta_key="votes_count" author_enable="no" date_enable="no" comments_count_enable="yes" cat_enable="no" like_enable="yes" view_count_enable="no" review_enable="no"]'); ?>
			    
			  </div>
			  <?php } ?>
			  
			  <?php 
			  $view_count_enable = ot_get_option('view_count_enable');
			   if($view_count_enable !='no'){
			   ?>
			  
			  <div class="custom_tabs_content clearfix">
			    <?php echo do_shortcode('[posts type="'.$post_type.'" blog_style="7" thumb_view="view" posts_per_page="3" paging="false" order="DESC" orderby="meta_value_num" meta_key="post_views_count" author_enable="no" date_enable="no" comments_count_enable="yes" cat_enable="no" like_enable="no" view_count_enable="yes" review_enable="no"]'); ?>
			    
			  </div>
			  <?php } ?>
			  
			  <?php 
			  $review_enable = ot_get_option('review_enable');
			   if($review_enable !='no'){
			   ?>
			  <div class="custom_tabs_content clearfix">
			    <?php echo do_shortcode('[posts type="'.$post_type.'" blog_style="7" thumb_view="rate" posts_per_page="3" paging="false" order="DESC" orderby="meta_value_num" meta_key="rating_average" author_enable="no" date_enable="no" comments_count_enable="no" cat_enable="no" like_enable="no" view_count_enable="no" review_enable="yes"]'); ?>
			    
			  </div>
			  <?php } ?>
			  
			</div>
	
	<?php
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		return $instance;
	}

	
	function form( $instance ) {
		
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => __('From The Blog', 'code125-admin'), 'post_type' => 'post' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'code125-admin'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>

				<p>
			<label for="<?php echo $this->get_field_id('post_type'); ?>">Post Type:</label>
			<select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>" class="widefat">
				<?php
				$options = array('post' => 'Post',
				'portfolio' => 'Portfolio',
				'team' => 'Team',
				'faq' => 'Faq',
				'testimonial' => 'Testimonial');
				
				
				$custom_posts = ot_get_option('custom_posts', array());
				
				if ($custom_posts) {
				    foreach ($custom_posts as $custom_post) {
					    $options[$custom_post['slug']] = $custom_post['title'];
				    }
				 }
				
				foreach ($options as $key => $value) {
					echo '<option value="' . $key . '" id="' . $key . '"', $instance['post_type'] == $key ? ' selected="selected"' : '', '>', $value, '</option>';
				}
				?>
			</select>
		</p>
		
	<?php
	}
}


class code125_widget_news_photos extends WP_Widget {

	function code125_widget_news_photos() {
		$widget_ops = array( 'classname' => 'clearfix news_photos', 'description' => __('News In Photos', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'news_photos-widget' );
		
		$this->WP_Widget( 'news_photos-widget', 'Code125 News In Photos', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$count = $instance['count'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
			echo '<div class="textwidget clearfix">';
			if($cat == 'all'){
			$cat='';
			}
			$code = '[news_in_photos category="'.$cat.'" numberposts="'.$count.'" order="DESC" orderby="date"]';
			echo do_shortcode($code);
			echo '</div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		
		return $instance;
	}

	
	function form( $instance ) {
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );
		$categories=get_categories($args);
		$cat_options=array();
		$cat_options['all']= 'All Categories';
		  foreach($categories as $category) { 
		    $cat_options[ $category->term_id  ] =   $category->name;
		  } 
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => 'News in Photos', 'count' =>'6', 'cat'=>'' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Posts:</label>
			<select name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" class="widefat">
				<?php
				$options = array('3','4','5','6','7','8','9','10','7','8','9','10','11','12','13','14','15','16','17');
				foreach ($options as $option) {
				$select = $instance['count'];
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $option . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">Category:</label>
			<select name="<?php echo $this->get_field_name('cat'); ?>" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat">
				<?php
				
				foreach ($cat_options as $option => $value) {
				
					$select = $instance['cat'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		
	<?php
	}
}


class code125_widget_posts extends WP_Widget {

	function code125_widget_posts() {
		$widget_ops = array( 'classname' => 'clearfix posts', 'description' => __('Show Posts for certain Category.', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'posts-widget' );
		
		$this->WP_Widget( 'posts-widget', 'Code125 Category Posts', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$count = $instance['count'];
		$orderby= $instance['orderby'];
		$thumb_view= $instance['thumb_view'];
		$post_type= $instance['post_type'];
		$meta_key= $instance['meta_key'];
		
		if($thumb_view !='cat'){
			echo $before_widget;
		}else{
			$cat_array = get_category($cats);
			echo '<div id="%1$s" class="widget '.$cat_array->slug.'  %2$s">';
		}
		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
			echo '<div class="textwidget posts-widget-wrap clearfix">';
			
			$code = '[posts type="'.$post_type.'" blog_style="7" thumb_view="'.$thumb_view.'" posts_per_page="'.$count.'" paging="false" order="DESC" orderby="'.$orderby.'" meta_key="'.$meta_key.'" author_enable="no" date_enable="yes" comments_count_enable="no" cat_enable="no" like_enable="yes" view_count_enable="no" review_enable="no"]';
			echo do_shortcode($code);
			echo '</div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		$instance['orderby'] = strip_tags( $new_instance['orderby'] );
		$instance['thumb_view'] = strip_tags( $new_instance['thumb_view'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['meta_key'] = strip_tags( $new_instance['meta_key'] );
		
	
		
		return $instance;
	}

	
	function form( $instance ) {
		
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => '','post_type'=>'post', 'count' =>'6', 'cat'=>'','orderby'=>'date' ,'meta_key'=>'');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Posts:</label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">Category ID:</label>
			<input id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo $instance['cat']; ?>" style="width:100%;" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>">Order By:</label>
			<select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
				<?php
				
				$order_options =array('none' => 'None',
				'id' => 'Post ID',
				'author' => 'Author',
				'title' => 'Title',
				'date' => 'Date Created',
				'modified' => 'Date Modified',
				'parent' => 'Post/Page Parent ID',
				'rand' => 'Random',
				'comment_count' => 'Number of Comments',
				'menu_order' => 'Page Order',
				'meta_value_num' => 'Meta Value Based');
				
				foreach ($order_options as $option => $value) {
				
					$select = $instance['orderby'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('meta_key'); ?>">Order By:</label>
			<select name="<?php echo $this->get_field_name('meta_key'); ?>" id="<?php echo $this->get_field_id('meta_key'); ?>" class="widefat">
				<?php
				
				$order_options =array(
				'post_views_count' => 'Views Count',
				'votes_count' => 'Likes Count',
				'rating_average'=> 'Rating Average');
				
				foreach ($order_options as $option => $value) {
				
					$select = $instance['orderby'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('thumb_view'); ?>">Thumbnail Type:</label>
			<select name="<?php echo $this->get_field_name('thumb_view'); ?>" id="<?php echo $this->get_field_id('thumb_view'); ?>" class="widefat">
				<?php
				
				$order_options =array(
				'image' => 'Featured Image',
				'type' => 'Post Format Icon',
				'cat' => 'Category Icon',
				'comment' => 'Comment Count',
				'date' => 'Date',
				'like' => 'Like Count',
				'rate' => 'Rating',
				'view' => 'Views Count',);
				
				foreach ($order_options as $option => $value) {
				
					$select = $instance['thumb_view'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		
		
	<?php
	}
}


class code125_widget_menu extends WP_Widget {

	function code125_widget_menu() {
		$widget_ops = array( 'classname' => 'clearfix posts', 'description' => __('Show Menu in Sidebar.', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'menu-widget' );
		
		$this->WP_Widget( 'menu-widget', 'Code125 Menu', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$location = $instance['location'];
		
		
		echo $before_widget;
		
		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
			echo '<div class="textwidget menu-widget-wrap clearfix">';
			
			$code = '[menu location="'.$location.'" bg_mode="light-mode" style="sidebar"]';
			echo do_shortcode($code);
			echo '</div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['location'] = strip_tags( $new_instance['location'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
				
		return $instance;
	}

	
	function form( $instance ) {
		
		
		$menus_new = ot_get_option( 'menus', array() );
		$menu_new = array();
		
		$menu_new['main-nav']='Main Menu';
		$menu_new['footer-links']='Footer Menu';
		foreach($menus_new as  $value) { 
		  $menu_new[ $value['location'] ] =  $value['title'];
		} 
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => 'Menu', 'location' =>'main-nav');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('location'); ?>">Menu Location:</label>
			<select name="<?php echo $this->get_field_name('location'); ?>" id="<?php echo $this->get_field_id('location'); ?>" class="widefat">
				<?php
				
				foreach ($menu_new as $option => $value) {
				
					$select = $instance['location'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
				
	<?php
	}
}





class code125_widget_latest_posts_list extends WP_Widget {

	function code125_widget_latest_posts_list() {
		$widget_ops = array( 'classname' => 'clearfix posts latest_posts_list', 'description' => __('Show Posts for certain Category in List Style.', 'code125-admin') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest_posts_list' );
		
		$this->WP_Widget( 'latest_posts_list', 'Code125 Posts List Style', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$cat = $instance['cat'];
		$count = $instance['count'];
		$orderby= $instance['orderby'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
			echo '<div class="textwidget latest_posts_list clearfix">';
			
			$args = array(
			    'posts_per_page' => $count,
			    'cat' => $cat,
			    'orderby' => $orderby,
			    'post_type' => 'post',
			    'post_status' => 'publish');
			
			 query_posts($args);
			 while (have_posts()) : the_post();
				$data = '';
				ob_start();
				 		 the_permalink();
				 		 $permalink = ob_get_contents();
				 		 ob_end_clean();
				  
				 		 ob_start();
				 		 the_title();
				 		 $the_title = ob_get_contents();
				 		 ob_end_clean();
				 
				  if( code125_is_rtl() ){ 
				  	$data = $data .'<li><a class="icon-left-open" href="'. $permalink.'"> '. $the_title.'</a></li>';
				  }else {
				  	$data = $data .'<li><a class="icon-right-open" href="'. $permalink.'"> '. $the_title.'</a></li>';
				  }
				echo $data ;
  			 endwhile;
			wp_reset_query();
			
			
			echo '</div>';

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );
		$instance['orderby'] = strip_tags( $new_instance['orderby'] );
	
		
		return $instance;
	}

	
	function form( $instance ) {
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );
		$categories=get_categories($args);
		$cat_options=array();
		$cat_options[ ''  ] =   'All Categories';
		  foreach($categories as $category) { 
		    $cat_options[ $category->term_id  ] =   $category->name;
		  } 
		
		
		
		//Set up some default widget settings.
		$defaults = array( 'title' => 'Category Articles', 'count' =>'6', 'cat'=>'','orderby'=>'date' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" class="widefat" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Posts:</label>
			<select name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" class="widefat">
				<?php
				$options = array('3','4','5','6','7','8','9','10','7','8','9','10');
				foreach ($options as $option) {
				$select = $instance['count'];
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $option . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">Category:</label>
			<select name="<?php echo $this->get_field_name('cat'); ?>" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat">
				<?php
				
				foreach ($cat_options as $option => $value) {
				
					$select = $instance['cat'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>">Order By:</label>
			<select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
				<?php
				
				$order_options =array('none' => 'None',
				'id' => 'Post ID',
				'author' => 'Author',
				'title' => 'Title',
				'date' => 'Date Created',
				'modified' => 'Date Modified',
				'parent' => 'Post/Page Parent ID',
				'rand' => 'Random',
				'comment_count' => 'Number of Comments',
				'menu_order' => 'Page Order');
				
				foreach ($order_options as $option => $value) {
				
					$select = $instance['orderby'];
				
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>' . $value . '</option>';
				}
				?>
			</select>
		</p>
		
	<?php
	}
}



class code125_widget_feedburner extends WP_Widget {

	function code125_widget_feedburner() {
		$widget_ops = array('classname' => 'clearfix BFW', 'description' => __('Subscribe via email to your Feedburner feed.','better-feedburner-widget'));
		$this->WP_Widget('BFW', 'Code125 Feedburner Widget', $widget_ops);
	}

	function form($instance) {
		
		$instance = wp_parse_args((array) $instance, array(
			'title' => '',
			'feed' => '',
			'email_label' => '',
			'after_form' => '',
			'button_text' => '',
			'show_counter' => '',
			'counter_bg' => '',
			'counter_fg' => '',
		));
        
		$title = esc_attr($instance['title']);
		$feed = esc_attr($instance['feed']);
		$email_label = esc_attr($instance['email_label']);
		$after_form = esc_attr($instance['after_form']);
		$button_text = empty($instance['button_text']) ? 'Subscribe' : esc_attr($instance['button_text']);
		$show_counter = esc_attr($instance['show_counter']);
		$counter_bg = empty($instance['counter_bg']) ? '99ccff' : $instance['counter_bg'];
		$counter_fg = empty($instance['counter_fg']) ? '444444' : $instance['counter_fg'];
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><strong><?php _e('Widget Title:','better-feedburner-widget'); ?></strong> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('feed'); ?>"><strong><?php _e('Feedburner feed User:','better-feedburner-widget'); ?></strong> <input class="widefat" id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" type="text" value="<?php echo $feed; ?>" /></label><br />
		<small><em>(http://feeds.feedburner.com/USER)</em></small></p>
		<p><label for="<?php echo $this->get_field_id('email_label'); ?>"><strong><?php _e('Label for email box:','better-feedburner-widget'); ?></strong> <input class="widefat" id="<?php echo $this->get_field_id('email_label'); ?>" name="<?php echo $this->get_field_name('email_label'); ?>" type="text" value="<?php echo $email_label; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>"><strong><?php _e('Submit button text:','better-feedburner-widget'); ?></strong> <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" /></label></p>
		  
		
		
		
<?php
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	 function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$html = $before_widget;
        
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$feed = empty($instance['feed']) ? false : $instance['feed'];
		$email_label = empty($instance['email_label']) ? false : $instance['email_label'];
		$after_form = empty($instance['after_form']) ? false : $instance['after_form'];
		$button_text = empty($instance['button_text']) ? 'Subscribe' : $instance['button_text'];
		$show_counter = (isset($instance['show_counter']) && $instance['show_counter']) ? true : false;
		$counter_bg = empty($instance['counter_bg']) ? '99ccff' : $instance['counter_bg'];
		$counter_fg = empty($instance['counter_fg']) ? '444444' : $instance['counter_fg'];
       
		$user = str_replace('http://feeds.feedburner.com/', '', $feed);
           
		if (!empty($title)) {
			$html .= $before_title . trim($title) . $after_title;
		}

		$html .= '<div id="loginform" class="clearfix"><form id="BFW" action="http://feedburner.google.com/fb/a/mailverify" method="post" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=' . $user . '\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\')" target="popupwindow">';
		
		
		$html .= '<input id="BFW_email" class="element-block" type="text" name="email" placeholder="' . trim($email_label) . '" />';
		$html .= '<input type="hidden"  value="' . $user . '" name="uri"/>';
		$html .= '<input type="hidden" name="loc" value="en_US"/>';
            
		$html .= '<input id="BFW_submit" class="button-primary" type="submit" value="' . trim($button_text) . '" />';

		if ($show_counter) {
			$html .= "<div id=\"BFW_stats\"><a href=\"http://feeds.feedburner.com/" . $user . "\"><img src=\"http://feeds.feedburner.com/~fc/" . $user . "?bg=" . $counter_bg . "&amp;fg=" . $counter_fg . "&amp;anim=0\" height=\"26\" width=\"88\" style=\"border:0\" alt=\"Feedburner Subscriber Count\" /></a></div>\n";
		}
				
		$html .= '</form></div>';
		
		
        $html .= $after_widget;
        
        echo($html);
    }

}





