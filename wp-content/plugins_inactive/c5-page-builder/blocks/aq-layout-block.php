<?php
/* Registered Sidebars Blocks */
class AQ_Layout extends AQ_Block {
	
	function __construct($args) {
		$block_options = array(
			'name' => $args['name'],
			'size' => $args['size'],
			'element_type' => 'column',
			'desc' => $args['desc']
		);
		
		parent::__construct('AQ_Layout', $block_options);
		
	}
	
	function form($instance) { ?>
		<p class="empty-column"><?php echo $this->block_options['desc']; ?></p>
		<ul class="blocks column-blocks cf"></ul>
	<?php }
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_base_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		
		extract($instance);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-aq_column_block block-AQ_Column_6_12_Block block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">',
						'<p class="empty-column">'. $desc .'</p>',
						'<ul class="blocks column-blocks cf ">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($GLOBALS['template_id']);
			
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks['code125_' . $name];
					
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo 		'</ul>';
			
		}else{
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
		
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">X</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
			echo '<input type="hidden" class="desc" name="'.$this->get_field_name('desc').'" value="'.$desc.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		
		$code = '';
		
		//column block header
		if(isset($template_id)) {
			$this->before_block($instance);
			
			//define vars
			$overgrid = 0; $span = 0; $first = true; $last =false;
			
			//check if column has blocks inside it
			$blocks = aq_get_blocks($GLOBALS['template_id']);
			
			
			
			//outputs the blocks
			if($blocks) {
				
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks['code125_' . $name];
					
					if(class_exists($id_base)) {
						
						//insert template_id into $child
						$child['template_id'] = $template_id;
						
						//display the block
						if($child['id_base'] != 'aq_layout') {
							if($child['parent'] == $col_order) {
								
								$code =  $code. $block->block_callback($child);
							}
						}
					}
				}
			} 
			
			$this->after_block($instance);
			
		} else {
			//show nothing
		}
		
		return $code;
	}
	
}