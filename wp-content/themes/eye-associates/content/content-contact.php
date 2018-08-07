<section class="dailies-brand">
 <div class="container">
  <div class="row">
   <div class="col-sm-12 text-center">
    <h1 class="text-left"><span class="text-white"><?php the_field('contact_title');?></h1>
    <div class="dailies-img"><img class="img-responsive" src="<?php the_field('contact_image');?>"/></div>
    <a class="ea-btn-large" href="<?php the_field('sub_title_link'); ?>"><?php the_field('contact_sub_title');?></a>
   </div>
  </div>
</div>
</section>
<section class="blink-about" style="background-image:url(<?php the_field('section_image');?>);">
 <div class="container">
  <div class="row">
   <div class="col-sm-6 left-side">
    <div class="vertical-text">
    <h2><strong><?php the_field('section_title');?></strong></h2>
   </div>
   </div>
   <div class="col-sm-6 right-side">
       <div class="vertical-text">
        <?php the_field('section_content');?>
      </div>
   </div>
  </div>
</div>
</section>
<br /><br />
<section class="dielies-content">
  <div class="container">
   <div class="row">
	<?php
			$page_content_editor_type = get_field('page_content_editor_type');
			if( !$page_content_editor_type ){
				$page_content_editor_type = 'default';
			}
			if( $page_content_editor_type == 'block' ){
				get_template_part( 'content/page', 'blocks' );
			}else{
				$content = $post->post_content;
				if( has_shortcode( $content, 'container' ) ) {
					the_content();
				}else{
					?>
					<!--div style="background-color:#F9F7F7;" class="content-container">
						<div class="container "-->
							<?php the_content();?>
						<!--/div-->
					<!--/div-->
					<?php
				}
				?>
				<?php // wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );?>
				<?php
			}
			?>
    <?php //the_content();?>
   </div> 
  </div>
</section>
<br /><br />

