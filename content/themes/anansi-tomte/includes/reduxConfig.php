<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }


        public function initSettings()
        {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action('redux/loaded', array($this, 'remove_demo'));

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values)
        {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
       
        }

        /**
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections)
        {
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'pvc'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'pvc'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args)
        {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults)
        {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo()
        {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections()
        {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'pvc'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_html($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize"
                           title="<?php echo esc_html($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>"
                                 alt="<?php esc_attr_e('Current theme preview', 'pvc'); ?>"/>
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>"
                         alt="<?php esc_attr_e('Current theme preview', 'pvc'); ?>"/>
                <?php endif; ?>

                <h4><?php echo esc_html($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'pvc'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'pvc'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'pvc') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
                    <?php
                    if ($this->theme->parent()) {
                        printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'pvc') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'pvc'), $this->theme->parent()->display('Name'));
                    }
                    ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();



             global $woocommerce;
               $cat_arg=array();
               $cat_data='';
                if(class_exists('WooCommerce')) {
                   
                     $cat_data='terms';
                    $cat_arg=array('taxonomies'=>'product_cat', 'args'=>array());
                }

            // ACTUAL DECLARATION OF SECTIONS
            // Edgesettings: Home Page Settings Tab
            $this->sections[] = array(
                'title' => esc_html__('Home Settings', 'pvc'),
                'desc' => esc_html__('Home page settings ', 'pvc'),
                'icon' => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array( 

                    array(
                        'id' => 'theme_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Theme Variation', 'pvc'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'pvc'),
                        'options' => array(
                            'default' => array(
                                'title' => esc_html__('Default', 'pvc'),
                                'alt' => esc_html__('Default', 'pvc'),
                                'img' => get_template_directory_uri() . '/images/variations/screen1.jpg'
                            ),
                            'version2' => array(
                                'title' => esc_html__('Version2', 'pvc'),
                                'alt' => esc_html__('Version 2', 'pvc'),
                                'img' => get_template_directory_uri() . '/images/variations/screen2.jpg'
                            ),
                                                    
                           
                        ),
                        'default' => 'default'
                    ), 
                      array(
                        'id' => 'enable_welcome_msg',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Home Page welcome message', 'pvc'),
                        'subtitle' => esc_html__('You can enable/disable Home page welcome message', 'pvc')
                    ),  
                    array(
                        'id' => 'welcome_msg',
                        'type' => 'text',
                           'required' => array('enable_welcome_msg', '=', '1'),
                        'title' => esc_html__('Enter your welcome message here', 'pvc'),
                       'subtitle' => esc_html__('Enter your welcome message here.', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),               
                  
                         ),             
                    array(
                        'id' => 'enable_home_gallery',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Home Page Gallery', 'pvc'),
                        'subtitle' => esc_html__('You can enable/disable Home page Gallery', 'pvc')
                    ),

                    array(
                        'id' => 'home-page-slider',
                        'type' => 'slides',
                        'title' => esc_html__('Home Slider Uploads', 'pvc'),
                        'required' => array('enable_home_gallery', '=', '1'),
                        'subtitle' => esc_html__('Unlimited slide uploads with drag and drop sortings.', 'pvc'),
                        'placeholder' => array(
                            'title' => esc_html__('This is a title', 'pvc'),
                            'description' => esc_html__('Description Here', 'pvc'),
                            'url' => esc_html__('Give us a link!', 'pvc'),
                        ),

                    ),
                      

                   
                  array(
                        'id' => 'enable_home_hotdeal_products',
                        'type' => 'switch',                    
                        'title' => esc_html__('Show Hot Deal/Daily Deal Product', 'pvc'),
                        'subtitle' => esc_html__('You can show Hot Deal product on home page.', 'pvc')
                    ),

                        array(
                        'id' => 'home_daily_deal_title',
                        'type' => 'text',
                        'required' => array(array('theme_layout', '=', 'default'),array('enable_home_hotdeal_products', '=', '1')),
                        'title' => esc_html__('Home Daily Deal Title', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('Home Daily Deal Title', 'pvc')
                    
                    ),
                         array(
                        'id' => 'home_daily_deal_text',
                        'type' => 'text',
                        'required' => array(array('theme_layout', '=', 'default'),array('enable_home_hotdeal_products', '=', '1')),
                        'title' => esc_html__('Home Daily Deal Text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('home page daily deal text ', 'pvc')
                    
                    ),
                    array(
                            'id' => 'daily_deal_image',
                            'type' => 'media',
                            'required' => array(array('theme_layout', '=', 'default'),array('enable_home_hotdeal_products', '=', '1')),
                            'title' => esc_html__('Home Daily Deal Image', 'pvc'),
                            'desc' => esc_html__('', 'pvc'),
                            'subtitle' => esc_html__('Upload daily deal image appear to the left of best seller on  home page ', 'pvc')
                    ),
                                            
                      array(
                        'id' => 'daily_deal_url',
                        'type' => 'text',
                        'required' => array( array('theme_layout', '=', 'default'),array('enable_home_hotdeal_products', '=', '1')),
                        'title' => esc_html__('Home Daily Deal Url', 'pvc'),
                        'subtitle' => esc_html__('Home daily deal Url.', 'pvc'),
                    ),
                    


                     array(
                        'id' => 'enable_home_offer_banners',
                        'type' => 'switch',              
                        'title' => esc_html__('Enable Home Page Offer Banners', 'pvc'),
                        'subtitle' => esc_html__('You can enable/disable Home page offer Banners', 'pvc')
                    ),
                    array(
                        'id' => 'home-offer-banner1',
                        'type' => 'media',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner 1', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'subtitle' => esc_html__('Upload offer banner to appear on  home page', 'pvc'),                                    
                    ),   
                    array(
                        'id' => 'home-offer-banner1-url',
                        'type' => 'text',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner-1 URL', 'pvc'),
                        'subtitle' => esc_html__('URL for the offer banner.', 'pvc'),
                    ), 
                    array(
                        'id' => 'home-offer-banner2',
                        'type' => 'media',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner 2', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'subtitle' => esc_html__('Upload offer banner to appear on  home page', 'pvc')
                    ),
                    array(
                        'id' => 'home-offer-banner2-url',
                        'type' => 'text',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner-2 URL', 'pvc'),
                        'subtitle' => esc_html__('URL for the offer banner.', 'pvc'),
                    ),                     
                    array(
                        'id' => 'home-offer-banner3',
                        'type' => 'media',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner 3', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'subtitle' => esc_html__('Upload offer banner to appear on  home page', 'pvc')
                    ),
                    array(
                        'id' => 'home-offer-banner3-url',
                        'type' => 'text',
                        'required' => array('enable_home_offer_banners', '=', '1'),
                        'title' => esc_html__('Home offer Banner-3 URL', 'pvc'),
                        'subtitle' => esc_html__('URL for the offer banner.', 'pvc'),
                    ),
                         
                    
                        
                      array(
                        'id' => 'enable_home_new_products',
                        'type' => 'switch',
                        'title' => esc_html__('Show New Products', 'pvc'),
                        'subtitle' => esc_html__('You can show Show New Products on home page.', 'pvc')
                    ),   
                     array(
                            'id'=>'home_newproduct_categories',
                            'type' => 'select',
                            'multi'=> true,                        
                            'data' => $cat_data,                            
                            'args' => $cat_arg,
                            'title' => esc_html__('New Product Category', 'pvc'), 
                            'required' => array('enable_home_new_products', '=', '1'),
                            'subtitle' => esc_html__('Please choose New Product Category to show  its product in home page.', 'pvc'),
                            'desc' => '',
                        ),

                    array(
                        'id' => 'enable_home_bestseller_products',
                        'type' => 'switch',
                        'title' => esc_html__('Show Best Seller Products', 'pvc'),
                        'subtitle' => esc_html__('You can show best seller products on home page.', 'pvc')
                    ),

                    array(
                        'id' => 'home_bestseller_products-text',
                        'type' => 'text',
                        'required' => array('enable_home_bestseller_products', '=', '1'),
                        'title' => esc_html__('Home bestseller products text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('home page bestseller_products-text ', 'pvc')
                    
                    ),

                    array(
                            'id' => 'bestseller_image',
                            'type' => 'media',

                            'required' => array('enable_home_bestseller_products', '=', '1'),
                            'title' => esc_html__('Home Best Seller image', 'pvc'),
                            'desc' => esc_html__('', 'pvc'),
                            'subtitle' => esc_html__('Upload bestseller image appear to the left of best seller on  home page ', 'pvc')
                    ),
                    array(
                        'id' => 'bestseller_image-text',
                        'type' => 'text',
                        'required' => array('enable_home_bestseller_products', '=', '1'),
                        'title' => esc_html__('Home bestseller image text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('bestseller image text ', 'pvc')
                    
                    ),
                        
                      array(
                        'id' => 'bestseller_product_url',
                        'type' => 'text',
                        'required' =>array('enable_home_bestseller_products', '=', '1'),
                        'title' => esc_html__('Home Best seller   Url', 'pvc'),
                        'subtitle' => esc_html__('Home Best seller  Url.', 'pvc'),
                    ),
                      array(
                        'id' => 'bestseller_per_page',
                        'type' => 'text',
                        'required' => array('enable_home_bestseller_products', '=', '1'),
                        'title' => esc_html__('Number of Bestseller Products', 'pvc'),
                        'subtitle' => esc_html__('Number of Bestseller products on home page.', 'pvc')
                    ), 
                 
                           
                    array(
                        'id' => 'enable_home_featured_products',
                        'type' => 'switch',
                        'title' => esc_html__('Show Featured Products', 'pvc'),
                        'subtitle' => esc_html__('You can show featured products on home page.', 'pvc')
                    ),
                   
                     array(
                            'id' => 'featured_image',
                            'type' => 'media',
                            'required' => array(array('theme_layout', '=', 'version2'),array('enable_home_featured_products', '=', '1')),
                            'title' => esc_html__('Home Featured image', 'pvc'),
                            'desc' => esc_html__('', 'pvc'),
                            'subtitle' => esc_html__('Upload featured image appear to right of Featured product on  home page ', 'pvc')
                    ),
                     array(
                            'id' => 'featured_image-text',
                            'type' => 'text',
                            'required' => array(array('theme_layout', '=', 'version2'),array('enable_home_featured_products', '=', '1')),
                            'title' => esc_html__('Featured Image Text', 'pvc'),
                            'desc' => esc_html__('', 'pvc'),
                            'subtitle' => esc_html__('featured image text ', 'pvc')
                    ),
                     
                    array(
                        'id' => 'featured_product_url',
                        'type' => 'text',
                        'required' => array(array('theme_layout', '=', 'version2'),array('enable_home_featured_products', '=', '1')),
                        'title' => esc_html__('Home Featured  Url', 'pvc'),
                        'subtitle' => esc_html__('Home Featured  Url.', 'pvc'),
                    ),
   
                    array(
                        'id' => 'featured_per_page',
                        'type' => 'text',
                        'required' => array('enable_home_featured_products', '=', '1'),
                        'title' => esc_html__('Number of Featured Products', 'pvc'),
                        'subtitle' => esc_html__('Number of Featured products on home page.', 'pvc')
                    ),                             

                
                    array(
                        'id' => 'enable_home_related_products',
                        'type' => 'switch',
                        'title' => esc_html__('Show Related Products', 'pvc'),
                        'subtitle' => esc_html__('You can show Related products on home page.', 'pvc')
                    ),
                    array(
                        'id' => 'related_products-text',
                        'type' => 'text',
                        'required' => array('enable_home_related_products', '=', '1'),        
                        'title' => esc_html__('Related products text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('related products-text ', 'pvc')
                    
                    ),                
                    array(
                        'id' => 'related_per_page',
                        'type' => 'text',
                       'required' => array('enable_home_related_products', '=', '1'), 
                        'title' => esc_html__('Number of Related Products', 'pvc'),
                        'subtitle' => esc_html__('Number of Related products on home page.', 'pvc')
                    ),
                    

                    array(
                        'id' => 'enable_home_upsell_products',
                        'type' => 'switch',
                        'title' => esc_html__('Show Upsell Products', 'pvc'),
                        'subtitle' => esc_html__('You can show Upsell products on home page.', 'pvc')
                    ),
                    array(
                        'id' => 'upsell_products-text',
                        'type' => 'text',
                        'required' => array('enable_home_upsell_products', '=', '1'),
                        'title' => esc_html__('Upsell Products text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('upsell products text ', 'pvc')
                    
                    ),
                    array(
                        'id' => 'upsell_per_page',
                        'type' => 'text',
                        'required' => array('enable_home_upsell_products', '=', '1'), 
                        'title' => esc_html__('Number of Upsell Products', 'pvc'),
                        'subtitle' => esc_html__('Number of Upsell products on home page.', 'pvc')
                    ),
                    
                    
                 array(
                        'id' => 'enable_home_blog_posts',
                        'type' => 'switch',
                        'title' => esc_html__('Show Home Blog', 'pvc'),
                        'subtitle' => esc_html__('You can show latest blog post on home page.', 'pvc')
                    ),
                  array(
                        'id' => 'home_blog-text',
                        'type' => 'text',
                        'required' => array('enable_home_blog_posts', '=', '1'),
                        'title' => esc_html__('Home Blog text', 'pvc'),
                         'desc' => esc_html__('', 'pvc'),
                         'subtitle' => esc_html__('home page blog text ', 'pvc')
                    
                    ),

                      array(
                        'id'       => 'enable_testimonial',
                        'type'     => 'switch',                    
                        'title'    => esc_html__( 'Enable Testimonial ', 'pvc' ),
                        'subtitle' => esc_html__( 'You can enable/disable Testimonial Uploads', 'pvc' ),
                          'default' => '0'
                    ),                   
                    array(
                        'id' => 'all_testimonial',
                        'type' => 'slides',
                        'required' => array('enable_testimonial', '=', '1'),
                        'title' => esc_html__('Add Testimonial here', 'pvc'),
                        'subtitle' => esc_html__('Unlimited testimonial.', 'pvc'),
                        'placeholder' => array(
                            'title' => esc_html__('This is a title', 'pvc'),
                            'description' => esc_html__('Description Here', 'pvc'),
                            'url' => esc_html__('Give us a link!', 'pvc'),
                        ),
                        ),
                   array(
                        'id' => 'enable_home_bottom_slider',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Home Page Bottom Slider', 'pvc'),
                        'subtitle' => esc_html__('You can enable/disable Home page Bottom Slider', 'pvc')
                    ),

                    array(
                        'id' => 'home_page_bottom_slider',
                        'type' => 'slides',
                        'title' => esc_html__('Home page Bottom Slider Uploads', 'pvc'),
                        'required' => array('enable_home_bottom_slider', '=', '1'),
                        'subtitle' => esc_html__('Unlimited slide uploads with drag and drop sortings.', 'pvc'),
                        'placeholder' => array(
                            'title' => esc_html__('This is a title', 'pvc'),
                            'description' => esc_html__('Description Here', 'pvc'),
                            'url' => esc_html__('Give us a link!', 'pvc'),
                        ),

                    ),
                 


                ), // fields array ends
            );


            
            // Edgesettings: General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General Settings', 'pvc'),
                'fields' => array(
                                                                                               
                     array(
                     'id'       => 'category_item',
                     'type'     => 'spinner', 
                     'title'    => esc_html__('Product display in product category page', 'pvc'),
                     'subtitle' => esc_html__('Number of item display in product category page','pvc'),
                     'desc'     => esc_html__('Number of item display in product category page', 'pvc'),
                     'default'  => '9',
                     'min'      => '0',
                     'step'     => '1',
                     'max'      => '100',
                     ),
                           
                   
                      array(
                        'id'       => 'enable_product_socialshare',
                        'type'     => 'switch',                    
                        'title'    => esc_html__( 'Enable Product Page Social Share ', 'pvc' ),
                        'subtitle' => esc_html__( 'You can enable/disable Product Page Social Share', 'pvc' ),
                          'default' => '0'
                    ), 

                    

                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'pvc'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'pvc'),
                        'default' => true,
                    ),

                    
                    
                )
            );
            // Edgesettings: General Options -> Styling Options Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => esc_html__('Styling Options', 'pvc'),
               
                'fields' => array(
                        array(
                        'id' => 'opt-animation',
                        'type' => 'switch',
                        'title' => esc_html__('Use animation effect', 'pvc'),
                        'subtitle' => esc_html__('', 'pvc'),
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
					), 

                    array(
                        'id' => 'set_body_background_img_color',
                        'type' => 'switch',
                        'title' => esc_html__('Set Body Background', 'pvc'),
                        'subtitle' => esc_html__('', 'pvc'),
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                    ),
                    array(
                        'id' => 'opt-background',
                        'type' => 'background',
                        'required' => array('set_body_background_img_color', '=', '1'),
                        'output' => array('body'),
                        'title' => esc_html__('Body Background', 'pvc'),
                        'subtitle' => esc_html__('Body background with image, color, etc.', 'pvc'),               
                        'transparent' => false,
                    ),                   
                    array(
                        'id' => 'opt-color-footer',
                        'type' => 'color',
                        'title' => esc_html__('Footer Background Color', 'pvc'),
                        'subtitle' => esc_html__('Pick a background color for the footer.', 'pvc'),
                        'validate' => 'color',
                        'transparent' => false,
                        'mode' => 'background',
                        'output' => array('.footer')
                    ),
                    array(
                        'id' => 'opt-color-rgba',
                        'type' => 'color',
                        'title' => esc_html__('Header Nav Menu Background', 'pvc'),
                        'output' => array('nav','.mgk-main-menu'),
                        'mode' => 'background',
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-color-header',
                        'type' => 'color',
                        'title' => esc_html__('Header Background', 'pvc'),
                        'transparent' => false,
                        'output' => array('header','.header-container'),
                        'mode' => 'background',
                    ),  
                                      
                )
            );


            // Edgesettings: Header Tab
            $this->sections[] = array(
                'icon' => 'el-icon-file-alt',
                'title' => esc_html__('Header', 'pvc'),
                'heading' => esc_html__('All header related options are listed here.', 'pvc'),
                'desc' => esc_html__('', 'pvc'),
                'fields' => array(
                    array(
                        'id' => 'enable_header_currency',
                        'type' => 'switch',
                        'title' => esc_html__('Show Currency HTML', 'pvc'),
                        'subtitle' => esc_html__('You can show Currency in the header.', 'pvc')
                    ),
                    array(
                        'id' => 'enable_header_language',
                        'type' => 'switch',
                        'title' => esc_html__('Show Language HTML', 'pvc'),
                        'subtitle' => esc_html__('You can show Language in the header.', 'pvc')
                    ),
                    array(
                        'id' => 'header_use_imagelogo',
                        'type' => 'checkbox',
                        'title' => esc_html__('Use Image for Logo?', 'pvc'),
                        'subtitle' => esc_html__('If left unchecked, plain text will be used instead (generated from site name).', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'header_logo',
                        'type' => 'media',
                        'required' => array('header_use_imagelogo', '=', '1'),
                        'title' => esc_html__('Logo Upload', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'subtitle' => esc_html__('Upload your logo here and enter the height of it below', 'pvc'),
                    ),
                    array(
                        'id' => 'header_logo_height',
                        'type' => 'text',
                        'required' => array('header_use_imagelogo', '=', '1'),
                        'title' => esc_html__('Logo Height', 'pvc'),
                        'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 30', 'pvc'),
                        'desc' => '',
                        'validate' => 'numeric'
                    ),
                    array(
                        'id' => 'header_logo_width',
                        'type' => 'text',
                        'required' => array('header_use_imagelogo', '=', '1'),
                        'title' => esc_html__('Logo Width', 'pvc'),
                        'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 30', 'pvc'),
                        'desc' => '',
                        'validate' => 'numeric'
                    ),    
                                 
                    array(
                        'id' => 'header_remove_header_search',
                        'type' => 'checkbox',
                        'title' => esc_html__('Remove Header Search', 'pvc'),
                        'subtitle' => esc_html__('Active to remove the search functionality from your header', 'pvc'),
                        'desc' => esc_html__('', 'pvc'),
                        'default' => '0'
                    ),
                     array(
                        'id' => 'header_show_info_banner',
                        'type' => 'switch',
                        'title' => esc_html__('Show Info Banners', 'pvc'),
                          'default' => '0'
                    ),

                 
                    array(
                        'id' => 'header_shipping_banner',
                        'type' => 'text',
                        'required' => array('header_show_info_banner', '=', '1'),
                        'title' => esc_html__('Shipping Banner Text', 'pvc'),
                    ),

                    array(
                        'id' => 'header_customer_support_banner',
                        'type' => 'text',
                        'required' => array('header_show_info_banner', '=', '1'),
                        'title' => esc_html__('Customer Support Banner Text', 'pvc'),
                    ),

                    array(
                        'id' => 'header_moneyback_banner',
                        'type' => 'text',
                        'required' => array('header_show_info_banner', '=', '1'),
                        'title' => esc_html__('Warrant/Gaurantee Banner Text', 'pvc'),
                    ),
                      array(
                        'id' => 'header_returnservice_banner',
                        'type' => 'text',
                        'required' => array('header_show_info_banner', '=', '1'),
                        'title' => esc_html__('Return service Banner Text', 'pvc'),
                    ),
                   
                 
                   
                ) //fields end
            );

             // Edgesettings: Menu Tab
            $this->sections[] = array(
                'icon' => 'el el-website icon',
                'title' => esc_html__('Menu', 'pvc'),
                'heading' => esc_html__('All Menu related options are listed here.', 'pvc'),
                'desc' => esc_html__('', 'pvc'),
                'fields' => array(
                   array(
                        'id' => 'show_menu_arrow',
                        'type' => 'switch',
                        'title' => esc_html__('Show Menu Arrow', 'pvc'),
                        'desc'  => esc_html__('Show arrow in menu.', 'pvc'),
                        
                    ),               
                   array(
                    'id'       => 'login_button_pos',
                    'type'     => 'radio',
                    'title'    => esc_html__('Show Login/sign and logout link', 'pvc'),                   
                    'desc'     => esc_html__('Please Select any option from above.', 'pvc'),
                     //Must provide key => value pairs for radio options
                    'options'  => array(
                    'none' => 'None', 
                   'toplinks' => 'In Top Menu', 
                   'main_menu' => 'In Main Menu'
                    ),
                   'default' => 'none'
                    )
                  
                ) // fields ends here
            );
            // Edgesettings: Footer Tab
            $this->sections[] = array(
                'icon' => 'el-icon-file-alt',
                'title' => esc_html__('Footer', 'pvc'),
                'heading' => esc_html__('All footer related options are listed here.', 'pvc'),
                'desc' => esc_html__('', 'pvc'),
                'fields' => array(
                     array(
                        'id'       => 'enable_mailchimp_form',
                        'type'     => 'switch',                    
                        'title'    => esc_html__( 'Enable Mailchimp Form', 'pvc' ),
                        'subtitle' => esc_html__( 'You can enable/disable Mailchimp Form', 'pvc' ),
                          'default' => '0'
                    ), 
                    array(
                        'id' => 'footer_color_scheme',
                        'type' => 'switch',
                        'title' => esc_html__('Custom Footer Color Scheme', 'pvc'),
                        'subtitle' => esc_html__('', 'pvc')
                    ),               
                    array(
                        'id' => 'footer_copyright_background_color',
                        'type' => 'color',
                        'required' => array('footer_color_scheme', '=', '1'),
                        'transparent' => false,
                        'title' => esc_html__('Footer Copyright Background Color', 'pvc'),
                        'subtitle' => esc_html__('', 'pvc'),
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'footer_copyright_font_color',
                        'type' => 'color',
                        'required' => array('footer_color_scheme', '=', '1'),
                        'transparent' => false,
                        'title' => esc_html__('Footer Copyright Font Color', 'pvc'),
                        'subtitle' => esc_html__('', 'pvc'),
                        'validate' => 'color',
                    ), 
                    
                   
                     
                    array(
                        'id' => 'enable_footer_middle',
                        'type' => 'switch',                       
                        'title' => esc_html__('Enable footer middle', 'pvc'),
                        'subtitle' => esc_html__('You can enable/disable Footer Middle', 'pvc')
                    ),

                    array(
                        'id' => 'footer_middle',
                        'type' => 'editor',
                        'title' => esc_html__('Footer Middle Text ', 'pvc'), 
                        'required' => array('enable_footer_middle', '=', '1'),               
                       'subtitle' => esc_html__('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'pvc'),
                        'default' => '',
                    ),    
                                            
                    array(
                        'id' => 'bottom-footer-text',
                        'type' => 'editor',
                        'title' => esc_html__('Bottom Footer Text', 'pvc'),
                        'subtitle' => esc_html__('You can use the following shortcodes in your footer text: [wp-url] [site-url] [theme-url] [login-url] [logout-url] [site-title] [site-tagline] [current-year]', 'pvc'),
                        'default' => esc_html__('Powered by Magik', 'pvc'),
                    ),
                    
                    
                ) // fields ends here
            );

            //Edgesettings: Blog Tab
            $this->sections[] = array(
                'icon' => 'el-icon-pencil',
                'title' => esc_html__('Blog Page', 'pvc'),
                'fields' => array( 
                       array(
                        'id' => 'blog-page-layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Blog Page Layout', 'pvc'),
                        'subtitle' => esc_html__('Select main blog listing and category page layout from the available blog layouts.', 'pvc'),
                        'options' => array(
                            '1' => array(
                                'alt' => 'Left sidebar',
                                'img' => get_template_directory_uri() . '/images/magik_col/category-layout-1.png'

                            ),
                            '2' => array(
                                'alt' => 'Right Right',
                                'img' => get_template_directory_uri() . '/images/magik_col/category-layout-2.png'
                            ),
                            '3' => array(
                                'alt' => '2 Column Right',
                                'img' => get_template_directory_uri() . '/images/magik_col/category-layout-3.png'
                            )                                                                                 
                          
                        ),
                        'default' => '2'
                    ), 
                     array(
                        'id' => 'blog_show_authors_bio',
                        'type' => 'switch',
                        'title' => esc_html__('Author\'s Bio', 'pvc'),
                        'subtitle' => esc_html__('Show Author Bio on Blog page.', 'pvc'),
                         'default' => true,
                        'desc' => esc_html__('', 'pvc')
                    ),                  
                    array(
                        'id' => 'blog_show_post_by',
                        'type' => 'switch',
                        'title' => esc_html__('Display Post By', 'pvc'),
                         'default' => true,
                        'subtitle' => esc_html__('Display Psot by Author on Listing Page', 'pvc')
                    ),
                    array(
                        'id' => 'blog_display_tags',
                        'type' => 'switch',
                        'title' => esc_html__('Display Tags', 'pvc'),
                         'default' => true,
                        'subtitle' => esc_html__('Display tags at the bottom of posts.', 'pvc')
                    ),
                    array(
                        'id' => 'blog_full_date',
                        'type' => 'switch',
                        'title' => esc_html__('Display Full Date', 'pvc'),
                        'default' => true,
                        'subtitle' => esc_html__('This will add date of post meta on all blog pages.', 'pvc')
                    ),
                    array(
                        'id' => 'blog_display_comments_count',
                        'type' => 'switch',
                        'default' => true,
                        'title' => esc_html__('Display Comments Count', 'pvc'),
                        'subtitle' => esc_html__('Display Comments Count on Blog Listing.', 'pvc')
                    ),
                    array(
                        'id' => 'blog_display_category',
                        'type' => 'switch',
                        'title' => esc_html__('Display Category', 'pvc'),
                         'default' => true,
                        'subtitle' => esc_html__('Display Comments Category on Blog Listing.', 'pvc')
                    ),
                    array(
                        'id' => 'blog_display_view_counts',
                        'type' => 'switch',
                        'title' => esc_html__('Display View Counts', 'pvc'),
                         'default' => true,
                        'subtitle' => esc_html__('Display View Counts on Blog Listing.', 'pvc')
                    ),                  
                )
            );

            // Edgesettings: Social Media Tab
            $this->sections[] = array(
                'icon' => 'el-icon-file',
                'title' => esc_html__('Social Media', 'pvc'),
                'fields' => array(
                     array(
                        'id'       => 'enable_social_link_footer',
                        'type'     => 'switch',                    
                        'title'    => esc_html__( 'Enable Social Link In Footer', 'pvc' ),                        
                        'default' => '0'
                    ),
                    array(
                        'id' => 'social_facebook',
                        'type' => 'text',
                        'title' => esc_html__('Facebook URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Facebook URL.', 'pvc'),
                    ),
                    array(
                        'id' => 'social_twitter',
                        'type' => 'text',
                        'title' => esc_html__('Twitter URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Twitter URL.', 'pvc'),
                    ),
                    array(
                        'id' => 'social_googlep',
                        'type' => 'text',
                        'title' => esc_html__('Google+ URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Google Plus URL.', 'pvc'),
                    ),
                  
                    array(
                        'id' => 'social_pinterest',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Pinterest URL.', 'pvc'),
                    ),
                    array(
                        'id' => 'social_youtube',
                        'type' => 'text',
                        'title' => esc_html__('Youtube URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Youtube URL.', 'pvc'),
                    ),
                    array(
                        'id' => 'social_linkedin',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your LinkedIn URL.', 'pvc'),
                    ),
                     array(
                        'id' => 'social_instagram',
                        'type' => 'text',
                        'title' => esc_html__('Instagram URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your Instagram URL.', 'pvc'),
                    ),
                    array(
                        'id' => 'social_rss',
                        'type' => 'text',
                        'title' => esc_html__('RSS URL', 'pvc'),
                        'subtitle' => esc_html__('Please enter in your RSS URL.', 'pvc'),
                    )                   
                )
            );


            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'pvc') . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'pvc') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'pvc') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'pvc') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';


          
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'pvc'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'pvc'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );


        }

        public function setHelpTabs()
        {


        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'mgk_option',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Pvc Options', 'pvc'),
                'page_title' => esc_html__('Pvc Options', 'pvc'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'pvc_Options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );

            // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
            $this->args['admin_bar_links'][] = array(
                'id' => 'redux-docs',
                'href' => 'http://docs.reduxframework.com/',
                'title' => esc_html__('Documentation', 'pvc'),
            );

            $this->args['admin_bar_links'][] = array(
            
                'href' => 'https://github.com/ReduxFramework/redux-framework/issues',
                'title' => esc_html__('Support', 'pvc'),
            );

            $this->args['admin_bar_links'][] = array(
                'id' => 'redux-extensions',
                'href' => 'reduxframework.com/extensions',
                'title' => esc_html__('Extensions', 'pvc'),
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );

            $this->args['intro_text'] = '';

            // Add content after the form.
            $this->args['footer_text'] = '';
        }

        public function validate_callback_function($field, $value, $existing_value)
        {
            $error = true;
            $value = 'just testing';

        

            $return['value'] = $value;
            $field['msg'] = 'your custom error message';
            if ($error == true) {
                $return['error'] = $field;
            }

            return $return;
        }

        public function class_field_callback($field, $value)
        {
            print_r($field);
            echo '<br/>CLASS CALLBACK';
            print_r($value);
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
} else {
    echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error = true;
        $value = 'just testing';

   

        $return['value'] = $value;
        $field['msg'] = 'your custom error message';
        if ($error == true) {
            $return['error'] = $field;
        }

        return $return;
    }
endif;
