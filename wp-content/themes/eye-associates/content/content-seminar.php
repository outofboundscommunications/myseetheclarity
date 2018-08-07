<?php $article_id=get_the_ID(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div style="background-color:#F9F7F7;" class="content-container">
			<div class="container seminarcls">
				<div class="row">
					<div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="bordercls">
                                    <img class="img-responsive" src="<?php the_field('logo_image_1',$article_id); ?>" />
                                </div>                                
                            </div>
                            <div class="col-sm-6">
                                <div class="bordercls">
                                    <img class="img-responsive" src="<?php the_field('logo_image_2',$article_id); ?>" />
                                </div>                                
                            </div>
                        </div>                        
						<h2><?php the_field('title',$article_id); ?></h2>
						<h4><?php the_field('sub_title',$article_id); ?></h4>
						<?php /* list of seminar dates */ 
							$posts = get_posts( 'post_type=seminars&numberposts=-1&post_status=publish' );
							if(!empty($posts)){
								?>
								<ul>
									<?php foreach($posts as $post) { ?>
									<li>
									<?php echo get_field('date_and_time',$post->ID); ?> - <?php echo $post->post_title; ?>
									</li>
									<?php } ?>
								</ul>
								<?php
							}
						?>
					</div>
					<div class="col-sm-6">
						<?php the_field('above_form_content',$article_id); ?>
						<?php $seminar_form=get_field('seminar_form',$article_id); ?>
						<?php echo do_shortcode($seminar_form); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
					<?php the_field('below_form_content',$article_id); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->		
</article><!-- #post -->