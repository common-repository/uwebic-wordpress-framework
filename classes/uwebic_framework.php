<?php
require_once UWEBICFRAMEWORK_PATH . '/classes/abstract.php';

class UwebicFramework extends AbstractFrameworkClass {

    public $_loadJs = '';

    public function __construct() {
        parent::__construct();
    }

    public function setup() {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            //add_action('wp_ajax_add_payment_option', array($this, 'add_payment_option'));
        } else {
            add_action('admin_menu', array($this, 'load_menu'));
            add_action('init', array($this, 'my_admin_head'));
        }
    }


    /**
     * code to run when the plugin was activated
     *
     * */
    public function activate_plugin() {
        //add option to see if content or options are already present in the database (eg: if user already activated the plugin once in the past)
        $version = get_option(UWEBICFRAMEWORK_NAME . '_plugin_version');
        if (!empty($version) && $version != '') {
            //check if the version stored is an old version and update accordingly
            if ($version < UWEBICFRAMEWORK_VERSION) {
                update_option(UWEBICFRAMEWORK_NAME . '_plugin_version', UWEBICFRAMEWORK_VERSION);
            }
        } else {
            add_option(UWEBICFRAMEWORK_NAME . '_plugin_version', UWEBICFRAMEWORK_VERSION);

        }
    }

    public function load_menu() {
        //#todo : Add under tools menu block
        add_management_page('Uwebic Framework', 'Uwebic Framework', 'administrator', UWEBICFRAMEWORK_NAME . '_plugin', array($this, 'mainSettings'));
    }

    /**
     * function to include resources in the admin head
     *
     * @return void
     * */
    public function my_admin_head() {
        wp_register_style('admin_styles', UWEBICFRAMEWORK_URL . '/resources/css/admin_styles.css');
        wp_enqueue_style('admin_styles');
    }

    /**
     * Main settings function
     *
     * @return void
     * */
    public function mainSettings() {
        echo $this->_wpelements->openWrapper('Framework Main Settings');
        
        echo $this->_wpelements->closeWrapper();
    }

}//end of class