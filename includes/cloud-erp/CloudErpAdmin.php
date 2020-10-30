<?php


class CloudErpAdmin
{

    public static function fetch_options(){
        return get_site_option('cloud_erp_for_ecommerce',false);
    }

    public static function verified(){
        return true;
    }

    public function __construct() {

        add_action( 'admin_menu', [$this, 'cloud_erp_for_ecommerce_admin_menu'] );

        register_setting( 'cloud_erp_for_ecommerce', 'cloud_erp_for_ecommerce' );

        add_action( "wp_ajax_verify_api_end_point", [ $this, 'verify_api_end_point' ] );
    }

    function verify_api_end_point(){
        if(!isset($_REQUEST['api_endpoint'])){
            return;
        }
        if(!isset($_REQUEST['wp_token'])){
            return;
        }

        $cloud_erp_api = new CloudErpApi($_REQUEST['wp_token'],$_REQUEST['api_endpoint'] );
        $cloud_erp_api->post('/wp_verify', []);
    }

    function cloud_erp_for_ecommerce_admin_menu(){
        $page_title = 'Cloud ERP Sync';
        $menu_title = 'Cloud ERP Sync';
        $capability = 'manage_options';
        $menu_slug  = 'cloud-erp-sync';
        $icon_url   = 'dashicons-controls-repeat';
        $position   = 4;
        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, function(){
            $options = self::fetch_options();
            include 'parts/options-admin-html.php';

        }, $icon_url, $position );
    }
}