<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $post;

$FABC_Astra_Customization_Ads_Object = new FABC_Astra_Customization_Ads();

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>
    <?php get_sidebar(); ?>
<?php endif ?>

    <div id="primary" <?php astra_primary_class(); ?>>

        <?php

        while ( have_posts() ) {
            the_post();
            ?>
            <div class="fabc-blog-post" data-fabc-post-title="<?php echo esc_attr( get_the_title() ); ?>" data-fabc-post-url="<?php echo esc_attr( get_the_permalink() ); ?>">
                <?php 

                ob_start();
                include get_template_directory().'/template-parts/content-single.php';
                $post_content = ob_get_clean();

                /**
                 * 
                 * Insert Ads after the first paragraph
                 * @author app.codeable.io/tasks/new?preferredContractor=77368
                 * 
                 */
                $ad_script    = '
                <div class="fabc-ad-live-primis-tech">
                    <script type="text/javascript" language="javascript" src="https://live.primis.tech/live/liveView.php?s=110671"></script>
                </div>';
                
                $post_content = $FABC_Astra_Customization_Ads_Object::insert_ads_after_paragraphs( 
                    array( '1' => $ad_script), 
                    $post_content 
                );

                $allowed_tags           = wp_kses_allowed_html('post');
                $allowed_tags['script'] = array(
                    'type'     => 1,
                    'language' => 1,
                    'src'      => 1,
                );
				$allowed_tags['style'] = array(
                    'type'     => 1,
                    'language' => 1,
                    'src'      => 1,
                );
                $allowed_tags['iframe'] = array(
                    'src'             => array(),
                    'height'          => array(),
                    'width'           => array(),
                    'frameborder'     => array(),
                    'title '          => array(),
                    'allowfullscreen' => array(),
                );
                echo wp_kses( $post_content, $allowed_tags );

                ?>
            </div>
            <?php 
        }

        ?>

    </div><!-- #primary -->


<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>
    <?php get_sidebar(); ?>
<?php endif ?>

<?php get_footer(); ?>