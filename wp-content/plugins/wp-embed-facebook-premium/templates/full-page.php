<?php
/*
 * You can create your own template by placing a copy of this file on yourtheme/plugins/wp-embed-fb/
 * to access all fb data print_r($fb_data)
<pre><?php 
foreach($fb_data as $key => $data){
	echo $key."<br>";
}
 ?></pre>
 */
 $height = $width * $prop;
 $show_posts = get_option("wpemfb_show_posts") == "true" ? true : false;
 //$wp_emb_fbsdk = WP_Embed_FB::$fbsdk;
?>
<div class="wpemfb-container" >
	<div class="wpemfb-cover"
		style= "
				background-image: url(<?php echo $fb_data['cover']['source'] ?>); 
				background-position: 0% <?php echo $fb_data['cover']['offset_y'] ?>%;
		 		" onclick="window.open('<?php echo $fb_data['link'] ?>', '_blank')" >
	</div>				
	<div class="wpemfb-row wpemfb-pad-top">
			<div class="wpemfb-col-3 wpemfb-text-center">
				<a href="<?php echo $fb_data['link'] ?>" target="_blank" rel="nofollow">
					<img src="http://graph.facebook.com/<?php echo $fb_data['id'] ?>/picture" width="50px" height="50px" />
				</a>		
			</div>
			<div class="wpemfb-col-10">
				<a class="wpemfb-title" href="<?php echo $fb_data['link'] ?>" target="_blank" rel="nofollow">
					<?php echo $fb_data['name'] ?>
				</a>
				<br>
				<?php
					echo $fb_data['category'];
					echo isset($fb_data['category_list'][0]['name'])?"<br>".$fb_data['category_list'][0]['name']:'';
				?><br>
				<?php if(isset($fb_data["website"])) : ?>
					<a  href="<?php echo WP_Embed_FB::getwebsite($fb_data["website"]) ?>" title="<?php _e('Web Site', 'wp-embed-facebook')  ?>" target="_blank">
						<?php echo $fb_data["website"]; ?>
					</a>						
				<?php endif; ?>
				<div style="float: right;"><?php WP_Embed_FB::like_btn($fb_data['id'],$fb_data['likes']) ?></div>	
			</div>
	</div>	
	<hr>
	<div class="wpemfb-row">
		<div class="wpemfb-col-4">
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		    <script>
				var map;
				function initialize() {
					var latlong = new google.maps.LatLng(<?php echo $fb_data['location']['latitude'] ?>, <?php echo $fb_data['location']['longitude'] ?>);
				  	var mapOptions = {
				    	zoom: 6,
				    	center: latlong
				  	};
				  	map = new google.maps.Map(document.getElementById('wpemfb-map'), mapOptions);
				  	var marker = new google.maps.Marker({
				    	position: latlong,
				      	map: map,
				  	});
				  
				}
				google.maps.event.addDomListener(window, 'load', initialize);
		    </script>
			<div id="wpemfb-map" style="height:150px"></div>
			<ul class="wpemfb-ul">
				<?php echo isset($fb_data['location']['street']) ? '<li><span class="wpemfb-bold">Address: </span>'.$fb_data['location']['street'].'</li>' : '' ?>
				<?php echo isset($fb_data['location']['city']) ? '<li><span class="wpemfb-bold">City: </span>'.$fb_data['location']['city'].'</li>' : '' ?>
				<?php echo isset($fb_data['phone']) ? '<li><span class="wpemfb-bold">Phone: </span>'.$fb_data['phone'].'</li>' : '' ?>
				<?php echo isset($fb_data['attire']) ? '<li><span class="wpemfb-bold">Attire: </span>'.$fb_data['attire'].'</li>' : '' ?>
				<?php echo isset($fb_data['price_range']) ? '<li><span class="wpemfb-bold">Price Range: </span>'.$fb_data['price_range'].'</li>' : '' ?>
				<?php 
					if(isset($fb_data['parking'])){
						echo "<li><span class='wpemfb-bold'>Parking: </span>";
						foreach ($fb_data['parking'] as $key => $value) {
							echo $value==1?$key.', ':'';	
						}
						echo "</li>";
					} 
				?>
				<?php 
					if(isset($fb_data['payment_options'])){
						echo "<li><span class='wpemfb-bold'>Payment Options: </span>";
						foreach ($fb_data['payment_options'] as $key => $value) {
							echo $value==1?$key.', ':'';	
						}
						echo "</li>";
					} 
				?>	
				<?php 
					if(isset($fb_data['restaurant_specialties'])){
						echo "<li><span class='wpemfb-bold'>Restaurant Especialities: </span>";
						foreach ($fb_data['restaurant_specialties'] as $key => $value) {
							echo $value==1?$key.', ':'';	
						}
						echo "</li>";
					} 
				?>					
				<?php 
					if(isset($fb_data['restaurant_services"'])){
						echo "<li><span class='wpemfb-bold'>Restaurant Services: </span>";
						foreach ($fb_data['restaurant_services'] as $key => $value) {
							echo $value==1?$key.', ':'';	
						}
						echo "</li>";
					} 
				?>	
			</ul>
		</div>
		<div class="wpemfb-col-8">
			<?php foreach($fb_data['posts']['data'] as $fbpost) : ?>

				<?php if(isset($fbpost['picture']) || isset($fbpost['message'])) : ?>
					<?php $link = explode("_", $fbpost['id']); ?>
					<hr>
					<div class="wpemfb-row">
						<?php if(isset($fbpost['picture']) && isset($fbpost['message'])) : ?>
							<div class="wpemfb-col-3 wpemfb-text-center">
								<a class="wpemfb-clean-link" href="<?php echo "https://www.facebook.com/".$link[0]."/posts/".$link[1] ?>" target="_blank" rel="nofollow">
									<img src="<?php echo $fbpost['picture'] ?>" width="70px" height"70px" />
								</a>
							</div>
							<div class="wpemfb-col-9 wpemfb-pl-none">
								<span class="wpemfb-page-post"><?php echo make_clickable($fbpost['message']) ?></span><br>
								<a class="wpemfb-post-link" href="<?php echo "https://www.facebook.com/".$link[0]."/posts/".$link[1] ?> " target="_blank" rel="nofollow">
									<?php echo isset($fbpost['likes']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/y6/r/l9Fe9Ugss0S.gif" />'.$fbpost['likes']['summary']['total_count'].' ' : ""  ?>
									<?php echo isset($fbpost['comments']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/yg/r/V8Yrm0eKZpi.gif" />'.$fbpost['comments']['summary']['total_count'].' ' : ""  ?>
									<?php echo isset($fbpost['shares']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/y2/r/o19N6EzzbUm.png" />'.$fbpost['shares']['count'].' ' : ""  ?>
								</a>
							</div>
						<?php elseif(isset($fbpost['picture'])): ?>
							<div class="wpemfb-col-12 wpemfb-text-center">
								<a class="wpemfb-clean-link" href="<?php echo "https://www.facebook.com/".$link[0]."/posts/".$link[1] ?>" target="_blank" rel="nofollow">
									<img src="<?php echo $fbpost['picture'] ?>" />
								</a>
							</div>
						<?php elseif(isset($fbpost['message'])): ?>
							<div class="wpemfb-col-12">
								<span class="wpemfb-page-post"><?php echo make_clickable($fbpost['message']) ?></span><br>
								<a class="wpemfb-post-link" href="<?php echo "https://www.facebook.com/".$link[0]."/posts/".$link[1] ?> " target="_blank" rel="nofollow">
									<?php echo isset($fbpost['likes']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/y6/r/l9Fe9Ugss0S.gif" />'.$fbpost['likes']['summary']['total_count'].' ' : ""  ?>
									<?php echo isset($fbpost['comments']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/yg/r/V8Yrm0eKZpi.gif" />'.$fbpost['comments']['summary']['total_count'].' ' : ""  ?>
									<?php echo isset($fbpost['shares']) ? '<img src="https://fbstatic-a.akamaihd.net/rsrc.php/v2/y2/r/o19N6EzzbUm.png" />'.$fbpost['shares']['count'].' ' : ""  ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			<?php endforeach; ?>
		</div>
	</div>

</div>