<?php
/*
*	Template name: Migrazione Campi ACF
*/
get_header();
?>

    <?php 
    if (have_posts()) : while (have_posts()) : the_post();

        //MIGRAZIONE CAMPI ARTICOLI
        //prendo tutti gli articoli
        $query_posts = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 2, //2 post per effettuare test, portare a -1 per eseguire la migrazione
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'fields' => 'ids',
        ));
        if($query_posts->have_posts()):
            while($query_posts->have_posts()): $query_posts->the_post();
                $post_id = get_the_ID();

                //AGGIORNO SCHEMA ID WORDLIFT
                if(!get_field('wordlift_id', $post_id)):

                    $id_wordlift = Wordlift_Entity_Service::get_instance()->get_uri( $post_id );

                    update_field('wordlift_id', $id_wordlift, $post_id);

                endif;
                

            endwhile;
        endif;
        $query_posts->reset_postdata();

        echo 'Bellaaa!';

    endwhile; endif; 
    ?>

<?php get_footer(); ?>
