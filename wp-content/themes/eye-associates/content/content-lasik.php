	<div class="imgBlur">
		<img src="<?php the_field('lasik_image');?>" class="img-responsive" />
		<h2 class=" text-black"><?php the_field('lasik_content');?></h2>
	</div>
<div class="advance lasikadvns"  style="background:url(<?php the_field('lasik_image');?>) no-repeat right center;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class=" text-black"><?php the_field('lasik_content');?></h2>
					 <div class="image">
					   <img class="responsive" src="<?php the_field('lasik_image2');?>">
					 </div>
				</div>
			</div>
		</div>
	
</div>
<div class="dielies-content-2 gray-bg">
  <div class="container">
   <div class="row">
    <?php the_content();?>
    <div class="btn-group text-center">
        <?php 
        if(get_field('seminar_title')=="")
        {
        ?>
            <a class="btn btn-default active" href="<?php the_field('appointment_url');?>"><?php the_field('appointment');?></a><?php  ?>
        <?php
        }
        else
        {
        ?>
            <?php if(get_field('seminar')==""){ ?><a class="btn btn-default active" href="<?php the_field('seminar_url');?>"><?php the_field('seminar');?></a><?php } ?>
            <?php if(get_field('appointment')==""){ ?><a class="btn btn-default" href="<?php the_field('appointment_url');?>"><?php the_field('appointment');?></a><?php } ?>
        <?php 
        }
        ?>
    </div>
    </div>
   </div> 
  </div>
</div>
    <?php
    if(get_field('seminar_title')=="")
    {
    ?>
    
    <?php
    }
    else
    {
    ?>
<div class="seminar">
 <div class="container">
  <div class="row">
   <div class="col-sm-4">
    <div class="vertical-text"><img src="<?php the_field('seminar_image');?>"></div>
   </div>
   <div class="col-sm-8">
       <div class="vertical-text">
           <h3><?php the_field('seminar_title');?></h3>
           <?php the_field('seminar_content');?>
       </div>
   </div>
  </div>
  <div class="row">
     <div class="col-sm-12">
         <div class="seminar-btn">
           <a class="ea-btn-large" href="<?php echo site_url(); ?>/lasik-seminar/"><?php the_field('seminar_button');?></a>
         </div>
     </div>
  </div>
</div>
</div>
<?php
    }
?>

<div class="eye green-bg">
 <div class="container">
  <div class="row">
   <div class="col-sm-8">
    <div class="vertical-text">
       <h3 class="text-white"><?php the_field('eye_title');?></h3>
       <p class="text-white"><?php the_field('eye_content');?></div>
   </div>
   </div> 
  </div>
</div>

<div class="performed dark-green" >
 <div class="container">
  <div class="row">
   <div class="col-sm-5">
     <ul class="list-inline">
     <?php
     if( have_rows('eye_list') ):
        while ( have_rows('eye_list') ) : the_row();
            ?>
             <li><span><?php the_sub_field('list_performs');?></span><br><?php the_sub_field('list_title');?></li>
            <?php
        endwhile;
     endif;
    ?>  
     </ul>
   </div>
   <div class="col-sm-7"> 
    <div class="performed-img">
        <img src="<?php the_field('eye_image');?>">
    </div>
   </div>
   </div>
  </div>
</div>