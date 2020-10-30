<?php
/**
 * Plugin Name: Cloud Erp For Ecommerce
 * Description: Cloud Erp For Ecommerce
 * Version: 1.0
 * Author: Azeez
 **/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'CLOUD_ERP_SYNC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CLOUD_ERP_SYNC_PLUGIN_FILE', __FILE__ );

require( 'vendor/autoload.php' );

class CloudErpForEcommerce{

    public function __construct()
    {
        add_action('init',function(){
            add_action('wp_enqueue_scripts',[$this,'initialize_scripts']);
        });
    }

    function initialize_scripts(){
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('cloud-erp-for-ecommerce-js',plugin_dir_url(__FILE__).'assets/js/script.js?v=' . $this->getRandomNum());
        wp_enqueue_style('cloud-erp-for-ecommerce-css',plugin_dir_url(__FILE__).'assets/css/style.css?v=' . $this->getRandomNum());
    }

    function getRandomNum(){
        if(is_user_logged_in()){
            return rand();
        }else{
            return '1.0';
        }
    }
}

new CloudErpForEcommerce();
new CloudErpAdmin();

