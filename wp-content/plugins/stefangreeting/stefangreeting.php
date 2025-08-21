<?php
/**
 * Plugin Name: Stefans Greeting
 * Description: Ett enkelt plugin som visar en hälsning beroende på tidpunkten på dygnet med en shortcode, inklusive en inställningssida.
 * Version: 2.0
 * Author: Stefan
 */

// Se till att filen inte kan nås direkt
if (!defined('ABSPATH')) {
    exit;
}


class StefanGreeting{
    private static $instance = null;

    
    private function __construct(){
        add_action('admin_menu', array($this,'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
        add_action('init', array($this, 'register_shortcode')); 
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
  }

    public function register_shortcode() {
        error_log('Registering shortcode');
        add_shortcode('stefangreetingcode', array($this, 'shortcode_handler'));
    }

    /**
     * Registrera shortcode för att visa hälsningen.
     */
    function add_admin_menu()
    {
        add_options_page(
            'Hälsningsinställningar',
            'Stefans greetings settings',
            'manage_options',
            'stefangreeting-settings',
            array($this,'settings_page_html')
        );
    }

    function settings_init()
    {
        // Registrera en ny inställningsgrupp.
        register_setting('stefangreeting-options', 'stefangreeting_settings');

        // Lägg till ett nytt avsnitt på inställningssidan.
        add_settings_section(
            'stefangreeting_general_section',
            'Grundläggande inställningar',
            array($this,'general_section_callback'),
            'stefangreeting-settings'
        );

        // Lägg till fält för varje tidpunkt.
        add_settings_field(
            'stefangreeting_morning_end',
            'Morgon slutar vid (timme)',
            array($this,'morning_end_callback'),
            'stefangreeting-settings',
            'stefangreeting_general_section'
        );
        add_settings_field(
            'stefangreeting_day_end',
            'Dag slutar vid (timme)',
            array($this,'day_end_callback'),
            'stefangreeting-settings',
            'stefangreeting_general_section'
        );
        add_settings_field(
            'stefangreeting_evening_end',
            'Kväll slutar vid (timme)',
            array($this,'evening_end_callback'),
            'stefangreeting-settings',
            'stefangreeting_general_section'
        );
    }

    function general_section_callback()
    {
        echo '<p>Ange när varje hälsning ska sluta. Använd 24-timmarsformat (0-23).</p>';
    }
    
    function morning_end_callback()
    {
        $options = get_option('stefangreeting_settings');
        $value = isset($options['morning_end']) ? absint($options['morning_end']) : 12;
        echo '<input type="number" name="stefangreeting_settings[morning_end]" value="' . esc_attr($value) . '" min="0" max="23" />';
    }

    /**
     * Callback-funktion för fältet "Dag slutar vid".
     */
    function day_end_callback()
    {
        $options = get_option('stefangreeting_settings');
        $value = isset($options['day_end']) ? absint($options['day_end']) : 18;
        echo '<input type="number" name="stefangreeting_settings[day_end]" value="' . esc_attr($value) . '" min="0" max="23" />';
    }

    /**
     * Callback-funktion för fältet "Kväll slutar vid".
     */
    function evening_end_callback()
    {
        $options = get_option('stefangreeting_settings');
        $value = isset($options['evening_end']) ? absint($options['evening_end']) : 22;
        echo '<input type="number" name="stefangreeting_settings[evening_end]" value="' . esc_attr($value) . '" min="0" max="23" />';
    }

    function settings_page_html()
    {
        // Kontrollera om användaren har behörighet att hantera inställningar.
        if (!current_user_can('manage_options')) {
            return;
        }

        // Visa eventuella meddelanden från Settings API.
        settings_errors();

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // Länka till inställningsgruppen.
                settings_fields('stefangreeting-options');
                // Visa inställningsavsnitten och fälten.
                do_settings_sections('stefangreeting-settings');
                // Visa knappen för att spara.
                submit_button('Spara NU ');
                ?>
            </form>
        </div>
        <?php
    }

    function get_message()
    {
        // Hämta inställningarna, eller använd standardvärden om de inte finns.
        $options = get_option('stefangreeting_settings', [
            'morning_end' => 12,
            'day_end' => 18,
            'evening_end' => 22,
        ]);

        $current_hour = (int) date('H');

        if ($current_hour < $options['morning_end']) {
            return 'God morgon!';
        } elseif ($current_hour < $options['day_end']) {
            return 'God dag!';
        } elseif ($current_hour < $options['evening_end']) {
            return 'God kväll!';
        } else {
            return 'God natt!';
        }
    }

    function shortcode_handler()
        {
            error_log('StefanGreeting shortcode handler anropad!');
        $message = $this->get_message();
        
        $output = '<div class="stefangreeting-container">';
        $output .= '<h2>' . esc_html($message) . '</h2>';
        $output .= '</div>';

        return $output;
    }

    function enqueue_styles() {
        $style = '
        .stefangreeting-container {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
            text-align: center;
            border-radius: 5px;
        }
        .stefangreeting-container h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }';

        wp_add_inline_style('stefangreeting-style', $style);
    }




    
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}

StefanGreeting::get_instance();

?>