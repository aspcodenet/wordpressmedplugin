<?php 
class StefansTheme{
    private static $instance = null;

    
    private function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
        add_action( 'after_setup_theme', array($this, 'afterSetupTheme') );
    }

    
    public function afterSetupTheme(){
        add_theme_support( 'title-tag' );
    }

    // ÄNDRA
    public function enqueueScripts(){
        wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v6.3.0/js/all.js', array(), '6.3.0', true );
        wp_enqueue_style( 'lora-font', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic', array(), null );
        wp_enqueue_style( 'open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', array(), null );


       $version = wp_get_theme()->get('Version'); 
       wp_enqueue_style('stefansthemestyle', get_template_directory_uri() . "/style.css",array(), $version,'all');
    }

    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}

StefansTheme::get_instance();

?>