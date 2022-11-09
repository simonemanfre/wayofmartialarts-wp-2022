<?php 

/**
 * 
 * Start Class 
 *
 */
class FABC_Gutenberg {
	
	/**
	 * 
	 * Class Constructor
	 *
	 */
	public function __construct() {
	    /**
		 * 
		 * Actions 
		 *
		 */
	    add_action( 'init', array( $this, 'enqueue_admin_scripts_styles' ) );
	}
	

	/**
	* 
	* Enqueue admin scripts
	*
	*/
	function enqueue_admin_scripts_styles() {

		wp_enqueue_style( 'fabc-gutenberg-blocks', get_stylesheet_directory_uri() . '/customizations/assets/js/gutenberg/build/index.css', array(), '1.0.111', 'all' );

		wp_register_script( 'fabc-gutenberg-blocks',  get_stylesheet_directory_uri().'/customizations/assets/js/gutenberg/build/index.js', array('wp-blocks'), '1.0.898', true );

		wp_localize_script( 'fabc-gutenberg-blocks', 'fabc_gutenberg_cats', self::get_categories() );

		wp_enqueue_script( 'fabc-admin-ajax',  get_stylesheet_directory_uri().'/customizations/assets/js/gutenberg/ajax/ajax.js', array('jquery'), '1.0.898854', true );


		/**
		* 
		* Home header callback
		*
		*/
		register_block_type( 'fabc-astra-child/home-header', array( 
			'editor_script'   => 'fabc-gutenberg-blocks',
			'render_callback' => array( $this, 'home_header_html'), 
		));


		/**
		* 
		* Latest articles callback
		*
		*/
		register_block_type( 'fabc-astra-child/latest-articles', array( 
			'editor_script'   => 'fabc-gutenberg-blocks',
			'render_callback' => array( $this, 'latest_articles_html'), 
		));


		/**
		* 
		* Trending callback
		*
		*/
		register_block_type( 'fabc-astrsa-child/trending-widget', array( 
			'editor_script'   => 'fabc-gutenberg-blocks',
			'render_callback' => array( $this, 'trending_html'), 
		));


		/**
		* 
		* Trending sticky callback
		*
		*/
		register_block_type( 'fabc-astrsa-child/trending-widget-sticky', array( 
			'editor_script'   => 'fabc-gutenberg-blocks',
			'render_callback' => array( $this, 'trending_sticky_html'), 
		));


		/**
		* 
		* In Post Related Post
		*
		*/
		register_block_type( 'fabc-astrsa-child/related-post', array( 
			'editor_script'   => 'fabc-gutenberg-blocks',
			'render_callback' => array( $this, 'in_post_related_posts'), 
		));

	}


