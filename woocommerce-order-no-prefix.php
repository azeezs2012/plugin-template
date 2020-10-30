<?php
/**
 * Plugin Name: Woocommerce Order No Prefix
 * Description: Woocommerce Order No Prefix
 * Version: 1.0
 * Author: Azeez
 **/

class WooCommerceOrderNoPrefix{

    public function __construct()
    {
        add_action('init',function(){
            add_action('wp_enqueue_scripts',[$this,'initialize_scripts']);
        });

        add_filter( 'woocommerce_get_sections_products', [$this, 'add_section'] );

        add_filter( 'woocommerce_get_settings_products', [$this, 'add_settings'], 10, 2 );

        add_filter( 'woocommerce_order_number', [$this, 'change_woocommerce_order_number'] );
    }

    function add_settings($settings, $current_section){
        if ( $current_section == 'ordernoprefix' ) {
            $settings_order_no = array();

            $settings_order_no[] = array( 'name' => __( 'Woocommerce Order No Prefix', 'text-domain' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Slider', 'text-domain' ), 'id' => 'wcslider' );

            $settings_order_no[] = array(
                'name'     => __( 'Enable', 'text-domain' ),
                'desc_tip' => __( 'This will update the specified prefix or suffix to the order no', 'text-domain' ),
                'id'       => 'ordernoprefix_enable',
                'type'     => 'checkbox',
                'css'      => 'min-width:300px;',
                'desc'     => __( 'Enable Prefix or Suffix', 'text-domain' ),
            );

            $settings_order_no[] = array(
                'name'     => __( 'Prefix', 'text-domain' ),
                'desc_tip' => __( 'This will update prefix to woocommerce order no', 'text-domain' ),
                'id'       => 'ordernoprefix_prefix',
                'type'     => 'text',
                'desc'     => __( 'This will update prefix to woocommerce order no', 'text-domain' ),
            );

            $settings_order_no[] = array(
                'name'     => __( 'Suffix', 'text-domain' ),
                'desc_tip' => __( 'This will update suffix to woocommerce order no', 'text-domain' ),
                'id'       => 'ordernoprefix_suffix',
                'type'     => 'text',
                'desc'     => __( 'This will update suffix to woocommerce order no', 'text-domain' ),
            );

            $settings_order_no[] = array( 'type' => 'sectionend', 'id' => 'ordernoprefix' );
            return $settings_order_no;
        }else{
            return $settings;
        }
    }

    function add_section( $sections ) {

        $sections['ordernoprefix'] = __( 'Order No Prefix', 'text-domain' );
        return $sections;

    }

    function change_woocommerce_order_number($order_id){
        if(get_option('ordernoprefix_enable') == 'yes'){
            $prefix = get_option('ordernoprefix_prefix');
            $suffix = get_option('ordernoprefix_suffix');
            return ((isset($prefix) && !empty($prefix)) ? $prefix . '-' : '') . $order_id . ((isset($suffix) && !empty($suffix)) ?  '-' . $suffix : '');
        }else{
            return $order_id;
        }

    }

    function initialize_scripts(){
        //wp_enqueue_script( 'jquery' );
       // wp_enqueue_script('woocommerce-order-no-prefix-js',plugin_dir_url(__FILE__).'assets/js/script.js?v=' . $this->getRandomNum());
        //wp_enqueue_style('woocommerce-order-no-prefix-css',plugin_dir_url(__FILE__).'assets/css/style.css?v=' . $this->getRandomNum());
    }

    function getRandomNum(){
        if(is_user_logged_in()){
            return rand();
        }else{
            return '1.0';
        }
    }
}

$woocommerce_order_no_prefix = new WooCommerceOrderNoPrefix();

