<?php
$social_profiles_social_box_title = get_field('social_profiles_social_box_title', 'option');
if( $social_profiles_social_box_title ){
	?>
	<span class="social-profile-title">
		<?php echo $social_profiles_social_box_title;?>
	</span>
	<?php
}
$social_profiles = get_field('social_profiles', 'option');

// check if the flexible content field has rows of data
if( have_rows('social_profiles', 'option') ):
	
	?>
	<div class="potenza-social-icon">
		<?php
		
		// loop through the rows of data
		while ( have_rows('social_profiles', 'option') ) : the_row();
	 
			if( get_row_layout() == 'social_profile' ):
	 
				$social_profile_title = get_sub_field('social_profile_title');
				$social_profile_icon  = get_sub_field('social_profile_icon');
				$social_profile_url  = get_sub_field('social_profile_url');
				$social_profile_target  = get_sub_field('social_profile_target');
				$social_class=strtolower($social_profile_title);
				if( !$social_profile_target ){
					$social_profile_target = 1;
				}
				$social_profile_icon_data = getimagesize($social_profile_icon);
				?>
				<a <?php echo ($social_profile_target==1)?'target="_blank"':'' ?> title="<?php echo $social_profile_title;?>" href="<?php echo $social_profile_url;?>" class="<?php echo $social_class; ?>">
					<!--<img src="<?php echo $social_profile_icon?>" border="0" alt="<?php echo $social_profile_title;?>" <?php echo $social_profile_icon_data[3];?>/>-->
				</a>
				<?php
			endif;
	 
		endwhile;
		?>
	</div>
	<?php
else :
	// no layouts found
endif;
?>