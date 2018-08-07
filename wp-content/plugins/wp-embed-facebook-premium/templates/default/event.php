<?php
/*
 * You can create your own template by placing a copy of this file on yourtheme/plugins/wp-embed-fb/
 * to access all fb data print_r($fb_data)
 * Premium Tip:
 * If you remove the max-width of the wpemfb-container then add another wpemfb-row and col-12 then inside echo the event 'description' you will have a full embedded event :) don't tell anyone ;)
 */
 $height = $width * $prop;
 $start_time_format = !empty($fb_data['is_date_only']) ? '%e %b %Y' : '%e %b %Y %l:%M %P';
 $start_time = strtotime($fb_data['start_time']) + get_option('gmt_offset')*3600; //shows event date on local time
?>
<?php //Events have now covers but are not pulled from default request, maybe this will change in time.  ?>
<div class="wpemfb-container" style="max-width: <?php echo $width ?>px" >
	<div class="wpemfb-cover"
		style= "
				height:<?php echo $height ?>px;
				background-image: url(<?php echo $fb_data['cover']['source'] ?>); 
				background-position: 0% <?php echo $fb_data['cover']['offset_y'] ?>%;
		 		" onclick="window.open('http://www.facebook.com/<?php echo $fb_data['id'] ?>', '_blank')" >
	</div>			
	<div class="wpemfb-row wpemfb-pad-top">
		<div class="wpemfb-col-12">
			<a class="wpemfb-title" href="http://www.facebook.com/<?php echo $fb_data['id'] ?>" target="_blank" rel="nofollow">
				<?php echo $fb_data['name'] ?>
			</a>
			<br>
			<?php echo strftime($start_time_format, $start_time ) ?>
			<br>
			<?php 
				if(isset($fb_data['venue']['id'])){
					_e('@ ', 'wp-embed-facebook');
					echo '<a href="http://www.facebook.com/'.$fb_data['venue']['id'].'" target="_blank">'.$fb_data['location'].'</a>';
				} else {
					echo isset($fb_data['location']) ? __('@ ', 'wp-embed-facebook') . $fb_data['location'] : '';  
				} 
			?>
			<br>
			<?php echo __('Creator: ', 'wp-embed-facebook').'<a href="http://www.facebook.com/'.$fb_data['owner']['id'].'" target="_blank">'.$fb_data['owner']['name'].'</a>' ?>
		</div>
	</div>	
</div>
