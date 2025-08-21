<?php
if ( ! class_exists( 'Sports_Agency_Plugin_Activation_WPElemento_Importer' ) ) {
    /**
     * Sports_Agency_Plugin_Activation_WPElemento_Importer initial setup
     *
     * @since 1.6.2
     */

    class Sports_Agency_Plugin_Activation_WPElemento_Importer {

        private static $sports_agency_instance;
        public $sports_agency_action_count;
        public $sports_agency_recommended_actions;

        /** Initiator **/
        public static function get_instance() {
          if ( ! isset( self::$sports_agency_instance) ) {
            self::$sports_agency_instance = new self();
          }
          return self::$sports_agency_instance;
        }

        /*  Constructor */
        public function __construct() {

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // ---------- wpelementoimpoter Plugin Activation -------
            add_filter( 'sports_agency_recommended_plugins', array($this, 'sports_agency_recommended_elemento_importer_plugins_array') );

            $sports_agency_actions                   = $this->sports_agency_get_recommended_actions();
            $this->sports_agency_action_count        = $sports_agency_actions['count'];
            $this->sports_agency_recommended_actions = $sports_agency_actions['actions'];

            add_action( 'wp_ajax_create_pattern_setup_builder', array( $this, 'create_pattern_setup_builder' ) );
        }

        public function sports_agency_recommended_elemento_importer_plugins_array($sports_agency_plugins){
            $sports_agency_plugins[] = array(
                    'name'     => esc_html__('WPElemento Importer', 'sports-agency'),
                    'slug'     =>  'wpelemento-importer',
                    'function' => 'WPElemento_Importer_ThemeWhizzie',
                    'desc'     => esc_html__('We highly recommend installing the WPElemento Importer plugin for importing the demo content with Elementor.', 'sports-agency'),               
            );
            return $sports_agency_plugins;
        }

        public function enqueue_scripts() {
            wp_enqueue_script('updates');      
            wp_register_script( 'sports-agency-plugin-activation-script', esc_url(get_template_directory_uri()) . '/includes/getstart/js/plugin-activation.js', array('jquery') );
            wp_localize_script('sports-agency-plugin-activation-script', 'sports_agency_plugin_activate_plugin',
                array(
                    'installing' => esc_html__('Installing', 'sports-agency'),
                    'activating' => esc_html__('Activating', 'sports-agency'),
                    'error' => esc_html__('Error', 'sports-agency'),
                    'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                    'wpelementoimpoter_admin_url' => esc_url(admin_url('admin.php?page=wpelemento-importer-tgmpa-install-plugins')),
                    'addon_admin_url' => esc_url(admin_url('admin.php?page=wpelementoimporter-wizard'))
                )
            );
            wp_enqueue_script( 'sports-agency-plugin-activation-script' );

        }

        // --------- Plugin Actions ---------
        public function sports_agency_get_recommended_actions() {

            $sports_agency_act_count  = 0;
            $sports_agency_actions_todo = get_option( 'recommending_actions', array());

            $sports_agency_plugins = $this->sports_agency_get_recommended_plugins();

            if ($sports_agency_plugins) {
                foreach ($sports_agency_plugins as $sports_agency_key => $sports_agency_plugin) {
                    $sports_agency_action = array();
                    if (!isset($sports_agency_plugin['slug'])) {
                        continue;
                    }

                    $sports_agency_action['id']   = 'install_' . $sports_agency_plugin['slug'];
                    $sports_agency_action['desc'] = '';
                    if (isset($sports_agency_plugin['desc'])) {
                        $sports_agency_action['desc'] = $sports_agency_plugin['desc'];
                    }

                    $sports_agency_action['name'] = '';
                    if (isset($sports_agency_plugin['name'])) {
                        $sports_agency_action['title'] = $sports_agency_plugin['name'];
                    }

                    $sports_agency_link_and_is_done  = $this->sports_agency_get_plugin_buttion($sports_agency_plugin['slug'], $sports_agency_plugin['name'], $sports_agency_plugin['function']);
                    $sports_agency_action['link']    = $sports_agency_link_and_is_done['button'];
                    $sports_agency_action['is_done'] = $sports_agency_link_and_is_done['done'];
                    if (!$sports_agency_action['is_done'] && (!isset($sports_agency_actions_todo[$sports_agency_action['id']]) || !$sports_agency_actions_todo[$sports_agency_action['id']])) {
                        $sports_agency_act_count++;
                    }
                    $sports_agency_recommended_actions[] = $sports_agency_action;
                    $sports_agency_actions_todo[]        = array('id' => $sports_agency_action['id'], 'watch' => true);
                }
                return array('count' => $sports_agency_act_count, 'actions' => $sports_agency_recommended_actions);
            }

        }

        public function sports_agency_get_recommended_plugins() {

            $sports_agency_plugins = apply_filters('sports_agency_recommended_plugins', array());
            return $sports_agency_plugins;
        }

        public function sports_agency_get_plugin_buttion($slug, $name, $function) {
                $sports_agency_is_done      = false;
                $sports_agency_button_html  = '';
                $sports_agency_is_installed = $this->is_plugin_installed($slug);
                $sports_agency_plugin_path  = $this->get_plugin_basename_from_slug($slug);
                $sports_agency_is_activeted = (class_exists($function)) ? true : false;
                if (!$sports_agency_is_installed) {
                    $sports_agency_plugin_install_url = add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $slug,
                        ),
                        self_admin_url('update.php')
                    );
                    $sports_agency_plugin_install_url = wp_nonce_url($sports_agency_plugin_install_url, 'install-plugin_' . esc_attr($slug));
                    $sports_agency_button_html        = sprintf('<a class="sports-agency-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($sports_agency_plugin_install_url),
                        sprintf(esc_html__('Install %s Now', 'sports-agency'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Install & Activate', 'sports-agency')
                    );
                } elseif ($sports_agency_is_installed && !$sports_agency_is_activeted) {

                    $sports_agency_plugin_activate_link = add_query_arg(
                        array(
                            'action'        => 'activate',
                            'plugin'        => rawurlencode($sports_agency_plugin_path),
                            'plugin_status' => 'all',
                            'paged'         => '1',
                            '_wpnonce'      => wp_create_nonce('activate-plugin_' . $sports_agency_plugin_path),
                        ), self_admin_url('plugins.php')
                    );

                    $sports_agency_button_html = sprintf('<a class="sports-agency-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($sports_agency_plugin_activate_link),
                        sprintf(esc_html__('Activate %s Now', 'sports-agency'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Activate', 'sports-agency')
                    );
                } elseif ($sports_agency_is_activeted) {
                    $sports_agency_button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'sports-agency'));
                    $sports_agency_is_done     = true;
                }

                return array('done' => $sports_agency_is_done, 'button' => $sports_agency_button_html);
            }
        public function is_plugin_installed($slug) {
            $sports_agency_installed_plugins = $this->get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
            $sports_agency_file_path         = $this->get_plugin_basename_from_slug($slug);
            return (!empty($sports_agency_installed_plugins[$sports_agency_file_path]));
        }
        public function get_plugin_basename_from_slug($slug) {
            $sports_agency_keys = array_keys($this->get_installed_plugins());
            foreach ($sports_agency_keys as $sports_agency_key) {
                if (preg_match('|^' . $slug . '/|', $sports_agency_key)) {
                    return $sports_agency_key;
                }
            }
            return $slug;
        }

        public function get_installed_plugins() {

            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return get_plugins();
        }
        public function create_pattern_setup_builder() {

            $edit_page = admin_url().'post-new.php?post_type=page&create_pattern=true';
            echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

            exit;
        }

    }
}
/**
 * Kicking this off by calling 'get_instance()' method
 */
Sports_Agency_Plugin_Activation_WPElemento_Importer::get_instance();