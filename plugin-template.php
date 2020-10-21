<?php
/**
 * Plugin Name: Plugin Template
 * Description: Plugin Template
 * Version: 1.0
 * Author: Azeez
 **/

class PluginTemplate{

    public function __construct()
    {
        add_action('init',function(){
            add_action('wp_enqueue_scripts',[$this,'initialize_scripts']);
        });
    }

    function initialize_scripts(){
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('plugin-template-js',plugin_dir_url(__FILE__).'assets/js/script.js?v=' . $this->getRandomNum());
        wp_enqueue_style('plugin-template-css',plugin_dir_url(__FILE__).'assets/css/style.css?v=' . $this->getRandomNum());
    }

    function getRandomNum(){
        if(is_user_logged_in()){
            return rand();
        }else{
            return '1.0';
        }
    }
}

$plugin_template = new PluginTemplate();

