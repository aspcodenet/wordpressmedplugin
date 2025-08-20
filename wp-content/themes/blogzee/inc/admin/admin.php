<?php
/**
 * Admin page
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

namespace Blogzee_Admin;

if( ! class_exists( 'Admin_Page' ) ) :
    /**
     * Handles everything going on in the admin
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    class Admin_Page {
        
        /**
         * has demo data
         * 
         * @since 1.0.0
         */
        public $demos;

        public $ajax_response = [];

        /**
         * directory and file name of importer plugin relative to plugins directory in wp-content
         * 
         * @since 1.0.0
         */
        public $importer_plugin_file = 'blaze-demo-importer/blaze-demo-importer.php';

        /**
         * Zip file of importer plugin
         */
        public $importer_file = 'https://downloads.wordpress.org/plugin/blaze-demo-importer.zip';

        /**
         * Check if theme is premium version or not
         */
        public $is_premium;

        /**
         * Get id of current user
         */
        public $current_user_id;

        /**
         * Store the instance of class
         * 
         * @since 1.0.0
         */
        private static $_instance = null;

        /**
         * Ensures only one instance of the class is loaded or can be loaded
         * 
         * @access public
         * @static
         */
        public static function instance() {
            if( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Function that runs when the class is instantiated.
         */
        public function __construct() {
            add_action( 'init', function(){
                $this->demos = include get_template_directory() . '/inc/admin/assets/demos.php';
            });
            $this->is_premium = preg_match( '/-pro/', wp_get_theme()->get( 'TextDomain' ) );
            $this->current_user_id = get_current_user_id();
            add_action( 'admin_menu', [ $this, 'blogzee_info_page' ], 10 );
            add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
            add_action( 'wp_ajax_blogzee_importer_plugin_action', array( $this, 'blogzee_importer_plugin_action' ) );
            new Admin_Notices();
        }

        /**
         * Function to enqueue scripts in admin page
         */
        public function admin_scripts( $hook ) {
            if( 'widgets.php' === $hook ) return;
            if( $hook == 'toplevel_page_blogzee-info' ) {
                wp_enqueue_style( 'blogzee-info', get_template_directory_uri() . '/inc/admin/assets/admin-page.css', [], BLOGZEE_VERSION, 'all' );
                wp_enqueue_script( 'blogzee-info', get_template_directory_uri() . '/inc/admin/assets/admin-page.js', [], BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
            }
            wp_enqueue_script( 'blogzee-notice', get_template_directory_uri() . '/inc/admin/assets/admin-notice.js', [], BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
            wp_enqueue_style( 'blogzee-info-notice', get_template_directory_uri() . '/inc/admin/assets/admin-notice.css', [], BLOGZEE_VERSION, 'all' );
            wp_localize_script( 'blogzee-info', 'blogzeeThemeInfoObject', array(
                'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
                '_wpnonce'  => wp_create_nonce( 'blogzee-theme-info-nonce' )
            ));
            wp_localize_script( 'blogzee-notice', 'blogzeeNoticeOject', array(
                'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
                '_wpnonce'  => wp_create_nonce( 'blogzee-notice-nonce' ),
                'welcomeOption' =>  'blogzee_welcome_notice_dismiss'
            ));
        }
    
        /**
         * Function to Blogzee Info admin menu page
         * 
         * @since 1.0.0
         */
        public function blogzee_info_page() {
            add_menu_page( 
                esc_html__( 'Blogzee Info', 'blogzee' ),
                esc_html__( 'Blogzee Info', 'blogzee' ),
                'manage_options',
                'blogzee-info',
                [ $this, 'blogzee_info_callback' ],
                '',
                59
            );
        }

        /**
         * Callback function when registering Blogzee Info admin menu page
         * 
         * @since 1.0.0
         */
        public function blogzee_info_callback() {
            $starter_sites_class = 'starter-sites-section-wrap';
            if( array_key_exists( 'blogzee_importer_activated', $_POST ) ) :
                $nonce = $_POST['blogzee_importer_activated'];
                if ( wp_verify_nonce( $nonce, 'blogzee_form_action' ) ) $starter_sites_class .= ' active';
            endif;
            ?>
                <div class="blogzee-info-page" id="blogzee-info-page">
                    <div class="blogzee-info-page-inner box-container">
                        <div class="link-and-recommended-section">
                            <?php
                                $this->internal_links_section();
                                $this->external_links_section();
                                $this->recommended_section();
                            ?>
                        </div>
                        <div class="<?php echo esc_attr( $starter_sites_class ); ?>">
                            <?php
                                $this->starter_sites();
                                $this->importer_modal();
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        }

        /**
         * Internal links section html
         * Customizer links
         * 
         * @since 1.0.0
         */
        public function internal_links_section() {
            $theme_name = wp_get_theme()->get( 'Name' );
            $theme_version = wp_get_theme()->get( 'Version' );
            ?>
                <div class="internal-links-section admin--card">
                    <div class="card-header">
                        <h2 class="card-title"><?php echo esc_html( 'Thank you for using '. $theme_name . ' : ' . $theme_version ); ?></h2>
                        <div class="card-description"><?php echo esc_html__( 'Theme provides handy customizer that allows you to modify the site looks. You can click on the below links to navigate to the particular sections.', 'blogzee' ); ?></div>
                    </div>
                    <ul class="internal-links-section-list">
                        <li class="list-item">
                            <span class="dashicons dashicons-admin-customizer"></span>
                            <a href="<?php echo admin_url( 'customize.php' ); ?>" target="_blank"><?php echo esc_html__( 'Customize Site', 'blogzee' ); ?></a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-heading"></span>
                            <a href="<?php echo admin_url( 'customize.php?autofocus[section]=header_builder_section_settings' ); ?>" target="_blank">
                                <?php echo esc_html__( 'Edit Header', 'blogzee' ); ?>
                            </a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-edit"></span>
                            <a href="<?php echo admin_url( 'customize.php?autofocus[control]=single_section_heading' ); ?>" target="_blank">
                                <?php echo esc_html__( 'Edit Single Post', 'blogzee' ); ?>
                            </a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-edit"></span>
                            <a href="<?php echo admin_url( 'customize.php?autofocus[control]=page_settings_sidebar_layout' ); ?>" target="_blank">
                                <?php echo esc_html__( 'Edit Single Page', 'blogzee' ); ?>
                            </a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-editor-ul"></span>
                            <a href="<?php echo admin_url( 'customize.php?autofocus[control]=archive_layouts_settings_header' ); ?>" target="_blank">
                                <?php echo esc_html__( 'Edit Archive', 'blogzee' ); ?>
                            </a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-hammer"></span>
                            <a href="<?php echo admin_url( 'customize.php?autofocus[section]=footer_builder_section_settings' ); ?>" target="_blank">
                                <?php echo esc_html__( 'Edit Footer', 'blogzee' ); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php
        }

        /**
         * External links section html
         * Author site, documentation, demo page, etc.
         * 
         * @since 1.0.0
         */
        public function external_links_section() {
            ?>
                <div class="external-links-section admin--card">
                    <div class="card-header">
                        <h2 class="card-title"><?php echo esc_html__( 'Several outside resources to help you fully understand the theme.', 'blogzee' ); ?></h2>
                        <div class="card-description"><?php echo esc_html__( 'We offer blogs, demos, documentation, and support forums for quick assistance. We hope this makes it easier for you.', 'blogzee' ); ?></div>
                    </div>
                    <ul class="external-links-section-list">
                        <li class="list-item">
                            <span class="dashicons dashicons-star-filled"></span>
                            <a href="<?php echo esc_url( '//wordpress.org/support/theme/blogzee/reviews/?filter=5' ); ?>" target="_blank"><?php echo esc_html__( 'Leave a review', 'blogzee' ); ?></a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-media-document"></span>
                            <a href="<?php echo esc_url( '//doc.blazethemes.com/blogzee/' ); ?>" target="_blank"><?php echo esc_html__( 'Documentation', 'blogzee' ); ?></a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-visibility"></span>
                            <a href="<?php echo esc_url( '//preview.blazethemes.com/blogzee-one/' ); ?>" target="_blank"><?php echo esc_html__( 'View demo', 'blogzee' ); ?></a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-admin-site"></span>
                            <a href="<?php echo esc_url( '//www.blazethemes.com' ); ?>" target="_blank"><?php echo esc_html__( 'Official site', 'blogzee' ); ?></a>
                        </li>
                        <li class="list-item">
                            <span class="dashicons dashicons-welcome-write-blog"></span>
                            <a href="<?php echo esc_url( '//blazethemes.com/blog/ ' ); ?>" target="_blank"><?php echo esc_html__( 'Blog', 'blogzee' ); ?></a>
                        </li>
                    </ul>
                </div>
            <?php
        }

        public function recommended_section() {
            ?>
                <div class="recommended-section admin--card">
                    <div class="card-header">
                        <h2 class="card-title"><?php echo esc_html__( 'Recommended Plugins', 'blogzee' ); ?></h2>
                        <div class="card-description"><?php echo esc_html__( 'We recommend different useful plugins that can boost functionality, security, and user experience on your site.', 'blogzee' ); ?></div>
                    </div>
                    <ul class="recommended-section-list">
                        <?php
                            /**
                             * Function - get_plugins_details
                             * get plugin details like name, version, logo, etc.
                             */
                            $plugin_information = $this->get_plugins_details();
                            if( ! empty( $plugin_information ) && is_array( $plugin_information ) ) :
                                foreach( $plugin_information as $key => $plugin ) :
                                    ?>
                                        <li class="list-item">
                                            <figure class="item-thumb">
                                                <img src="<?php echo esc_url( $plugin['icons']['1x'] ); ?>" alt="Plugin image" loading="lazy">
                                            </figure>
                                            <div class="item-content">
                                                <h2 class="item-title"><?php echo esc_html( $plugin['name'] ); ?></h2>
                                                <span class="item-version">
                                                    <?php
                                                        echo esc_html__( 'Version: ', 'blogzee' );
                                                        echo '<strong>' . esc_html( $plugin['version'] ) . '</strong>';
                                                    ?>
                                                </span>
                                                <?php
                                                    /**
                                                     * Check if plugin is active, installed or inactive
                                                     */
                                                    $status = $this->check_plugin_status( $plugin['directory'] . '/'. $plugin['file'] );

                                                    /**
                                                     * Render plugin status button
                                                     */
                                                    $button_args = [
                                                        'link' =>  $plugin['download_link'],
                                                        'directory' =>  $plugin['directory'],
                                                        'file' =>  $plugin['file']
                                                    ];
                                                    $this->plugin_status_button( $status, false, $button_args );
                                                ?>
                                                <div class="external-links">
                                                    <a class="view-on-org external-link" href="<?php echo esc_url( '//wordpress.org/plugins/' . $plugin['slug'] ); ?>" target="_blank"><?php echo esc_html__( 'View on Wordpress.org', 'blogzee' ); ?></a>
                                                    <?php
                                                        if( array_key_exists( 'dependency', $plugin ) ) echo '<span class="depedency-message">'. esc_html( 'This plugin is an addons of ' . $plugin_information[ $plugin['dependency'] ]['name'] ) .'</span>';
                                                        if( $plugin['homepage'] ) echo '<a class="official-site external-link" href="'. esc_url( $plugin['homepage'] ) .'" target="_blank">'. esc_html__( 'Official site', 'blogzee' ) .'</a>';
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </ul>
                </div>
            <?php
        }

        /**
         * All starter sites ( Demo )
         * 
         * @since 1.0.0
         */
        public function starter_sites() {
            ?>
                <div class="starter-sites-section off-canvas">
                    <div class="canvas-header">
                        <h2 class="canvas-title"><?php echo esc_html__( 'All starter sites', 'blogzee' ); ?></h2>
                        <div class="canvas-description"><?php echo esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'blogzee' ); ?></div>
                    </div>
                    <div class="canvas-header is-open">
                        <?php $this->get_filter_tabs(); ?>
                        <div class="canvas-search">
                            <input type="search" name="demo_search" id="demo_search" placeholder="Search . . .">
                            <span class="dashicons dashicons-search"></span>
                        </div>
                    </div>
                    <div class="demo-listing canvas-body">
                        <?php
                            if( ! empty( $this->demos ) && is_array( $this->demos ) ) :
                                echo '<div class="demo-items-wrap">';
                                    $type = '';
                                    foreach( $this->demos as $demo_slug => $demo ) :
                                        if( ! $this->is_premium ) $type = ( ! empty( $demo['type'] ) ) ? $demo['type'] : '';
                                        $category = ( ! empty( $demo['tags'] ) && is_array( $demo['tags'] ) ) ? array_keys( $demo['tags'] ) : [];
                                        ?>
                                            <div class="demo-item <?php echo esc_attr( $type . ' ' . implode( ' ', $category ) ); ?>">
                                                <figure class="demo-thumb">
                                                    <a href="<?php echo esc_url( $demo['preview_url'] ); ?>" target="_blank">
                                                        <img src="<?php echo esc_url( $demo['image'] ); ?>" alt="<?php echo esc_attr( $demo['name'] ); ?>" loading="lazy">
                                                    </a>
                                                </figure>
                                                <div class="demo-label-wrap">
                                                    <h2 class="demo-label"><?php echo esc_html( $demo['name'] ); ?></h2>
                                                    <?php $this->get_demo_button( $demo_slug, $demo['preview_url'], $demo['type'], $demo[ 'buy_url' ] ); ?>
                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                echo '</div>';
                            endif;
                        ?>
                    </div>
                    <?php
                        $status = $this->check_plugin_status( $this->importer_plugin_file );
                        $elementClass = 'canvas-footer';
                        $elementClass .= ' importer--' . $status;
                        
                    ?>
                    <div class="<?php echo esc_attr( $elementClass ); ?>">
                        <div class="footer-inner">
                            <span class="status-message">
                                <?php
                                    if( in_array( $status, [ 'not-installed', 'inactive' ] ) ) :

                                        $prefix = ( $status == 'not-installed' ) ? esc_html__( ' to install and activate one click demo importer plugin', 'blogzee' ) : esc_html__( ' to activate one click demo importer plugin', 'blogzee' ) ;
                                        echo esc_html__( 'Click', 'blogzee' );
                                        $importer_args = [
                                            'link' =>  $this->importer_file,
                                            'directory' =>  'blaze-demo-importer',
                                            'file' =>  'blaze-demo-importer.php'
                                        ];
                                        $this->plugin_status_button( $status, true, $importer_args );
                                        echo esc_html( $prefix );
                                    else:
                                        echo esc_html__( 'You are all set to install the demo.', 'blogzee' );
                                    endif;
                                ?>
                            </span>
                            <form action="<?php echo esc_html( $_SERVER['REQUEST_URI'] ); ?>" method="post" id="blogzee-form">
                                <?php
                                    $nonce = wp_create_nonce( 'blogzee_form_action' );
                                    wp_nonce_field( 'blogzee_form_action', 'blogzee_importer_activated' ); 
                                    
                                ?>
                            </form>
                        </div>
                    </div>
                    <div class="canvas-expand">
                        <span class="button-icon dashicons dashicons-arrow-left-alt2"></span>
                        <span class="button-label"><?php echo esc_html__( 'View all', 'blogzee' ); ?></span>
                    </div>
                </div>
            <?php
        }

        /**
         * Render demo buttons
         * 
         * @since 1.0.0
         */
        public function get_demo_button( $slug, $preview_url = '', $type = 'pro', $buy_url = '' ) {
            $status = $this->check_plugin_status( $this->importer_plugin_file );
            if( ! in_array( $status, [ 'not-installed', 'inactive' ] ) ) :
                ?>
                    <div class="demo-buttons">
                        <a href="<?php echo esc_url( $preview_url ); ?>" target="_blank" class="demo-preview demo-button"><?php echo esc_html__( 'Preview', 'blogzee' ); ?></a>
                        <?php
                            if( $this->is_premium || $type == 'free' ): 
                                ?>
                                    <a href="#blaze-demo-importer-modal-<?php echo esc_attr( $slug ) ?>" class="blaze-demo-importer-modal-button">
                                        <?php echo esc_html__( 'Install', 'blogzee' ); ?>
                                    </a>
                                <?php
                            else: 
                                ?>
                                    <a href="<?php echo esc_url( $buy_url ); ?>" class="purchase-pro" target="_blank">
                                        <?php echo esc_html__( 'Buy Pro', 'blogzee' ); ?>
                                    </a>
                                <?php
                            endif;
                        ?>
                    </div>
                <?php
            endif;
        }

        /**
         * Function to list filter tabs
         * 
         * @since 1.0.0
         */
        public function get_filter_tabs(){
            $list_items = [
                'all'  =>  esc_html__( 'All', 'blogzee' )
            ];
            if( ! empty( $this->demos ) && is_array( $this->demos ) ) :
                // for type
                if( ! $this->is_premium ) :
                    foreach( $this->demos as $demo ) :
                        $list_items = array_merge( $list_items, [ $demo['type'] => $this->get_demo_label( $demo['type'] ) ] );
                    endforeach;
                endif;
                // for category
                foreach( $this->demos as $demo ) :
                    $list_items = array_merge( $list_items, $demo['tags'] );
                endforeach;
            endif;
            if( ! empty( $list_items ) && is_array( $list_items ) ) :
                echo '<ul class="filter-tabs">';
                    $count = 0;
                    foreach( $list_items as $item_key => $item_value ) :
                        $tabClass = ( $count == 0 ) ? 'tab active' : 'tab';
                        echo '<li class="' . esc_attr( $tabClass . ' ' . $item_key ) . '">' . esc_html( $item_value ) . '</li>';
                        $count++;
                    endforeach;
                echo '</ul>';
            endif;
        }

        /**
         * Get demo type label
         * 
         * @since 1.0.0
         */
        public function get_demo_label( $type ) {
            if( ! $type ) return;
            switch( $type ) :
                case 'free':
                    return esc_html__( 'Free', 'blogzee' );
                    break;
                case 'pro':
                    return esc_html__( 'Pro', 'blogzee' );
                    break;
                default:
                    return esc_html__( 'Default', 'blogzee' );
                    break;
            endswitch;
        }

        /**
         * Function to get plugins details using REST API
         * 
         * @since 1.0.0
         */
        public function get_plugins_details() {
            $plugins_to_add_args = [
                [
                    'author'    =>  'elemntor',
                    'slug'  =>  [ 'elementor' ],
                    'directory' =>  [
                        'elementor'    =>  'elementor'
                    ],
                    'file'  =>  [
                        'elementor' =>  'elementor.php'
                    ]
                ],
                [
                    'author'    =>  'blazethemes',
                    'slug'  =>  [ 'news-kit-elementor-addons' ],
                    'directory' =>  [ 
                        'news-kit-elementor-addons'  =>  'news-kit-elementor-addons'
                    ],
                    'file'  =>  [ 
                        'news-kit-elementor-addons'  =>  'news-kit-elementor-addons.php',
                    ],
                    'dependency'    =>  [
                        'news-kit-elementor-addons' =>  'elementor'
                    ]
                ]
            ];
            $plugin_information = [];
            if( ! empty( array_column( $plugins_to_add_args, 'author' ) ) && count( array_column( $plugins_to_add_args, 'author' ) ) > 0 ) :
                if( ! empty( $plugins_to_add_args ) && is_array( $plugins_to_add_args ) ) :
                    foreach( $plugins_to_add_args as $plugin ) :
                        $base_url = 'https://api.wordpress.org/plugins/info/1.2/?action=query_plugins&request[author]='. $plugin['author'];
                        $response = wp_remote_get( $base_url );
                        if ( is_array( $response ) && ! is_wp_error( $response ) ) :
                            $headers = $response['headers']; // array of http header lines
                            $body = json_decode( $response['body'], true ); // use the content
                            if( ! empty( $body['plugins'] ) && is_array( $body['plugins'] ) ) :
                                foreach( $body['plugins'] as $body_key => $body_value ) :
                                    if( in_array( $body_value['slug'], $plugin['slug'] ) ) :
                                        $body_value['directory'] = $plugin['directory'][ $body_value['slug'] ];
                                        $body_value['file'] = $plugin['file'][ $body_value['slug'] ];
                                        if( array_key_exists( 'dependency', $plugin ) ) $body_value['dependency'] = $plugin['dependency'][ $body_value['slug'] ];
                                        $plugin_information[ $body_value['slug'] ] = $body_value;
                                    endif;
                                endforeach;
                            endif;
                        endif;
                    endforeach;
                endif;
            endif;
            return $plugin_information;
        }

        /**
         * check plugin installation and activation
         * 
         * @since 1.0.0
         */
        public function check_plugin_status( $plugin_file ) {
            /**
             * Gives path to plugins folder
             */
            $status = 'not-installed';
            $path_to_plugin = WP_PLUGIN_DIR . '/' . esc_attr( $plugin_file );
            if( file_exists( $path_to_plugin ) ) $status = ( is_plugin_active( $plugin_file ) ) ? 'active' : 'inactive';
            return $status;
        }

        /**
         * Render plugin status button
         * 
         * @since 1.0.0
         */
        public function plugin_status_button( $status, $importer = false, $args = [] ) {
            if( ! $status ) return;
            $label = $property = $button_property = $file = '';
            $class = 'nexus-status';
            switch( $status ) :
                case 'not-installed' :
                    $label = $importer ? esc_html__( 'Here', 'blogzee' ) : esc_html__( 'Install and Activate', 'blogzee' );
                    $class .= ' action-trigger not-installed';
                    break;
                case 'active' :
                    $class .= ' active';
                    $property = ' disabled';
                    $label = esc_html__( 'Installed & Activated', 'blogzee' );
                    if( $importer ) :
                        $property = '';
                        $class .= ' importer';
                        $label = esc_html__( 'Import', 'blogzee' );
                    endif;
                    break;
                case 'inactive' :
                    $label = $importer ? esc_html__( 'activate', 'blogzee' ) : esc_html__( 'Activate', 'blogzee' );
                    $class .= ' inactive';
                    if( ! $importer ) $class .= ' action-trigger';
                    break;
            endswitch;
            if( ! empty( $args ) && is_array( $args ) ) :
                $file = $args['directory'] . '/' . $args['file'];
                $button_property = "data-link=". esc_url( $args['link'] ) ." data-file=". esc_attr( $file ) ."";
            endif;
            echo '<button class="'. esc_attr( $class ) .'"'. esc_attr( $button_property . $property ) .'>'. esc_html( $label ) .'</button>';
        }

        /**
         * Activate or install plugins ajax call
         *
         * @since 1.0.0
         */
        public function blogzee_importer_plugin_action() {
            $this->plugin_active_install_action( 'blogzee-theme-info-nonce' );
        }

        /**
         * Activate or install plugins
         *
         * @since 1.0.0
         */
        public function plugin_active_install_action( $nonce = '' ) {
            check_ajax_referer( $nonce, '_wpnonce' );
            $_plugin_action = isset( $_POST['plugin_action'] ) ? sanitize_text_field( $_POST['plugin_action'] ) : '';
            $importer_or_not = isset( $_POST['importer_or_not'] ) ? $_POST['importer_or_not'] : '';
            $link = isset( $_POST['link'] ) ? esc_url( $_POST['link'] ) : '';
            $file_path = isset( $_POST['file'] ) ? sanitize_text_field( $_POST['file'] ) : '';
            if( $_plugin_action === 'inactive' ) {
                if( $file_path ) {
                    activate_plugin( $file_path, '', false, true );
                }
                $this->ajax_response['status'] = true;
                $this->ajax_response['message'] = ( $importer_or_not == 'true' ) ? esc_html__( 'Plugin activated', 'blogzee' ) : esc_html__( 'Demo importer plugin activated', 'blogzee' );
                $this->send_ajax_response();
            } else if( $_plugin_action === 'not-installed' ) {
                $download_link = esc_url( $link );
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
                $skin = new \WP_Ajax_Upgrader_Skin();
                $upgrader = new \Plugin_Upgrader( $skin );
                $upgrader->install( $download_link );
                activate_plugin( $file_path, '', false, true );
                $this->ajax_response['status'] = true;
                $this->ajax_response['message'] = ( $importer_or_not == 'true' ) ? esc_html__( 'Plugin activated', 'blogzee' ) : esc_html__( 'Demo importer plugin activated', 'blogzee' );
                $this->send_ajax_response();
            }
            $this->ajax_response['status'] = false;
            $this->ajax_response['message'] = esc_html__( 'Error while trying to install or active the plugin.', 'blogzee' );
            $this->send_ajax_response();
        }

        /**
         * send ajax response to ajax call in js file
         * 
         * @since 1.0.0
         */
        public function send_ajax_response() {
            $json = wp_json_encode( $this->ajax_response );
            echo $json;
            die();
        }

        /**
         * Importer model
         * 
         * @since 1.0.0
         */
        public function importer_modal() {
            ?>
                <div class="wrap blaze-demo-importer-demo-importer-wrap">
                    <?php
                        /* Demo Modals */
                        if ( is_array( $this->demos ) && ! is_null( $this->demos ) ) :
                            foreach ( $this->demos as $demo_slug => $demo_pack ) :
                                ?>
                                    <div id="blaze-demo-importer-modal-<?php echo esc_attr( $demo_slug ) ?>" class="blaze-demo-importer-modal" style="display: none;">

                                        <div class="blaze-demo-importer-modal-header">
                                            <h2><?php printf( esc_html( 'Import %s Demo', 'blogzee' ), esc_html( $demo_pack['name'] ) ); ?></h2>
                                            <div class="blaze-demo-importer-modal-back"><span class="dashicons dashicons-no-alt"></span></div>
                                        </div>

                                        <div class="blaze-demo-importer-modal-wrap">
                                            <p><?php echo sprintf( esc_html__('We recommend you backup your website content before attempting to import the demo so that you can recover your website if something goes wrong. You can use %s plugin for it.', 'blogzee' ), '<a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">' . esc_html__( 'All in one migration', 'blogzee' ) . '</a>' ); ?></p>

                                            <p><?php echo esc_html__( 'This process will install all the required plugins, import contents and setup customizer and theme options.', 'blogzee' ); ?></p>

                                            <div class="blaze-demo-importer-modal-recommended-plugins">
                                                <h4><?php esc_html_e( 'Required Plugins', 'blogzee' ); ?></h4>
                                                <p><?php esc_html_e( 'For your website to look exactly like the demo,the import process will install and activate the following plugin if they are not installed or activated.', 'blogzee' ); ?></p>
                                                <?php
                                                $plugins = isset( $demo_pack['plugins'] ) ? $demo_pack['plugins'] : '';

                                                if ( is_array( $plugins ) ) :
                                                    ?>
                                                        <ul class="blaze-demo-importer-plugin-status">
                                                            <?php
                                                                foreach ( $plugins as $plugin_slug => $plugin ) :
                                                                    $name = isset( $plugin['name'] ) ? $plugin['name'] : '';
                                                                    $required = isset( $plugin['required'] ) ? $plugin['required'] : '';
                                                                    $status = $this->check_plugin_status( $plugin['file_path'] );
                                                                    if ( $status == 'active' ) :
                                                                        $plugin_class = '<span class="dashicons dashicons-yes-alt"></span>';
                                                                    elseif ( $status == 'inactive' ) :
                                                                        $plugin_class = '<span class="dashicons dashicons-warning"></span>';
                                                                    else :
                                                                        $plugin_class = '<span class="dashicons dashicons-dismiss"></span>';
                                                                    endif;
                                                                    ?>
                                                                        <li class="blaze-demo-importer-<?php echo esc_attr( $status ); ?>" data-pluginSlug="<?php echo esc_attr( $plugin_slug ); ?>">
                                                                            <input type="checkbox" name="<?php echo esc_attr( $name ); ?>" checked <?php if( $required ) echo 'disabled'; ?>>
                                                                            <?php echo $plugin_class . ' ' . esc_html( $name ) . ' - <i>' . esc_html( $status ) . '</i>'; ?>
                                                                        </li>
                                                                    <?php
                                                                endforeach;
                                                            ?>
                                                        </ul>
                                                    <?php
                                                else :
                                                    ?>
                                                        <ul>
                                                            <li><?php esc_html_e( 'No Required Plugins Found.', 'blogzee' ); ?></li>
                                                        </ul>
                                                    <?php
                                                endif;
                                                ?>
                                            </div>

                                            <ul class="blaze-demo-importer-reset-checkbox">
                                                <h4><?php esc_html_e( 'Files', 'blogzee' ) ?></h4>
                                                <li>
                                                    <label class="blaze-demo-importer-files-checkbox">
                                                        <input id="checkbox-customizer-<?php echo esc_attr( $demo_slug ); ?>" type="checkbox" checked="checked" />
                                                        <?php echo esc_html( 'Customizer.dat', 'blogzee' ); ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="blaze-demo-importer-files-checkbox">
                                                        <input id="checkbox-widget-<?php echo esc_attr( $demo_slug ); ?>" type="checkbox" checked="checked" />
                                                        <?php echo esc_html( 'Widget.wie', 'blogzee' ); ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="blaze-demo-importer-files-checkbox">
                                                        <input id="checkbox-content-<?php echo esc_attr( $demo_slug ); ?>" type="checkbox" checked="checked" />
                                                        <?php echo esc_html( 'Content.xml.', 'blogzee' ); ?>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="blaze-demo-importer-files-checkbox">
                                                        <input id="checkbox-attachment-<?php echo esc_attr( $demo_slug ); ?>" type="checkbox" />
                                                        <?php echo esc_html( 'Attachments like images, audios, videos, etc.', 'blogzee' ); ?>
                                                    </label>
                                                </li>
                                            </ul>
                                            <a href="javascript:void(0)" class="button blaze-demo-importer-modal-cancel"><?php esc_html_e ( 'Cancel', 'blogzee' ); ?></a>
                                            <a href="javascript:void(0)" data-demo-slug="<?php echo esc_attr( $demo_slug ) ?>" class="button button-primary blaze-demo-importer-import-demo"><?php esc_html_e( 'Import Demo', 'blogzee' ); ?></a>
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                        endif;
                    ?>
                    <div id="blaze-demo-importer-import-progress" style="display: none">
                        <h2 class="blaze-demo-importer-import-progress-header"><?php echo esc_html__( 'Demo Import Progress', 'blogzee' ); ?></h2>

                        <div class="blaze-demo-importer-import-progress-wrap">
                        <div class="blaze-demo-importer-import-progress-message"><div class="message-item"></div></div>
                            <span class="progress-bar-health">0<span>%</span></span>
                            <div class="blaze-demo-importer-import-loader">
                                <div class="loaderBar"></div>
                            </div>
                            <div class="blaze-demo-importer-import-progress-bar">
                                <div class="loaderBar"></div>
                            </div>
                            <span class="progress-bar-note"><?php esc_html_e( 'Demo import success', 'blogzee' ); ?></span>
                        </div>
                        </div>
                </div>
            <?php
        }
    }
endif;


// namespace Blogzee_Admin;

if( ! class_exists( 'Admin_Notices' ) ) :
    /**
     * Handles everything going on in the admin
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    class Admin_Notices extends Admin_Page {
        /**
         * has permission to preview notice
         * This is customizer option
         * 
         * @since 1.0.0
         */
        public $notices_permission;

        /**
         * ajax reponses
         * 
         * @since 10.0
         */
        public $ajax_response = [];

        /**
         * if uses does not have the required capability show this message
         * 
         * @since 1.0.0
         */
        public $restriction_message;

        public function __construct() { 
            add_action( 'init', function(){
                $this->restriction_message = esc_html__( "You dont have permission to perform this action", 'blogzee' );
            });
            $this->notices_permission = get_theme_mod( 'disable_admin_notices', false );

            if( ! $this->notices_permission ) add_action( 'admin_notices', [ $this, 'admin_welcome_notice' ] );

            add_action( 'wp_ajax_blogzee_admin_notice_ajax_call', [ $this, 'admin_notice_ajax_call' ] );
            add_action( 'wp_ajax_blogzee_importer_plugin_action_for_notice', [ $this, 'blogzee_importer_plugin_action_for_notice' ] );
        }

        /**
         * Admin Welcome notice
         * 
         * @since 1.0.0
         */
        public function admin_welcome_notice() {
            if( ! current_user_can( 'manage_options' ) ) wp_die( $this->restriction_message );

            if( isset( $_GET['page'] ) && in_array( $_GET['page'], [ 'blogzee-info', 'blaze-system-info' ] ) ) return;

            if( get_option( 'blogzee_welcome_notice_dismiss' ) ) return;

            $this->notice_wrapper_open('blogzee-welcome-notice notice-info');
            ?>
                <div class="notice-content">
                    <div class="notice-header">
                        <h2 class="notice-title"><?php echo esc_html__( 'Thank you for activating Blogzee Premium Version!!', 'blogzee' ); ?></h2>
                    </div>
                    <p class="notice-description"><?php echo esc_html__( 'Get started with multipurpose news theme and give your site a new look. We recommend you to please go through the documentation to get started with theme and setup homepage quicky.', 'blogzee' ); ?></p>
                    <div class="notice-actions">
                        <a class="action-button importer" href="<?php echo admin_url( 'admin.php?page=blogzee-info' ); ?>"><?php echo esc_html__( 'Install Demos', 'blogzee' ); ?></a>
                        <a class="action-button" href="<?php echo admin_url( 'customize.php' ); ?>" target="_blank"><?php echo esc_html__( 'Customize Site', 'blogzee' ); ?></a>
                        <a class="action-button" href="<?php echo esc_url( '//doc.blazethemes.com/blogzee/' ); ?>" target="_blank"><?php echo esc_html__( 'Documentation', 'blogzee' ); ?></a>
                    </div>
                </div>
                <?php $this->get_notice_preview(); ?>
                <button class="alert-dismiss"><?php echo esc_html__( 'Dismiss this notice', 'blogzee' ); ?></button>
            <?php
            $this->notice_wrapper_close();
        }

        /**
         * Notice wrapper open
         * 
         * @since 1.0.0
         */
        public function notice_wrapper_open( $classes = '' ) {
            if( $classes != '' ) {
                echo '<div class="blogzee-admin-notice notice is-dismissible ' .esc_attr( $classes ). '">';
            } else {
                echo '<div class="blogzee-admin-notice notice is-dismissible">';
            }
            echo '<div class="admin-notice-inner">';
        }

        /**
         * Notice wrapper open
         * 
         * @since 1.0.0
         */
        public function notice_wrapper_close() {
                echo '</div><!-- .admin-notice-inner -->';
            echo '</div><!-- .blogzee-admin-notice -->';
        }

        /**
         * Notice Preview
         * 
         * @since 1.0.0
         */
        public function get_notice_preview() {
            ?>
                <figure class="notice-preview notice-thumb">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" alt="Welcome" height="100" width="100" loading="lazy">
                </figure>
            <?php
        }

        /**
         * Welcome notice ajax call function
         * 
         * @since 1.0.0
         */
        public function admin_notice_ajax_call() {
            check_ajax_referer( 'blogzee-notice-nonce', '_wpnonce' );
            if( ! current_user_can( 'manage_options' ) ) wp_die( $this->restriction_message );  // check if user role is admin, if not display restriction message
            $dismiss_option = isset( $_POST['dismiss_option'] ) ? sanitize_text_field( $_POST['dismiss_option'] ) : '';
            $is_temporary = isset( $_POST['is_temporary'] ) ? $_POST['is_temporary'] : false;
            if( $is_temporary ) :
                $duration = isset( $_POST['duration'] ) ? absint( $_POST['duration'] ) : 7;
                $count = isset( $_POST['count'] ) ? absint( $_POST['count'] ) : 1;
                $count_id = isset( $_POST['count_id'] ) ? sanitize_text_field( $_POST['count_id'] ) : '';
                update_user_meta( get_current_user_id(), $dismiss_option, time() + $duration * 24 * 60 * 60 );
                update_user_meta( get_current_user_id(), $count_id, $count );
            else:
                update_option( $dismiss_option, true );
            endif;
            $this->ajax_response['status'] = true;
            $this->ajax_response['message'] = esc_html__( 'Welcome notice hidden', 'blogzee' );
            $this->send_ajax_response();
            wp_die();
        }

        /**
         * Activate or install plugins
         *
         * @since 1.0.0
         */
        public function blogzee_importer_plugin_action_for_notice() {            
            $this->plugin_active_install_action( 'blogzee-notice-nonce' );
        }
    }
endif;