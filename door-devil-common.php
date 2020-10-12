<?php
/**
 * Plugin Name: Door Devil Common
 * Description: Door Devil Common
 * Version: 1.0
 * Author: Azeez
 **/

define('COMMON_DOORDEVIL_PLUGIN', __FILE__);

class DoorDevilCommon{

    public function __construct()
    {
        add_action('init',function(){
            add_action('wp_enqueue_scripts',[$this,'initialize_scripts']);
        });

        add_action('wp_footer', [$this,'render_exit_intent_popup']);
    }

    function initialize_scripts(){
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('door-devil-common-js',plugin_dir_url(__FILE__).'assets/js/script.js?v=' . $this->getRandomNum());
        wp_enqueue_style('door-devil-common-css',plugin_dir_url(__FILE__).'assets/css/style.css?v=' . $this->getRandomNum());
    }

    function render_exit_intent_popup(){
        include 'templates/exit-intent-quiz.php';
    }

    function getRandomNum(){
        if(is_user_logged_in()){
            return rand();
        }else{
            return '1.0';
        }
    }
}

$plugin_template = new DoorDevilCommon();

