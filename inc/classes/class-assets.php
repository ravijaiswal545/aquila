<?php
/*
*Enqueue Theme Assets
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
        add_action('wp_ajax_create_applicant', [$this, 'create_applicant']);
        add_action('wp_ajax_nopriv_create_applicant', [$this, 'create_applicant']);
        add_action('wp_ajax_nopriv_fetchcity', [$this, 'fetchcity']);
        add_action('wp_ajax_nopriv_fetchposts', [$this, 'fetchposts']);

    }

    public function register_styles()
    {

        wp_register_style('main-css', AQUILA_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], filemtime(AQUILA_BUILD_CSS_DIR_PATH . '/main.css'), 'all');

        wp_register_style('bootstrap-css', AQUILA_BUILD_LIB_URI . '/css/bootstrap.min.css', [], false, 'all');


        wp_enqueue_style('bootstrap-css');

        wp_enqueue_style('main-css');
    }

    public function register_scripts()
    {
        wp_register_script('main-js', AQUILA_BUILD_JS_URI . '/main.js', ['jquery'], filemtime(AQUILA_BUILD_JS_DIR_PATH . '/main.js'), true);
        wp_register_script('bootstrap-js', AQUILA_BUILD_LIB_URI . '/js/bootstrap.min.js', ['jquery'], false, true);


        wp_enqueue_script('main-js');
        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('jquery-form');
    }
    public function create_applicant()
    {
        wp_send_json_success(['POST' => $_POST, 'FILES' => $_FILES]);
    }
    public function fetchcity()
    {
        global $wpdb;
        if (isset($_POST['term_taxonomy_id'])) {
            $objectIds = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE (term_taxonomy_id = " . $_POST['term_taxonomy_id'] . ")");
            $cities = [];
            foreach ($objectIds as $objectId) {
                $array = json_decode(json_encode($objectId), true);
                array_push($cities, get_the_terms($array['object_id'], 'city'));
                
            }
            
            //$cities = array_unique($cities);
            // $cities = array_unique($cities);
            // $cities
        }


        // wp_send_json_success(['state_id' => $_POST]);
        wp_send_json_success([
            'state_id' => $_POST['term_taxonomy_id'],
            'cities' => $cities,
            // 'debug' => $output
        ]);
    }
    public function fetchposts(){
        if (isset($_POST['city_id'])) {
            $posts = get_posts(array(
                'post_type' => 'sales_network',
                'numberposts' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'city',
                        'field' => 'term_id',
                        'terms' => $_POST['city_id'], /// Where term_id of Term 1 is "1".
                        //'include_children' => false
                    )
                )
            ));
        }
        wp_send_json_success([
            'city_id' => $_POST['city_id'],
            'posts' => $posts,
            'debug' => $_POST['city_id'][0]->term_id
        ]);
    }
}
