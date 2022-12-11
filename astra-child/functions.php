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


//CREO SHORTCODE PER VISUALIZZARE L'ANNO CORRENTE
function trp_current_year( $atts ){
    return date('Y');
}
add_shortcode( 'year', 'trp_current_year' );

//ABILITO SHORTCODE NEI TITOLI
add_filter( 'the_title', 'do_shortcode' );

//ABILITO SHORTCODE IN RANK MATH TITLE
add_filter(
	'rank_math/frontend/title',
	function ( $title ) {
		return do_shortcode( $title );}
);

//ABILITO SHORTCODE YOAST SEO TITLE
add_filter( 'wpseo_title', 'do_shortcode' );


//MODIFICO META TEMA ASTRA
add_filter( 'astra_single_post_meta', 'custom_post_meta' );
add_filter( 'astra_blog_post_meta', 'custom_post_meta' );

function custom_post_meta( $old_meta ) {
	 $post_meta = astra_get_option( 'blog-single-meta' );
	 if ( !$post_meta ) return $old_meta;

	 $new_output = astra_get_post_meta( $post_meta, "|" );
	 if ( !$new_output ) return $old_meta;
 
	 return "<div class='entry-meta'>$new_output</div>";
}


//AGGIUNGO ANNO A TITOLO SINGOLI ARTICOLI
/*
add_filter( 'astra_the_title_after', 'trp_add_single_title_current_year' );
function trp_add_single_title_current_year() {

	if(is_single()):
		return " (".date('Y').")</h1>";
	endif;
}
*/


//SOSTITUISCO LINK AUTORE CON PAGINA ABOUT
add_filter('author_link', 'my_custom_author_link', 10, 3);
function my_custom_author_link($link, $author_id, $author_nicename) {
	$acf_user = "user_{$author_id}";
	$author_page_id = get_field('author_page', $acf_user);
	$link = get_the_permalink($author_page_id);

	return $link;
}


//AGGIUNGO CLASSI AL BODY DEGLI ARTICOLI PER AFFILIAZIONI
function trp_add_body_class($classes) {
	global $post;
	
	if(is_single()):
		$affiliation = get_field('affiliation', $post);
		if($affiliation && $affiliation != 'none'):
			$classes[] = $affiliation;
		endif;
	endif;
	
    return $classes;
}

add_filter('body_class', 'trp_add_body_class');