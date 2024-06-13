<?php
/**
 * Bootstraps the plugin.
 */

namespace BULK_IMPORT\Inc;

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

use BULK_IMPORT\Inc\Traits\Singleton;

class Autoloader {
    use Singleton;

    protected function __construct() {

        // load class.
        Enqueue_Assets::get_instance();
        Admin_Menu::get_instance();
        Api_Endpoints::get_instance();
        
    }
}