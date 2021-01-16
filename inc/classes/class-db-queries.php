<?php
/*
*DB Queries
*@package Aquila
*/

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets
{
    use Singleton;
    protected function __construct()
    {
        //load class
        //wp_die('helo');
        $this->setup_hooks();
    }
    protected function setup_hooks()
    {
        //actions and filters
        # code...
        add_action('wp_enqueue_scripts', [$this, 'register_styles']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }
    public function get_countries($some_parameter)
    {
        global $wpdb;
        $results = $wpdb->get_results(
            $wpdb->prepare("SELECT count(ID) as total FROM {$wpdb->wp}your_table_without_prefix WHERE some_field_in_your_table=%d", $some_parameter)
        );
    }
}
