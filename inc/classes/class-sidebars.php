<?php
/*
*Theme Sidebars
*@package Aquila
*/
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Sidebars {
    use Singleton;
    protected function __construct(){
        //load class
        //wp_die('helo');
        $this->setup_hooks();
        
    }
    protected function setup_hooks()
    {
        //actions and filters
        # code...
    add_action('widgets_init', [$this, 'register_sidebars']);
    add_action('widgets_init', [$this, 'register_clock_widget']);


    }
    public function register_sidebars(){
        register_sidebar([
            'name'          => __( 'Sidebar', 'aquila' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Main Sidebar', 'aquila' ),
            'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
            ] );
            register_sidebar([
                'name'          => __( 'Footer', 'aquila' ),
                'id'            => 'sidebar-2',
                'description'   => __( 'Footer Sidebar', 'aquila' ),
                'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
                ] );

            }
            public function register_clock_widget(){
                register_widget('AQUILA_THEME\Inc\Clock_Widget');
            }

    
}
