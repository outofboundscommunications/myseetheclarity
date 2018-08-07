<?php
/* Registered Sidebars Blocks */
class AQ_Shortcode extends AQ_Block {
	
	function __construct($args) {
		$block_options = array(
			'name' => $args['name'],
			'size' => 'span12',
			'atts' => $args['atts'],
			'child' => $args['child'],
			'content' => $args['content'],
			'view' => 'all',
			'group_type' => $args['group_type']
		);
		
		parent::__construct('AQ_Shortcode', $block_options);
		
		//add ajax functions
		add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
	}
	
	function form($instance) {
		
		$defaults = array();
		foreach ($this->block_options['atts'] as $name => $att) {
			$defaults[$name] = $att['default'];
		}
		
		if(  $this->block_options['child'] != '' ){ 
		
			$shortcodes_builder = get_option('_code125_shortcodes');
			
			foreach ($shortcodes_builder[$this->block_options['child']]['atts']
			 as $key => $value) {
				$tab[$key]= $value['default'];
			}
			
			if(isset($shortcodes_builder[$this->block_options['child']]['content'])){
				$tab['content'] = $shortcodes_builder[$this->block_options['child']]['content'];
			}
			$tab['child_name'] = $this->block_options['child'];
			
			$defaults['tabs']=array();
			$defaults['tabs'][] = $tab;
			
		}
		
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		
		$shortcode_name = $this->block_options['name']. '_';
		
		$view_values=array(
			'all'=> 'All Screens',
			'mobile' => 'Mobile Only',
			'tablet' => 'Tablets Only',
			'desktop' => 'Desktop Only',
			'mobile-tablet' => 'Mobile & Tablets Only',
			'desktop-tablet' => 'Desktop & Tablets Only'
		);
		
		if(isset($instance[$shortcode_name .'view'])){
			$one_value_view = $instance[$shortcode_name .'view'];
		}else {
			$one_value_view ='all';
		}
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id($shortcode_name . 'view') ?>">Show this shortcode on:<?php echo aq_field_select($shortcode_name . 'view', $block_id, $view_values, $one_value_view)?>
			</label>
		</p>
		<?php
		
		
		foreach ($this->block_options['atts'] as $key => $att) {
			$errors = array_filter($att['values']);
			if(isset($instance[$shortcode_name . $key])){
				$one_value = $instance[$shortcode_name . $key];
			}else {
				$one_value =$att['default'];
			}
			
			if (!empty($errors)) { 
				
			?>
				
				<p class="description">
					<label for="<?php echo $this->get_field_id($shortcode_name . $key) ?>"><?php echo $att['desc']; ?><?php echo aq_field_select($shortcode_name . $key, $block_id, $att['values'], $one_value) ?>
					</label>
				</p>
			
			<?php }else { 
			
			?>
				<p class="description">
					<label for="<?php echo $this->get_field_id($shortcode_name . $key) ?>"><?php echo $att['desc']; ?><?php echo aq_field_input($shortcode_name . $key, $block_id, $one_value, $size = 'full') ?>
					</label>
				</p>	
			<?php	}
			}
			
			if( $this->block_options['content'] != '' ){ 
				if(isset($instance[$shortcode_name . 'content'])){
					$one_value = $instance[$shortcode_name . 'content'];
				}else {
					$one_value =$this->block_options['content'];
				}
			?>
				<p class="description">
					<label for="<?php echo $this->get_field_id($shortcode_name . 'content') ?>">
					content<?php echo aq_field_textarea($shortcode_name . 'content', $block_id, $one_value, $size = 'full') ?>
					</label>
				</p>	
			<?php }
			
			
			if( $this->block_options['child'] != '' ){ 
			
				
				
				?>
				<p class="sum_title"><?php  echo $this->block_options['child'] ?>s:</p>
				<div class="description cf" >
					<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>" data-shortcode-type="<?php echo $this->block_options['child'] ?>">
						<?php
						$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
						$count = 1;
						
						foreach($tabs as $tab) {
							$tab['child_name'] = $this->block_options['child'];	
							$this->tab($tab, $count);
							$count++;
						}
						?>
					</ul>
					<p></p>
					<a href="#" rel="tab" class="aq-sortable-add-new button">Add New <?php  echo $this->block_options['child'] ?></a>
					<p></p>
				</div>
				<?php
			
			}
		
		
		
		
		
	}
	