	/**
	* 
	* Home header html
	*
	*/
	function home_header_html( $attributes ){

		ob_start();

		?>
		<div class="fabc-home-header" <?php if( !empty( $attributes['gradient_color'] ) ){ echo 'style="background: linear-gradient( 180deg,'.$attributes['gradient_color'].' 0,rgba(251,199,36,0));"'; }?> >

			<div class="fabc-container">
				<div class="fabc-row">

					<?php
					$main_cat_id = '';
					$per_page    = 1;

					if ( isset( $attributes['main_cat_id'] ) && !empty( $attributes['main_cat_id'] ) ) {
						$main_cat_id = $attributes['main_cat_id'];
					}

					if ( isset( $attributes['highlighted_cat_ids'] ) && count( $attributes['highlighted_cat_ids'] ) < 1  ){
						$per_page = 4;
					}

					$post_args = array(
						'fields'         => 'ids',
						'post_status'    => 'publish',
						'post_type'      => 'post',
						'posts_per_page' => $per_page,
						'category__in'   => array( $main_cat_id ),
					);
					$post_ids        = get_posts( $post_args );
					$single_post_ids = $post_ids;
					?>

					<?php if ( count( $post_ids ) >= 1 ): ?>
						<?php foreach ( array_slice( $post_ids, 0, 1 ) as $post_id ): ?>
							<a href="<?php echo get_the_permalink( $post_id ); ?>">
								<div class="fabc-col-md-8">
									<?php if ( has_post_thumbnail( $post_id ) ): ?>
										<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-cat-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>" class="fabc-main-header-img">
									<?php endif ?>
								</div>
							</a>
							<div class="fabc-col-md-4">
								<div class="fabc-home-header-left-bx">
									<a href="<?php echo get_category_link($main_cat_id); ?>">
										<div class="fabc-home-header-cat-name">
											<?php echo esc_html( get_cat_name( $main_cat_id ) ); ?>
										</div>
									</a>
									<a href="<?php echo get_the_permalink( $post_id ); ?>">
										<h3>
											<?php echo get_the_title( $post_id ); ?>
										</h3>
									</a>
									<div class="fabc-home-header-desc">
										<p>
											<?php 

											$content_post = get_post($post_id);
											$content      = $content_post->post_content;
											$content      = apply_filters('the_content', $content);
											$content      = str_replace(']]>', ']]&gt;', $content);
											$content      = strip_tags( $content );

											if( strlen( $content ) > 200 ) {
												echo substr( $content, 0, 200 ).'...';
											}else{
												echo esc_html( $content ); 
											}

											?>
										</p>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>

				</div>
			</div>
		</div>

		<div class="fabc-highlighted-cats">
			<div class="fabc-container">
				<div class="fabc-row">

					<?php 
					$highlighted_cat_ids = array_filter($attributes['highlighted_cat_ids'], function($a) {
						return trim($a) !== "";
					}); 
					?>

					<?php if ( count( $highlighted_cat_ids ) >=1  ): ?>
						<?php foreach ( $attributes['highlighted_cat_ids'] as $cat_id ): ?>
							<div class="fabc-col-md-4">
								<div class="fabc-cat-bx">
									<?php
									$post_args = array(
										'fields'         => 'ids',
										'post_status'    => 'publish',
										'post_type'      => 'post',
										'posts_per_page' => 1,
										'category__in'   => array( $cat_id ),
										'post__not_in'   => $single_post_ids,
									);
									$post_ids = get_posts( $post_args );
									?>
									<?php if ( count( $post_ids ) >= 1 ): ?>
										<?php foreach ( $post_ids as $post_id ): ?>
											<?php if ( has_post_thumbnail( $post_id ) ): ?>
												<a href="<?php echo get_the_permalink( $post_id ); ?>">
													<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-cat-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
												</a>
											<?php endif ?>
											<div class="fabc-cat-bx-deets">
												<a href="<?php echo get_category_link($cat_id); ?>">
													<div class="fabc-cat-bx-cat-name">
														<?php echo esc_html( get_cat_name( $cat_id ) ); ?>
													</div>
												</a>
												<a href="<?php echo get_the_permalink( $post_id ); ?>">
													<h3>
														<?php echo get_the_title( $post_id ); ?>
													</h3>
												</a>
											</div>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>
						<?php endforeach ?>


					<?php else: ?>
						
						<?php
						$post_args = array(
							'fields'         => 'ids',
							'post_status'    => 'publish',
							'post_type'      => 'post',
							'posts_per_page' => 3,
							'category__in'   => array( $main_cat_id ),
							'post__not_in'   => $single_post_ids,
						);
						$post_ids = get_posts( $post_args );
						?>

						<?php if ( count( $post_ids ) >= 1 ): ?>
							<?php foreach ( $post_ids as $post_id ): ?>

								<div class="fabc-col-md-4">
									<div class="fabc-cat-bx">
										<?php if ( has_post_thumbnail( $post_id ) ): ?>
											<a href="<?php echo get_the_permalink( $post_id ); ?>">
												<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-cat-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
											</a>
										<?php endif ?>
										<div class="fabc-cat-bx-deets">
											<a href="<?php echo get_category_link( $main_cat_id ); ?>">
												<div class="fabc-cat-bx-cat-name">
													<?php echo esc_html( get_cat_name( $main_cat_id ) ); ?>
												</div>
											</a>
											<a href="<?php echo get_the_permalink( $post_id ); ?>">
												<h3>
													<?php echo get_the_title( $post_id ); ?>
												</h3>
											</a>
										</div>
									</div>
								</div>

							<?php endforeach ?>
						<?php endif ?>

					<?php endif ?>

				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}


