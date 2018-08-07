<?php

function filter_textarea_tinymce($content, $field_id) {

    /* only run the filter on the textarea with a field ID of my_textarea */
    if ($field_id == 'content') {
        return false;
    }



    return $content;
}

add_filter('ot_tinymce', 'filter_textarea_tinymce', 10, 2);


/**
 * Initialize the options before anything else. 
 */
add_action('admin_init', '_custom_theme_options', 1);

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

    /**
     * Get a copy of the saved settings array. 
     */
    $saved_settings = get_option('option_tree_settings', array());

    include(TEMPLATEPATH . '/library/includes/admin/fonts.php');

    $google_fonts = get_google_fonts();

    foreach ($google_fonts as $font) {
        $font = array(
            'label' => $font,
            'value' => $font
        );


        array_push($google_fonts, $font);
    }


    $sidebars_new = ot_get_option('sidebars', array());

    $sidebars = array(
        array(
            'label' => 'Primary Sidebar',
            'value' => 'primary'
        ),
        array(
            'label' => 'Post Sidebar',
            'value' => 'post'
        ),
        array(
            'label' => 'Page Sidebar',
            'value' => 'page'
        )
    );

    foreach ($sidebars_new as $sidebar_new) {
        $array = array(
            'label' => $sidebar_new['title'],
            'value' => $sidebar_new['slug']
        );
        array_push($sidebars, $array);
    }

    $header_templates = ot_get_option('header_templates', array());

    

    $skins = array(
    		array(
    		    'label' => 'Predefined Skin1',
    		    'value' => 'pre-skin1'
    		)
    		    );
    		
    		    $skins2 = array(
    		        array(
    		            'label' => 'Default',
    		            'value' => ''
    		        )
    		    );
    
    		$query = new WP_Query( array( 'post_type' => 'skin', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish' ) );
    		
    		/* has posts */
    		if ( $query->have_posts() ) {
    		  while ( $query->have_posts() ) {
    		    $query->the_post();
    		    $array =  array(
    		            'label' => get_the_title(),
    		            'value' => get_the_ID()
    		        );
    		    array_push($skins, $array);
    		    array_push($skins2, $array);
    		    
    		  
    		} 
    		}
    		wp_reset_postdata();
    
    $post_types = array(
    	array(
    	    'label' => 'Post',
    	    'value' => 'post'
    	),
    	array(
    	    'label' => 'Portfolio',
    	    'value' =>  'portfolio'
    	),
    	array(
    	    'label' =>  'Team',
    	    'value' => 'team'
    	),
    	array(
    	    'label' => 'FAQ',
    	    'value' => 'faq'
    	),
    	array(
    	    'label' => 'Testimonial',
    	    'value' => 'testimonial'
    	)
        );
    
    $posts_custom = ot_get_option('custom_posts', array());
       
    
        if ($posts_custom) {
            foreach ($posts_custom as $post_custom) {
                $icon = array(
                    'label' => $post_custom['title'],
                    'value' => $post_custom['slug']
                );
                array_push($post_types, $icon);
            }
        }

	
	



    $all_settings = array(
        array(
            'label' => 'Main Logo',
            'id' => 'logo',
            'type' => 'upload',
            'desc' => 'Upload the main logo for your website.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Logo Subline',
            'id' => 'logo_subline',
            'type' => 'text',
            'desc' => 'Add logo subline text or leave it and it wont show.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Logo Size',
            'id' => 'logo_size',
            'type' => 'select',
            'desc' => 'Choose The logo size, "It is better for retina display to upload full image and assign a smaller size"., Default: Height 30',
            'choices' => array(
                array(
                    'label' => 'Height 20',
                    'value' => 'height_20'
                ),
                array(
                    'label' => 'Height 30',
                    'value' => 'height_30'
                ),
                array(
                    'label' => 'Height 40',
                    'value' => 'height_40'
                ),
                array(
                    'label' => 'Height 50',
                    'value' => 'height_50'
                ),
                array(
                    'label' => 'Height 60',
                    'value' => 'height_60'
                ),
                array(
                    'label' => 'Height 70',
                    'value' => 'height_70'
                ),
                array(
                    'label' => 'Height 80',
                    'value' => 'height_80'
                ),
                array(
                    'label' => 'Height 90',
                    'value' => 'height_90'
                ),
                array(
                    'label' => 'Height 100',
                    'value' => 'height_100'
                ),
                array(
                    'label' => 'Full Size',
                    'value' => 'full'
                )
            ),
            'std' => 'height_30',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Main Logo Top Margin',
            'id' => 'logo_margin',
            'type' => 'text',
            'desc' => 'Top Margin for the logo for your website, Default:0px.',
            'std' => '0px',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'favicon',
            'id' => 'favicon',
            'type' => 'upload',
            'desc' => 'Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.',
            'std' => get_template_directory_uri() . '/favicon.png',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Choose your Homepage',
            'id' => 'homepage',
            'type' => 'page-select',
            'desc' => 'Choose the page to display its content and slider as your homepage.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Preview Mode',
            'id' => 'preview',
            'type' => 'select',
            'desc' => 'Choose Yes to enable Preview Mode to test some colors changes in your website.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Maintaince Mode',
            'id' => 'maintaince',
            'type' => 'select',
            'desc' => 'Choose Yes to enable Maintaince Mode to your website.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Enable SEO',
            'id' => 'seo',
            'type' => 'select',
            'desc' => 'Choose Yes to enable Built in SEO Features.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Enable Website Compression',
            'id' => 'gzip',
            'type' => 'select',
            'desc' => 'Choose Yes to enable gzip compression.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Website Description',
            'id' => 'web_description',
            'type' => 'textarea-simple',
            'desc' => 'Add your website description "it will be used in facebook share".',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Contact Page e-mail',
            'id' => 'contact_page',
            'type' => 'text',
            'desc' => 'Add the contact e-email for the contact form.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Google Analytics Code',
            'id' => 'google_analytics',
            'type' => 'textarea-simple',
            'desc' => 'Paste your Google Analytics (or other) tracking code here. This will be added into your theme.',
            'std' => '',
            'rows' => '10',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Custom CSS Code',
            'id' => 'custom_css',
            'type' => 'textarea-simple',
            'desc' => 'Paste your custom css code.',
            'std' => '',
            'rows' => '10',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Custom Javascript Code',
            'id' => 'custom_js',
            'type' => 'textarea-simple',
            'desc' => 'Paste your custom Javascript code.',
            'std' => '',
            'rows' => '10',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'general_default'
        ),
        array(
            'label' => 'Choose The default Skin',
            'id' => 'skin_default',
            'type' => 'select',
            'desc' => 'Choose The Skin.',
            'choices' => $skins,
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'layout_option'
        ),
        array(
            'label' => 'Responsive',
            'id' => 'responsive',
            'type' => 'select',
            'desc' => 'Choose Yes to enable Responsive in your website.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'layout_option'
        ),
       array(
            'label' => 'RTL',
            'id' => 'rtl',
            'type' => 'select',
            'desc' => 'Choose Yes to enable RTL in your website.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'layout_option'
        ),
        //// Social
        array(
            'label' => 'Facebook username',
            'id' => 'facebook',
            'type' => 'text',
            'desc' => 'Add your facebook username.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        array(
            'label' => 'Facebook App ID',
            'id' => 'facebook_ID',
            'type' => 'text',
            'desc' => 'Add your facebook App ID "used for analytics with your likes and social integration".',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        array(
            'label' => 'Default facebook thumb',
            'id' => 'facebook_thumb',
            'type' => 'upload',
            'desc' => 'Upload the default thumb for your website in facebook sharing, "Mostly showen when sharing your homepage".',
            'std' => get_template_directory_uri() . '/library/images/thumb.jpg',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        array(
            'label' => 'Twitter username',
            'id' => 'twitter',
            'type' => 'text',
            'desc' => 'Add your twitter username.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        array(
            'label' => 'Google Plus Link',
            'id' => 'google_plus',
            'type' => 'text',
            'desc' => 'Add your Google Plus Link.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        
        array(
            'label' => 'RSS Link',
            'id' => 'rss',
            'type' => 'text',
            'desc' => 'Add your RSS link.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        array(
            'label' => 'Social Top Icons',
            'id' => 'social_icons',
            'type' => 'list-item',
            'desc' => 'Add Social Icons',
            'settings' => array(
                array(
                    'label' => 'Link',
                    'id' => 'link',
                    'type' => 'text',
                    'desc' => 'Your Social Link',
                    'choices' => '',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Icon',
                    'id' => 'icon',
                    'type' => 'text',
                    'desc' => 'Add Link Icon class, Default icon-facebook',
                    'std' => 'icon-facebook',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Type',
                    'id' => 'type',
                    'type' => 'select',
                    'desc' => 'Select Link Type, Default Link',
                    'choices' => array(
                        array(
                            'label' => 'Link',
                            'value' => 'link'
                        ),
                        array(
                            'label' => 'Search',
                            'value' => 'search'
                        ),
                        array(
                            'label' => 'Account',
                            'value' => 'account'
                        ),
                        array(
                            'label' => 'Email',
                            'value' => 'email'
                        ),
                        array(
                            'label' => 'Languages',
                            'value' => 'languages'
                        )
                    ),
                    'std' => 'link',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'social'
        ),
        /// Article Settings

        array(
            'label' => 'Article Layout',
            'id' => 'article_layout',
            'type' => 'select',
            'desc' => 'Choose Default artile Layout Left/Right Sidebar or Full Width, Default: Right Sidebar.',
            'choices' => array(
                array(
                    'label' => 'As Each Article settings',
                    'value' => ''
                ),
                array(
                    'label' => 'Right Sidebar',
                    'value' => 'right'
                ),
                array(
                    'label' => 'Left Sidebar',
                    'value' => 'left'
                ),
                array(
                    'label' => 'Full Width',
                    'value' => 'full'
                )
            ),
            'std' => 'right',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Follow Category styling Settings',
            'id' => 'article_styling',
            'type' => 'select',
            'desc' => 'Follow the article category styling Settings, Default: Yes.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Like Button',
            'id' => 'like_enable',
            'type' => 'select',
            'desc' => 'Select use the Like system or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show View Count',
            'id' => 'view_count_enable',
            'type' => 'select',
            'desc' => 'Select use the View Count system or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Author Link',
            'id' => 'author_enable',
            'type' => 'select',
            'desc' => 'Select to show the author link or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Share Links',
            'id' => 'share_enable',
            'type' => 'select',
            'desc' => 'Select to show the share links or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Category Link',
            'id' => 'cat_enable',
            'type' => 'select',
            'desc' => 'Select to show the Category link or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Date links',
            'id' => 'date_enable',
            'type' => 'select',
            'desc' => 'Select to show the date or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Time/Date Display Options',
            'id' => 'time_date',
            'type' => 'select',
            'desc' => 'Select the Format for time display',
            'choices' => array(
                array(
                    'label' => 'Month - Day - Year',
                    'value' => 'month'
                ),
                array(
                    'label' => 'Month - Day - Year - Clock',
                    'value' => 'clock'
                )
            ),
            'std' => 'month',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Comments count',
            'id' => 'comments_count_enable',
            'type' => 'select',
            'desc' => 'Select to show the Comments count or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Show Related Posts',
            'id' => 'related_enable',
            'type' => 'select',
            'desc' => 'Show Related Posts or not.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Related Posts Type',
            'id' => 'related_type',
            'type' => 'select',
            'desc' => 'Select Related Posts selection type based on:',
            'choices' => array(
                array(
                    'label' => 'Tags',
                    'value' => 'tags'
                ),
                array(
                    'label' => 'Category',
                    'value' => 'category'
                ),
                array(
                    'label' => 'Random',
                    'value' => 'random'
                )
            ),
            'std' => 'tags',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Featured Media Enable',
            'id' => 'featured_enable',
            'type' => 'select',
            'desc' => 'Featured Media inside Article Enable',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Comments Section Enable',
            'id' => 'comments_enable',
            'type' => 'select',
            'desc' => 'Select to include the comments section or not',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Comments Section Order',
            'id' => 'comments_order',
            'type' => 'select',
            'desc' => 'Select the Comments Order in your article, Default: Facebook - WP Comments',
            'choices' => array(
                array(
                    'label' => 'Facebook - WP Comments',
                    'value' => 'facebook_comments'
                ),
                array(
                    'label' => 'WP Comments - Facebook',
                    'value' => 'comments_facebook'
                )
            ),
            'std' => 'facebook_comments',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Enable Facebook Comments',
            'id' => 'facebook_comments',
            'type' => 'select',
            'desc' => 'Show Facebook Comments Section? Default Yes.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Facebook Color',
            'id' => 'facebook_color',
            'type' => 'select',
            'desc' => 'Select Facebook Color Mode. Default Light.',
            'choices' => array(
                array(
                    'label' => 'Light',
                    'value' => 'light'
                ),
                array(
                    'label' => 'Dark',
                    'value' => 'dark'
                )
            ),
            'std' => 'light',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        array(
            'label' => 'Default Thumbnail for Commenter',
            'id' => 'avatar',
            'type' => 'upload',
            'desc' => 'Upload Default Thumbnail for Commenters.',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
        //// Portfolio Settings
        array(
            'label' => 'Featured Media Enable For Portfolio',
            'id' => 'featured_enable_portfolio',
            'type' => 'select',
            'desc' => 'Featured Media inside Article Enable',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'yes',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'article'
        ),
       
        //// Categories
        array(
            'label' => 'Category Hover Image Type',
            'id' => 'hover_view',
            'type' => 'select',
            'desc' => 'Choose Your Hover Type for the category elements.',
            'choices' => array(
                array(
                    'label' => 'Enlarge Image',
                    'value' => 'view'
                ),
                array(
                    'label' => 'Permalink to Article',
                    'value' => 'link'
                ),
                array(
                    'label' => 'No Hover',
                    'value' => 'none'
                )
            ),
            'std' => 'view',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Deafult Category Page Top Slider',
            'id' => 'category_slider',
            'type' => 'select',
            'desc' => 'Choose Your Slider type for the category page.',
            'choices' => array(
                array(
                    'label' => 'Latest',
                    'value' => 'latest'
                ),
                array(
                    'label' => 'Popular',
                    'value' => 'latest'
                ),
                array(
                    'label' => 'Most Viewed',
                    'value' => 'views'
                ),
                array(
                    'label' => 'Most Liked',
                    'value' => 'likes'
                ),
                array(
                    'label' => 'Most rated',
                    'value' => 'rated'
                ),
                array(
                    'label' => 'No Slider',
                    'value' => 'none'
                )
            ),
            'std' => 'latest',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Default Pages Display Style',
            'id' => 'category_type',
            'type' => 'select',
            'desc' => 'Choose Your articles display type for default category or archive page.',
            'choices' => array(
                array(
                    'label' => 'Blog Style 1',
                    'value' => '1'
                ),
                array(
                    'label' => 'Blog Style 2',
                    'value' => '2'
                ),
                array(
                    'label' => 'Blog Style 3',
                    'value' => '3'
                ),
                array(
                    'label' => 'Blog Style 4',
                    'value' => '4'
                ),
                array(
                    'label' => 'Blog Style 5',
                    'value' => '5'
                ),
                array(
                    'label' => 'Columns Grid "Settings Below"',
                    'value' => 'columns'
                )
            ),
            'std' => '1',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Columns Grid Columns Count',
            'id' => 'columns_count',
            'type' => 'select',
            'desc' => 'Choose Columns Grid Columns Count.',
            'choices' => array(
                array(
                    'label' => '1',
                    'value' => '1'
                ),
                array(
                    'label' => '3',
                    'value' => '3'
                ),
                array(
                    'label' => '4',
                    'value' => '4'
                ),
                array(
                    'label' => '5',
                    'value' => '5'
                ),
                array(
                    'label' => '6',
                    'value' => '6'
                )
            ),
            'std' => '4',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Columns Grid Columns Type',
            'id' => 'columns_type',
            'type' => 'select',
            'desc' => 'Choose Your Columns Grid Columns Type.',
            'choices' => array(
                array(
                    'label' => 'Square',
                    'value' => 'square'
                ),
                array(
                    'label' => 'Square Flexible',
                    'value' => 'square-flexible'
                ),
                array(
                    'label' => 'Circle',
                    'value' => 'cirlce'
                ),
                array(
                    'label' => 'Octagon',
                    'value' => 'octagon'
                ),
                array(
                    'label' => 'Square (Metro)',
                    'value' => 'square-metro'
                )
            ),
            'std' => 'square',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Columns Grid Posts Per Page',
            'id' => 'columns_per_page',
            'type' => 'text',
            'desc' => 'add Columns Grid Posts Per Page.',
            'std' => '10',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Default Pagination Method',
            'id' => 'pagination_method',
            'type' => 'select',
            'desc' => 'Choose Pagination Method.',
            'choices' => array(
                array(
                    'label' => 'Numerical',
                    'value' => 'numerical'
                ),
                array(
                    'label' => 'Ajax',
                    'value' => 'ajax'
                )
            ),
            'std' => 'numerical',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        array(
            'label' => 'Add Special Settings for Categories Page',
            'id' => 'tax_category',
            'type' => 'list-item',
            'desc' => 'Add Categories Colors & Icons.',
            'settings' => array(
                array(
                    'label' => 'Category ID',
                    'id' => 'category',
                    'type' => 'text',
                    'desc' => 'Add the category ID',
                    'choices' => '',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                ),
                array(
                    'label' => 'Choose Post Type',
                    'id' => 'post_type',
                    'type' => 'select',
                    'desc' => 'Choose the post type that the category belongs to.',
                    'choices' => $post_types,
                    'std' => 'post',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Choose the Category Skin',
                    'id' => 'skin_default',
                    'type' => 'select',
                    'desc' => 'Choose The page Skin.',
                    'choices' => $skins2,
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
               
                array(
                    'label' => 'Icon',
                    'id' => 'icon',
                    'type' => 'text',
                    'desc' => 'Add Icon Class.',
                    'std' => 'tag',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                ),
                array(
                    'label' => 'Layout Style',
                    'id' => 'layout',
                    'type' => 'select',
                    'desc' => 'Choose Your Category Page Layout.',
                    'choices' => array(
                        array(
                            'label' => 'Left Sidebar',
                            'value' => 'left'
                        ),
                        array(
                            'label' => 'Right Sidebar',
                            'value' => 'right'
                        ),
                        array(
                            'label' => 'Full Width',
                            'value' => 'full'
                        )
                    ),
                    'std' => 'right',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                ),
                array(
                    'label' => 'Sidebar',
                    'id' => 'sidebar',
                    'type' => 'select',
                    'desc' => 'Select the Page sidebar.',
                    'choices' => $sidebars,
                    'std' => 'primary',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'RTL',
                    'id' => 'rtl',
                    'type' => 'select',
                    'desc' => 'Choose Yes to enable RTL in your website.',
                    'choices' => array(
                        array(
                            'label' => 'Default',
                            'value' => ''
                        ),
                        array(
                            'label' => 'Yes',
                            'value' => 'yes'
                        ),
                        array(
                            'label' => 'No',
                            'value' => 'no'
                        )
                    ),
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                ),
               array(
                    'label' => 'Category Page Top Slider',
                    'id' => 'category_slider',
                    'type' => 'select',
                    'desc' => 'Choose Your Slider type for the category page.',
                    'choices' => array(
                        array(
                            'label' => 'Latest',
                            'value' => 'latest'
                        ),
                        array(
                            'label' => 'Popular',
                            'value' => 'latest'
                        ),
                        array(
                            'label' => 'Most Viewed',
                            'value' => 'views'
                        ),
                        array(
                            'label' => 'Most Liked',
                            'value' => 'likes'
                        ),
                        array(
                            'label' => 'Most rated',
                            'value' => 'rated'
                        ),
                        array(
                            'label' => 'No Slider',
                            'value' => 'none'
                        )
                    ),
                    'std' => 'latest',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Articles Display Style',
                    'id' => 'category_type',
                    'type' => 'select',
                    'desc' => 'Choose Your articles display type for the category page.',
                    'choices' => array(
                        array(
                            'label' => 'Blog Style 1',
                            'value' => '1'
                        ),
                        array(
                            'label' => 'Blog Style 2',
                            'value' => '2'
                        ),
                        array(
                            'label' => 'Blog Style 3',
                            'value' => '3'
                        ),
                        array(
                            'label' => 'Blog Style 4',
                            'value' => '4'
                        ),
                        array(
                            'label' => 'Blog Style 5',
                            'value' => '5'
                        ),
                        array(
                            'label' => 'Columns Grid "Settings Below"',
                            'value' => 'columns'
                        )
                    ),
                    'std' => '1',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Columns Grid Columns Count',
                    'id' => 'columns_count',
                    'type' => 'select',
                    'desc' => 'Choose Columns Grid Columns Count.',
                    'choices' => array(
                        array(
                            'label' => '1',
                            'value' => '1'
                        ),
                        array(
                            'label' => '3',
                            'value' => '3'
                        ),
                        array(
                            'label' => '4',
                            'value' => '4'
                        ),
                        array(
                            'label' => '5',
                            'value' => '5'
                        ),
                        array(
                            'label' => '6',
                            'value' => '6'
                        )
                    ),
                    'std' => '4',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Columns Grid Columns Type',
                    'id' => 'columns_type',
                    'type' => 'select',
                    'desc' => 'Choose Your Columns Grid Columns Type.',
                    'choices' => array(
                        array(
                            'label' => 'Square',
                            'value' => 'square'
                        ),
                        array(
                            'label' => 'Square Flexible',
                            'value' => 'square-flexible'
                        ),
                        array(
                            'label' => 'Circle',
                            'value' => 'cirlce'
                        ),
                        array(
                            'label' => 'Octagon',
                            'value' => 'octagon'
                        ),
                        array(
                            'label' => 'Square (Metro)',
                            'value' => 'square-metro'
                        )
                    ),
                    'std' => 'square',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Columns Grid Posts Per Page',
                    'id' => 'columns_per_page',
                    'type' => 'text',
                    'desc' => 'add Columns Grid Posts Per Page.',
                    'std' => '10',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Pagination Method',
                    'id' => 'pagination_method',
                    'type' => 'select',
                    'desc' => 'Choose Pagination Method.',
                    'choices' => array(
                        array(
                            'label' => 'Numerical',
                            'value' => 'numerical'
                        ),
                        array(
                            'label' => 'Ajax',
                            'value' => 'ajax'
                        )
                    ),
                    'std' => 'numerical',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                )
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'categories'
        ),
        ////Sidebars
        array(
            'label' => 'Sidebars',
            'id' => 'sidebars',
            'type' => 'list-item',
            'desc' => 'Add Unlimited Sidebars to your website.',
            'settings' => array(
                array(
                    'label' => 'Slug',
                    'id' => 'slug',
                    'type' => 'text',
                    'desc' => 'Sidebar Slug "All lowercase and must be unique".',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Description',
                    'id' => 'description',
                    'type' => 'textarea-simple',
                    'desc' => 'Sidebar Description.',
                    'std' => '',
                    'rows' => '5',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                )
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'sidebars'
        ),
        ////Menus
        array(
            'label' => 'Menu Locations',
            'id' => 'menus',
            'type' => 'list-item',
            'desc' => 'Add Unlimited Menu Locations to your website.',
            'settings' => array(
                array(
                    'label' => 'Location',
                    'id' => 'location',
                    'type' => 'text',
                    'desc' => 'Menu Location You will get the menu by that name. "No spaces"',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                )
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'menus'
        ),
        array(
            'label' => 'Footer Templates',
            'id' => 'footer_templates',
            'type' => 'list-item',
            'desc' => 'Add /Edit Footer Templates.',
            'settings' => array(
                array(
                    'label' => 'Slug',
                    'id' => 'slug',
                    'type' => 'text',
                    'desc' => 'Add the footer slug, Important: Must be unique.',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Choose your footer.',
                    'id' => 'footer_template',
                    'type' => 'custom-post-type-select',
                    'desc' => 'Choose your footer from the templates you created.',
                    'std' => '',
                    'rows' => '',
                    'post_type' => 'template',
                    'taxonomy' => '',
                    'class' => '',
                    'section' => 'footer'
                ),
                array(
                    'label' => 'Content Bottom Bar',
                    'id' => 'bottom',
                    'type' => 'textarea',
                    'desc' => 'Add the content, you can use shortcodes and [float_left]content[/float_left] [float_right]content[/float_right].',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                )
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'footer'
        ),
        
        
        
        array(
            'label' => 'Custom Post Types',
            'id' => 'custom_icons',
            'type' => 'list-item',
            'desc' => 'Add New Custom Post Type.',
            'settings' => array(
               array(
                    'label' => 'Icon',
                    'id' => 'icon',
                    'type' => 'upload',
                    'desc' => 'Upload the icon you want to re-use',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                  'label'       => '16x16px',
                  'id'          => 'i16',
                  'type'        => 'checkbox',
                  'desc'        => '16x16px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '24x24px',
                  'id'          => 'i24',
                  'type'        => 'checkbox',
                  'desc'        => '24x24px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '32x32px',
                  'id'          => 'i32',
                  'type'        => 'checkbox',
                  'desc'        => '32x32px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '48x48px',
                  'id'          => 'i48',
                  'type'        => 'checkbox',
                  'desc'        => '48x48px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '64x64px',
                  'id'          => 'i64',
                  'type'        => 'checkbox',
                  'desc'        => '64x64px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '128x128px',
                  'id'          => 'i128',
                  'type'        => 'checkbox',
                  'desc'        => '128x128px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
                array(
                  'label'       => '256x256px',
                  'id'          => 'i256',
                  'type'        => 'checkbox',
                  'desc'        => '256x256px thumb',
                  'choices'     => array(
                    array (
                      'label'       => 'Yes',
                      'value'       => 'yes'
                    )
                  ),
                  'std'         => '',
                  'rows'        => '',
                  'post_type'   => '',
                  'taxonomy'    => '',
                  'class'       => ''
                ),
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'icons'
        ),
        
        array(
            'label' => 'Custom Post Types',
            'id' => 'custom_posts',
            'type' => 'list-item',
            'desc' => 'Add New Custom Post Type.',
            'settings' => array(
                array(
                    'label' => 'Slug',
                    'id' => 'slug',
                    'type' => 'text',
                    'desc' => 'Add Post type slug, this will be used in the url',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
                array(
                    'label' => 'Category Name',
                    'id' => 'category_name',
                    'type' => 'text',
                    'desc' => 'Add Category name"',
                    'std' => 'Category',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                )
                ,
                array(
                    'label' => 'Category slug',
                    'id' => 'category',
                    'type' => 'text',
                    'desc' => 'Add Category to this custom post, add its slug here "this will be used in the url of the category page"',
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => '',
                ),
                array(
                    'label' => 'Choose the Category Skin',
                    'id' => 'skin_default',
                    'type' => 'select',
                    'desc' => 'Choose The page Skin.',
                    'choices' => $skins2,
                    'std' => '',
                    'rows' => '',
                    'post_type' => '',
                    'taxonomy' => '',
                    'class' => ''
                ),
            ),
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'custom_post'
        ),
        array(
            'label' => 'Default Search Post Type',
            'id' => 'search_post',
            'type' => 'select',
            'desc' => 'Choose the post type you want to make the search based on.',
            'choices' => $post_types,
            'std' => 'post',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        ),
        array(
            'label' => 'Show Categories Dropdown',
            'id' => 'search_cat',
            'type' => 'select',
            'desc' => 'Show Categories Dropdown or not, Default No.',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        ),
        array(
            'label' => 'Default Search Display Style',
            'id' => 'search_category_type',
            'type' => 'select',
            'desc' => 'Choose Your articles display type for default category or archive or search page.',
            'choices' => array(
                array(
                    'label' => 'Blog Style 1',
                    'value' => '1'
                ),
                array(
                    'label' => 'Blog Style 2',
                    'value' => '2'
                ),
                array(
                    'label' => 'Blog Style 3',
                    'value' => '3'
                ),
                array(
                    'label' => 'Blog Style 4',
                    'value' => '4'
                ),
                array(
                    'label' => 'Blog Style 5',
                    'value' => '5'
                ),
                array(
                    'label' => 'Columns Grid "Settings Below"',
                    'value' => 'columns'
                )
            ),
            'std' => '1',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        ),
        array(
            'label' => 'Columns Grid Columns Count',
            'id' => 'search_columns_count',
            'type' => 'select',
            'desc' => 'Choose Columns Grid Columns Count.',
            'choices' => array(
                array(
                    'label' => '1',
                    'value' => '1'
                ),
                array(
                    'label' => '3',
                    'value' => '3'
                ),
                array(
                    'label' => '4',
                    'value' => '4'
                ),
                array(
                    'label' => '5',
                    'value' => '5'
                ),
                array(
                    'label' => '6',
                    'value' => '6'
                )
            ),
            'std' => '4',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        ),
        array(
            'label' => 'Columns Grid Columns Type',
            'id' => 'search_columns_type',
            'type' => 'select',
            'desc' => 'Choose Your Columns Grid Columns Type.',
            'choices' => array(
                array(
                    'label' => 'Square',
                    'value' => 'square'
                ),
                array(
                    'label' => 'Square Flexible',
                    'value' => 'square-flexible'
                ),
                array(
                    'label' => 'Circle',
                    'value' => 'cirlce'
                ),
                array(
                    'label' => 'Octagon',
                    'value' => 'octagon'
                ),
                array(
                    'label' => 'Square (Metro)',
                    'value' => 'square-metro'
                )
            ),
            'std' => 'square',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        ),
        array(
            'label' => 'Posts Per Page',
            'id' => 'search_columns_per_page',
            'type' => 'text',
            'desc' => 'Add the posts per page',
            'std' => '10',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
            'section' => 'search'
        )
    );

	


    $cat_settings = array(
        array(
            'label' => 'Slug',
            'id' => 'slug',
            'type' => 'text',
            'desc' => 'Enter the meta data slug "should be in english".',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
        array(
            'label' => 'Icon',
            'id' => 'icon',
            'type' => 'text',
            'desc' => 'Add Your icon class.',
            'std' => 'tag',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
        array(
            'label' => 'Title Show',
            'id' => 'title_show',
            'type' => 'select',
            'desc' => 'Select the way to show the title',
            'choices' => array(
                array(
                    'label' => 'Icon with text as tooltip',
                    'value' => 'icon_tooltip'
                ),
                array(
                    'label' => 'Just Icon',
                    'value' => 'icon'
                ),
                array(
                    'label' => 'Just Text',
                    'value' => 'text'
                ),
                array(
                    'label' => 'None',
                    'value' => 'none'
                )
            ),
            'std' => 'icon_tooltip',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
        array(
            'label' => 'Data type',
            'id' => 'type',
            'type' => 'select',
            'desc' => 'Choose Your Meta data type.',
            'choices' => array(
                array(
                    'label' => 'Title',
                    'value' => 'title'
                ),
                array(
                    'label' => 'Text',
                    'value' => 'text'
                )
            ),
            'std' => 'text',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        )
    );



    /**
     * Create a custom settings array that we pass to 
     * the OptionTree Settings API Class.
     */
    $custom_settings = array(
        'contextual_help' => array(
            'content' => array(
                array(
                    'id' => 'general_help',
                    'title' => 'General',
                    'content' => ''
                )
            ),
            'sidebar' => ''
        ),
        'sections' => array(
            array(
                'title' => 'General Settings',
                'id' => 'general_default'
            ),
            array(
                'title' => 'Layout Options',
                'id' => 'layout_option'
            ),
            array(
                'title' => 'Social Settings ',
                'id' => 'social'
            ),
            array(
                'title' => 'Custom Icons ',
                'id' => 'icons'
            ),
            array(
                'title' => 'Article Settings',
                'id' => 'article'
            ),
            array(
                'title' => 'Search Settings',
                'id' => 'search'
            ),
            array(
                'title' => 'Custom Post Settings',
                'id' => 'custom_post'
            ),
            array(
                'title' => 'Category',
                'id' => 'categories'
            ),
            array(
                'title' => 'Sidebars',
                'id' => 'sidebars'
            ),
            array(
                'title' => 'Menu Locations',
                'id' => 'menus'
            ),
            array(
                'title' => 'Footer Settings',
                'id' => 'footer'
            )
        ),
        'settings' => $all_settings
    );
    
    


    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option('option_tree_settings', $custom_settings);
    }
}