	function block($instance) {
		extract($instance);
		if(isset($instance[$name . '_view']) ){
			$view = $instance[$name . '_view'];
		}else {
			$view = 'all';
		}
		
		$include = false;
		if($view=="mobile"){
			if(is_mobile()){
				$include = true;
			}
		}elseif($view=="tablet"){
			if(is_tablet()){
				$include = true;
			}
		}elseif($view=="mobile-tablet"){
			if(is_handheld()){
				$include = true;
			}
		}elseif($view=="desktop"){
			if(!is_handheld()){
				$include = true;
			}
		}elseif($view=="desktop-tablet"){
			if(!is_mobile()){
				$include = true;
			}
		}else{
			$include = true;
			
		}
		$code = '';
		if($include){
		
		$code =  $code  .'['.$name.' ';
		foreach ($atts as $key => $value) {
			if(isset($instance[$name . '_' . $key])){
				$code = $code . ' ' . $key . '="'. $instance[$name . '_' . $key] . '"';
			}else{
				$code = $code . ' ' . $key . '="'. $value['default'] . '"';
			}
		}
		$code = $code . ']';
		
		if($child != ''){ 
				foreach ($tabs as $key => $value) {
					$code = $code .'[' . $child . ' ';
					foreach ($value as $key2 => $value2) {
						if($key2 != 'content'){
							$code = $code .  $key2 . '="' . $value2 .'" '; 
						} 
					}
					$code = $code . ']';
					if(isset($value['content'])){
						$code = $code . html_entity_decode($value['content']) . '[/' . $child  . ']';
					}
				 
				}
			
		
		}
		if( $instance['content'] != ''){
			if(isset($instance[$name . '_content'])){
				$code = $code . html_entity_decode($instance[$name . '_content']) . '[/' . $name .']';
			}else {
				$code = $code . '[/' . $name .']';
			}
		}elseif ( $child != '' ) {
			$code = $code . '[/' . $name .']';
		}
		}
		return $code;
	}
	
	function tab($tab = array(), $count = 0) {
			
		$shortcode_name = $tab['child_name']. '_';	
		?>
		<li id="<?php echo $this->get_field_id($tab['child_name']) ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
			
			<div class="sortable-head cf">
				<div class="sortable-title">
					<strong><?php echo $tab['child_name'] ?></strong>
				</div>
				<div class="sortable-handle">
					<a href="#">Open / Close</a>
				</div>
			</div>
			
			<div class="sortable-body">
			
			<?php 
			
				$shortcodes_builder = get_option('_code125_shortcodes');
				foreach ($shortcodes_builder[$tab['child_name']]['atts'] as $key => $att) {
				$errors = array_filter($att['values']);
				
					 
					if (!empty($errors)) { ?>
						<p class="description">
							<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-<?php echo $key ?>"><?php echo $att['desc']; ?>
							
							
							
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-<?php echo $key ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][<?php echo $key ?>]">
								<?php foreach ($att['values'] as $key2 => $value2) { 
									if ($key2 == $tab[$key]){
										$selected = 'selected="selected"';
									}else {
										$selected = '';
									}
								?>
									<option value="<?php echo $key2  ?>" <?php echo $selected; ?>><?php echo $value2 ?></option>
								<?php } ?>
							
							</select>
							
							</label>
						
						</p>
					<?php }else { ?>
					
						<p class="description">
							<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-<?php echo $key ?>"><?php echo $att['desc']; ?><input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-<?php echo $key ?>" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][<?php echo $key ?>]" value="<?php echo $tab[$key] ?>" />
							</label>
						</p>	
					
					<?php }
					
					
					
									
				}
				if(isset($shortcodes_builder[$tab['child_name']]['content'])){ ?>
					<p class="description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">Content<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" ><?php echo $tab['content'] ?></textarea>
						</label>
					</p>
				<?php }
				
				  ?>
				
				<input type="hidden" class="child_name" name="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-child_name" value="<?php  echo $tab['child_name'] ?>" />
				<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
			</div>
			
		</li>
		<?php
	}
	
	
	/* AJAX add tab */
	function add_tab() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		$name = $_POST['type'];
		
		$shortcodes_builder = get_option('_code125_shortcodes');
			
			$tab=array();
			
			foreach ($shortcodes_builder[$name]['atts']
			 as $key => $value) {
				$tab[$key]= $value['default'];
			}
			
			if(isset($shortcodes_builder[$name]['content'])){
				$tab['content'] = $shortcodes_builder[$name]['content'];
			}
			
			$tab['child_name'] = $name;	
			
			
		
		
		
		if($count) {
			$this->tab($tab, $count);
		} else {
			die(-1);
		}
		
		die();
	}
	
	function update($new_instance, $old_instance) {
		$new_instance = aq_recursive_sanitize($new_instance);
		return $new_instance;
	}
	
}