	/**
	* 
	* Latest articles html
	*
	*/
	function latest_articles_html( $attributes ){

		ob_start();

		?>

		<?php
		$main_cat_id              = '';
		$single_post_ids          = '';
		$single_post_ids_main_cat = '';
		if ( isset( $attributes['main_cat_id'] ) && !empty( $attributes['main_cat_id'] ) ) {
			$main_cat_id = $attributes['main_cat_id'];
			$post_args   = array(
				'fields'         => 'ids',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => 1,
				'category__in'   => array( $main_cat_id ),
			);
			$single_post_ids_main_cat = get_posts( $post_args );
		}

		?>

		<div class="fabc-latest-in-cats">

			<?php if ( isset( $attributes['title'] ) && !empty( $attributes['title'] ) ): ?>
			<h3 class="fabc-heading-with-border">
				<?php echo esc_html( $attributes['title'] ); ?>
			</h3>
		<?php endif ?>


		<ul class="fabc-latest-in-cats-articles">

			<?php if ( !empty( $single_post_ids_main_cat ) && count( $single_post_ids_main_cat ) >= 1 ): ?>
			<?php foreach ($single_post_ids_main_cat as $post_id ): ?>
				<li class="fabc-latest-in-cats-articles-main-cat">
					<?php if ( has_post_thumbnail( $post_id ) ): ?>
						<a href="<?php echo get_the_permalink( $post_id ); ?>">
							<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
						</a>
					<?php endif ?>
					<a href="<?php echo get_category_link( $main_cat_id ); ?>">
						<div class="fabc-cat-name">
							<?php echo esc_html( get_cat_name( $main_cat_id ) ); ?>
						</div>
					</a>
					<a href="<?php echo get_the_permalink( $post_id ); ?>">
						<h3>
							<?php echo get_the_title( $post_id ); ?>
						</h3>
					</a>
					<p>
						<?php 
						$content_post = get_post($post_id);
						$content      = $content_post->post_content;
						$content      = apply_filters('the_content', $content);
						$content      = str_replace(']]>', ']]&gt;', $content);
						$content      = strip_tags( $content );

						if( strlen( $content ) > 400 ) {
							echo substr( $content, 0, 400 ).'...';
						}else{
							echo esc_html( $content ); 
						}
						?>
					</p>
					<p class="fabc-post-author">
						<?php
						$author_id   = get_post_field( 'post_author', $post_id );
						$author_name = get_the_author_meta( 'display_name', $author_id );
						?>
						<?php if ( !empty( $author_name ) ): ?>
							<a href="<?php echo get_author_posts_url( $author_id ); ?>">
								By <?php echo $author_name; ?>
							</a>
						<?php endif ?>
					</p>
				</li>
			<?php endforeach ?>
		<?php endif ?>

		<?php 
		$highlighted_cat_ids = array_filter($attributes['highlighted_cat_ids'], function($a) {
			return trim($a) !== "";
		}); 
		?>

		<?php if ( !empty( $highlighted_cat_ids ) && count( $highlighted_cat_ids ) >=1  ): ?>
		<?php foreach ( $attributes['highlighted_cat_ids'] as $cat_id ): ?>
			<?php
			$post_args = array(
				'fields'         => 'ids',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => 1,
				'category__in'   => array( $cat_id ),
				'post__not_in'   => $single_post_ids_main_cat,
			);
			$post_ids = get_posts( $post_args );
			?>
			<?php if ( count( $post_ids ) >= 1 ): ?>

				<?php foreach ( $post_ids as $post_id ): ?>
					<li>
						<div class="fabc-latest-in-cats-bx">
							<div class="fabc-row">
								<div class="fabc-col-md-5">
									<?php if ( has_post_thumbnail( $post_id ) ): ?>
										<a href="<?php echo get_the_permalink( $post_id ); ?>">
											<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-cat-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
										</a>
									<?php endif ?>
								</div>
								<div class="fabc-col-md-7">
									<div class="fabc-latest-in-cats-content">
										<a href="<?php echo get_category_link( $cat_id ); ?>">
											<div class="fabc-cat-name">
												<?php echo esc_html( get_cat_name( $cat_id ) ); ?>
											</div>
										</a>
										<a href="<?php echo get_the_permalink( $post_id ); ?>">
											<h3>
												<?php echo get_the_title( $post_id ); ?>
											</h3>
										</a>
										<p>
											<?php 
											$content_post = get_post($post_id);
											$content      = $content_post->post_content;
											$content      = apply_filters('the_content', $content);
											$content      = str_replace(']]>', ']]&gt;', $content);
											$content      = strip_tags( $content );

											if( strlen( $content ) > 130 ) {
												echo substr( $content, 0, 130 ).'...';
											}else{
												echo esc_html( $content ); 
											}
											?>
										</p>
										<p class="fabc-post-author">
											<?php
											$author_id   = get_post_field( 'post_author', $post_id );
											$author_name = get_the_author_meta( 'display_name', $author_id );
											?>
											<?php if ( !empty( $author_name ) ): ?>
												<a href="<?php echo get_author_posts_url( $author_id ); ?>">
													By <?php echo $author_name; ?>
												</a>
											<?php endif ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			<?php endif ?>
		<?php endforeach ?>



	<?php else: ?>
		<?php
		$post_args = array(
			'fields'         => 'ids',
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'posts_per_page' => 5,
			'category__in'   => array( $main_cat_id ),
			'post__not_in'   => $single_post_ids_main_cat,
		);
		$post_ids = get_posts( $post_args );
		?>
		<?php if ( count( $post_ids ) >= 1 ): ?>

			<?php foreach ( $post_ids as $post_id ): ?>
				<li>
					<div class="fabc-latest-in-cats-bx">
						<div class="fabc-row">
							<div class="fabc-col-md-5">
								<?php if ( has_post_thumbnail( $post_id ) ): ?>
									<a href="<?php echo get_the_permalink( $post_id ); ?>">
										<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-cat-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
									</a>
								<?php endif ?>
							</div>
							<div class="fabc-col-md-7">
								<div class="fabc-latest-in-cats-content">
									<a href="<?php echo get_category_link( $main_cat_id ); ?>">
										<div class="fabc-cat-name">
											<?php echo esc_html( get_cat_name( $main_cat_id ) ); ?>
										</div>
									</a>
									<a href="<?php echo get_the_permalink( $post_id ); ?>">
										<h3>
											<?php echo get_the_title( $post_id ); ?>
										</h3>
									</a>
									<p>
										<?php 
										$content_post = get_post($post_id);
										$content      = $content_post->post_content;
										$content      = apply_filters('the_content', $content);
										$content      = str_replace(']]>', ']]&gt;', $content);
										$content      = strip_tags( $content );

										if( strlen( $content ) > 130 ) {
											echo substr( $content, 0, 130 ).'...';
										}else{
											echo esc_html( $content ); 
										}
										?>
									</p>
									<p class="fabc-post-author">
										<?php
										$author_id   = get_post_field( 'post_author', $post_id );
										$author_name = get_the_author_meta( 'display_name', $author_id );
										?>
										<?php if ( !empty( $author_name ) ): ?>
											<a href="<?php echo get_author_posts_url( $author_id ); ?>">
												By <?php echo $author_name; ?>
											</a>
										<?php endif ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
			<?php endforeach ?>
		<?php endif ?>


	<?php endif ?>

</ul>
</div>
<?php
return ob_get_clean();
}


