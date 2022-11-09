<?php 

/**
 * 
 * Start Class 
 *
 */
class FABC_Astra_Shortcodes {
	
	/**
	 * 
	 * Class Constructor
	 *
	 */
	public function __construct() {
		add_shortcode( 'fabc_related_posts', array( $this, 'related_posts' ) );
	}

	public static function related_posts( $atts ) {

		$args = [];
		$args = shortcode_atts( 
			array(
				'title'  => 'Related Posts',
				'number' => 5
			), 
			$atts
		);

		$title  = $args['title'];
		$number = $args['number'];

		ob_start();

		global $post;

		if ( !is_object( $post ) ) {
			return;
		}

		if ( !is_single() ) {
			return;
		}

		$post_id = $post->ID;
		$args = array(
			'fields'         => 'ids',
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'posts_per_page' => $number,
			'post__not_in'   => array( $post_id ),
		);

		$tag_ids         = [];
		$post_cats       = [];

		$load_posts_from = get_theme_mod( 'fabc_load_from' );
		$post_cats       = wp_get_post_categories( $post_id );

		$post_tags       = get_the_tags( $post_id );
		if ( !empty( $post_tags ) ) {
			foreach ( $post_tags as $post_tag ) {
				$tag_ids[] = $post_tag->term_id; 
			}
		}


		if ( empty( $load_posts_from ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_cats,
				),
			);
		}
		else if ( empty( $post_tags ) && $load_posts_from == 'post_tag' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_cats,
				),
			);
		}
		else if( $load_posts_from == 'category' ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_cats,
				),
			);
		}
		else if( $load_posts_from == 'post_tag' ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tag_ids,
				),
			);
		}
		else if ( $load_posts_from == 'cat_tag' ) {
			
			$posts_by_tags = [];
			$posts_by_cats = [];
			$merged_ids    = [];
			$tags_args     = [];
			$cats_args     = [];

			$tags_args['posts_per_page'] = -1;
			$tags_args['tax_query'] = array(
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tag_ids,
				),
			);
			$tags_args = array_merge( $tags_args, $args );

			$cats_args['posts_per_page'] = -1;
			$cats_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_cats,
				),
			);
			$cats_args        = array_merge( $cats_args, $args );

			$posts_by_tags    = get_posts( $tags_args );
			$posts_by_cats    = get_posts( $cats_args );
			$merged_ids       = array_merge( $posts_by_tags, $posts_by_cats );
			$merged_ids       = array_unique( $merged_ids );

			$args['post__in'] = $merged_ids;
			$args['orderby']  = 'post__in';

		}

		$post_ids = get_posts( $args );


		/**
		 * 
		 * Reset post data
		 *
		 */
		if ( count( $post_ids ) >= 1 ) {
			wp_reset_postdata();
		}
		?>
		<div>
			<?php if ( !empty( $title ) ): ?>
				<h3 class="fabc-related-posts-title fabc-heading-with-border">
					<?php echo esc_html( $title ); ?>	
				</h3>
			<?php endif ?>

			<?php if ( count( $post_ids ) >= 1 ): ?>
				<ul class="fabc-sidebar-rp">
					<?php foreach ( $post_ids as $the_post_id ): ?>
						<li>
							<a href="<?php echo get_the_permalink( $the_post_id ); ?>">
								<div class="fabc-row">
									<div class="fabc-col-md-4">
										<div class="fabc-rp-thumb">
											<?php if ( has_post_thumbnail( $the_post_id ) ): ?>
												<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $the_post_id ), 'fabc-related-posts' )[0]; ?>" alt="<?php echo get_the_title( $the_post_id ); ?>">
											<?php else: ?>
												<div class="fabc-thum-placeholder"></div>
											<?php endif ?>
										</div>
									</div>
									<div class="fabc-col-md-8">
										<h5>
											<?php 

											$title = get_the_title( $the_post_id ); 

											if( strlen( $title ) > 64 ) {
												echo substr( $title, 0, 64 ).'...';
											}else{
												echo esc_html( $title ); 
											}
											
											?>
										</h5>
									</div>
								</div>
							</a>
						</li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</div>
		<?php 
		return ob_get_clean();
	}

}//End of class FABC_Astra_Shortcodes


/*		
*
* FABC_Astra_Shortcodes Object
*
*/
$FABC_Astra_CustomizationObject = new FABC_Astra_Shortcodes(); 
