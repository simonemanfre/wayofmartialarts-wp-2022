<?php
/*
* 
* Child Theme Styles & Scripts
*
*/
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_scripts_styles' );
function astra_child_enqueue_scripts_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array(), '1.0.971', 'all' );
   wp_enqueue_style( 'astra-child-theme', get_stylesheet_directory_uri() . '/customizations/assets/css/main.css', array(), '1.0.0.1898', 'all' );

   wp_enqueue_script( 'astra-child-theme', get_stylesheet_directory_uri() . '/customizations/assets/js/main.js', array('jquery'), '1.0.78891298', 'all', true  );
}



/*
* 
* Customizer Options
*
*/
require get_theme_file_path( 'customizations/customizer-options/customizer.php' );


/*
* 
* Astra Child Classes
*
*/
require get_theme_file_path( 'customizations/classes/astra-child-class.php' );
require get_theme_file_path( 'customizations/classes/ads.php' );
require get_theme_file_path( 'customizations/classes/ajax/ajax.php' );


/*
* 
* Gutenberg Class
*
*/
require get_theme_file_path( 'customizations/classes/gutenberg/gutenberg.php' );


/*
* 
* Shortcodes
*
*/
require get_theme_file_path( 'customizations/shortcodes/related_posts.php' );