	/**
	* 
	* Trending html
	*
	*/
	function trending_html( $attributes ){
		ob_start();
		?>
		<div class="fabc-home-trending">

			<?php if ( isset( $attributes['title'] ) && !empty( $attributes['title'] ) ): ?>
			<div class="fabc-home-trending-title">
				<h3 class="fabc-heading-with-border">
					<?php echo esc_html( $attributes['title'] ); ?>
				</h3>
			</div>
		<?php endif ?>

		<?php

		$tag_ids   = '';
		if ( isset( $attributes['tag_ids'] ) && !empty( $attributes['tag_ids'] ) ) {
			$tag_ids = preg_split("/\\r\\n|\\r|\\n/", $attributes['tag_ids'] );
		}

		$post_args = array(
			'fields'         => 'ids',
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'posts_per_page' => 5,
			'tag__in'        => $tag_ids,
		);
		$post_ids = get_posts( $post_args );
		shuffle( $post_ids );
		?>

		<?php if ( count( $post_ids ) >= 1 ): ?>
			<ul class="fabc-home-trending-list">
				<?php foreach ( $post_ids as $post_id ): ?>
					<li>
						<?php if ( has_post_thumbnail( $post_id ) ): ?>
							<a href="<?php echo get_the_permalink( $post_id ); ?>">
								<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'fabc-trending-box' )[0]; ?>" alt="<?php echo get_the_title( $post_id ); ?>">
							</a>
						<?php endif ?>
						<?php 
						$post_cats = wp_get_post_categories( $post_id );
						?>
						<?php if ( !empty( $post_cats ) ): ?>
							<a href="<?php echo get_category_link( $post_cats[0] ); ?>">
								<div class="fabc-cat-name">
									<?php echo get_cat_name( $post_cats[0] ); ?>
								</div>
							</a>
						<?php endif ?>
						<a href="<?php echo get_the_permalink( $post_id ); ?>">
							<h4>
								<?php echo get_the_title( $post_id ); ?>
							</h4>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>

