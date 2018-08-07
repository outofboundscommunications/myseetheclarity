<?php if( isset($GLOBALS['template-file'])){
	$template_bool = false;
}else {
	$template_bool = true;
}

	if(!is_page_template('template-blank.php') && $template_bool){ ?>
<?php if (!is_page()) {?>
	
	</div> <!-- end #container -->
<?php } ?>



<?php 

$skin= get_page_parameter('skin_default','',false);
$skin_data = code125_get_skin($skin);

 $footer_data = array();
 $footer_name= $skin_data['footer_default'];
 if( $footer_name == ''){
 	$footer_name = ot_get_option('footer_templates');
 }
 
		$footer_templates = ot_get_option('footer_templates', array());

            if ($footer_templates) {
                foreach ($footer_templates as $footer_template) {
                    if ($footer_template['slug'] == $footer_name) {
                        $footer_data = $footer_template;
                        $footer_name_bool = true;
                    }
                }
           
        }
      
     


 ?>
 <?php 
 if(count($footer_data)!= 0){
  ?>
 	
<footer id="footer" class="footer clearfix">
  
  <?php 
  if($footer_data['footer_template'] !=''){
    ?>
  
  <div class="footerbg clearfix">
  <div class="shadow">
  </div>
   <div class="mid-page">
    <?php
    	echo do_shortcode('[template id="'.$footer_data['footer_template'].'"]');
    ?>
    </div>
  </div>
  
  <?php } 
  
  if($footer_data['bottom'] !=''){
  ?>
  <!--Social links Start-->
  <section id="footer_bottom" class="dark-mode clearfix">
  	<div class="mid-page">
  	<?php echo do_shortcode($footer_data['bottom']); ?>
  	</div>
  </section>
  <!--Social links End-->
<?php } ?>
</footer><!-- end footer -->
<?php } ?>
		
		<?php } ?>
		</div>
		<?php 
		
		// Your content to test
		$GLOBALS['end_time'] = microtime(true); 
		$elapsed = $GLOBALS['end_time'] - $GLOBALS['start_time'];
		 ?>
		<!--<?php echo "Execution time : $elapsed seconds"; ?> -->
		<?php wp_footer(); // js scripts are inserted using this function ?>
	</body>

</html> <!-- end page. what a ride! -->