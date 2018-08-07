<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div style="background-color:#F9F7F7;" class="content-container">
			<div class="container ">
				<div class="row">
						<?php
							if(isset($_GET['eid'])){
								$eid=$_GET['eid'];
								$content=get_the_content();
								$entry = GFAPI::get_entry( $eid );
								$content=str_replace("[Name]",$entry[1]." ".$entry[2],$content);
								//get the post 
								$dattime=get_field('date_and_time',$entry[10]);
								$dattime_array=explode(" ",$dattime);
								$address=get_field('address',$entry[10]);
								$content=str_replace("[date]",$dattime_array[0],$content);
								$content=str_replace("[time]",$dattime_array[1]." ".$dattime_array[2],$content);
								$content=str_replace("[address]",$address,$content);
								echo $content;
							}
						?>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->		
</article><!-- #post -->