<?php

    /*
     * Grab the settings from $instance and fill out default
     * values as needed.
     */
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $first_name = empty($instance['first_name']) ? '' : $instance['first_name'];
    $last_name = empty($instance['last_name']) ? '' : $instance['last_name'];
    if( is_array( $instance['sailthru_list'] ) )
    {
        $sailthru_list = implode(',', $instance['sailthru_list'] );
    } else {
        $sailthru_list = $instance['sailthru_list'];
    }


    // display options
    $customfields = get_option('sailthru_forms_options');

 
    // nonce
    $nonce = wp_create_nonce("add_subscriber_nonce"); 

 ?>
 <div class="sailthru-signup-widget">
     <div class="sailthru_form">

        <?php
            // title
            if (!empty($title)) {
                if(!isset($before_title)) {
                    $before_title = '';
                }
                if(!isset($after_title)) {
                    $after_title = '';
                }
                echo $before_title . esc_html(trim($title)) . $after_title;
            }
        ?>
         <form method="post" action="#" id="sailthru-add-subscriber-form">
            <div id="sailthru-add-subscriber-errors"></div>
            <?php
            // grab custom fields and show them in the form
            foreach ($customfields as $section) {
            $section_field_name = str_replace(" ", '_', $section);
				if(!empty($section)){
					if( $instance['show_'.$section.'_name'] ) {
					?>
					
	            <div class="sailthru_form_input">
	                <?php
	                //check if the field is required
	                if($instance['show_'.$section.'_required'] == 'checked'){
		                ?>
		                <label for="sailthru_first_name"><?php echo $section;?>*:</label>
		                <input type="<?php echo $instance['show_'.$section.'_type'];?>" required="required" name="custom_<?php echo $section_field_name;?>" id="sailthru_<?php echo $section;?>_name" value="" />
						<?php
					}
					else{
						?>
						<label for="sailthru_first_name"><?php echo $section;?>:</label>
						<input type="<?php echo $instance['show_'.$section.'_type'];?>" name="custom_<?php echo $section_field_name;?>" id="sailthru_<?php echo $section;?>_name" value="" />
					
						<?php
					}
					?>
					</div>
	            	<?php 
	            
	            	} ?>
				
				
				<?php
				}
				}
	        
            		?> 

            <div class="sailthru_form_input">
                <label for="sailthru_email">Email:</label>
                <input type="email" name="email" id="sailthru_email" value="" />
            </div>

            <div class="sailthru_form_input">
                <input type="hidden" name="sailthru_nonce" value="<?php echo $nonce; ?>" />
                <input type="hidden" name="sailthru_email_list" value="<?php echo esc_attr($sailthru_list); ?>" />
                <input type="hidden" name="action" value="add_subscriber" />
                <input type="hidden" name="vars[source]" value="<?php bloginfo('url'); ?>" />
                <input type="submit" value="Subscribe" />
            </div>
        </form>
    </div>
</div>