	</div>
	<?php
	return ob_get_clean();
}



	/**
	* 
	* Trending Sticky Html
	*
	*/
	function trending_sticky_html( $attributes ){

		$main_cat_id = '';
		if ( isset( $attributes['main_cat_id'] ) && !empty( $attributes['main_cat_id'] ) ) {
			$main_cat_id = $attributes['main_cat_id'];
			$post_args   = array(
				'fields'         => 'ids',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => 4,
				'category__in'   => array( $main_cat_id ),
			);
			$post_ids = get_posts( $post_args );
		}else {
			$post_args = array(
				'fields'         => 'ids',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'posts_per_page' => 4,
			);
			$post_ids = get_posts( $post_args );
		}

		ob_start();
		?>
		<div class="fabc-trending-sticky">
			<div class="fabc-sticy-widget">
				<h3 class="fabc-heading-with-border">
					<?php echo esc_html( $attributes['title'] ); ?>	
				</h3>
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
													echo substr( esc_html( $title ), 0, 64 ).'...';
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
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	* 
	* Get Categories
	*
	*/
	function get_categories(){

		$categories          = get_categories();
		$js_cats             = [];
		$js_cats[0]['label'] = '-Select-';
		$js_cats[0]['value'] = '';

		if ( count( $categories ) >= 1 ) {
			foreach ( $categories as $key => $category ) {
				$js_cats[$key+1]['label'] = $category->name;
				$js_cats[$key+1]['value'] = $category->term_id;
			}
		}

		return $js_cats;
	}


	/**
	* 
	* In Post Related Post
	*
	*/
	function in_post_related_posts( $attributes ){

		if ( !isset( $attributes['post_data'] ) ) {
			return;
		}
		
		$post_data = json_decode( $attributes['post_data'], true );
		$post_id   = sanitize_text_field( $post_data['value'] );
	
		if ( !isset( $post_id ) || empty( $post_id ) ) {
			return;
		}

		ob_start();

		?>
		<div class="fabc-in-post-related-post">
			<div class="fabc-in-post-related-post-inner">
				<a href="<?php echo get_the_permalink( $post_id ); ?>">
					<span class="fabc-in-post-related-post-r-title">
						<?php esc_html_e( 'RELATED', 'fabc' ); ?>:
					</span>
					<span class="fabc-in-post-related-post-the-title">
						<?php echo get_the_title( $post_id ); ?>
					</span>
				</a>
			</div>
		</div>
		<?php 
		return ob_get_clean();
	}



}//End of class FABC_Gutenberg


/*		
*
* FABC_Gutenberg Object
*
*/
$FABC_FABC_Gutenberg_Object = new FABC_Gutenberg(); 