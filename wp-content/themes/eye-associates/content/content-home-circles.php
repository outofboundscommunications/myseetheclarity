<div class="home-circles">
	<div class="container">
		<div class="outer">
			<?php
			$circle_ddefault_colors = array(
				'008d8d',
				'01c3ff',
				'006482',
			);
			for( $i = 1; $i <= 3; $i++ ){
				$home_featured_block_title = get_field('home_featured_block_title_'.$i);
				if( !$home_featured_block_title ){
					$home_featured_block_title = 'block 1';
				}
				$home_featured_block_icon = get_field('home_featured_block_icon_'.$i);
				
				if( !$home_featured_block_icon ){
					$home_featured_block_icon = get_stylesheet_directory_uri().'/images/circle_'.$i.'.png';
				}
				$home_featured_block_link = get_field('home_featured_block_link_'.$i);
				$home_featured_block_color = get_field('home_featured_block_color_'.$i);
				if( !$home_featured_block_color ){
					$home_featured_block_color = '#CCCCCC';
				}
				?>
				<div class="ellipse home-circle<?php echo ( $i == 3 ? ' last' : '' );?>">
					<div class="home-circle-innner" style="background-color: #<?php echo $circle_ddefault_colors[$i-1];?>">
						<?php
						if( $home_featured_block_link ){
							?>
							<a href="<?php echo $home_featured_block_link;?>">
							<?php
						}
						$home_featured_block_icon_data = getimagesize($home_featured_block_icon);
						?>
						<span class="home-circle-title"><?php echo $home_featured_block_title;?></span>
						<span class="home-circle-icon">
							<img src="<?php echo $home_featured_block_icon;?>" alt="<?php echo $home_featured_block_title;?>" title="<?php echo $home_featured_block_title;?>" <?php echo $home_featured_block_icon_data[3];?>/>
						</span>
						<?php
						if( $home_featured_block_link ){
							?>
							</a>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
			?>
			
			<?php /* ?>
			<div class="ellipse home-circle">
				<div class="home-circle-innner">
					<span class="home-circle-title">Title</span>
					<span class="home-circle-icon">Icon</span>
				</div>
			</div>
			<div class="ellipse home-circle last">
				<div class="home-circle-innner">
					<span class="home-circle-title">Title</span>
					<span class="home-circle-icon">Icon</span>
				</div>
			</div>
			<?php */ ?>
		</div>
	</div>
</div>
