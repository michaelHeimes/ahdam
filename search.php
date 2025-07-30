<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package trailhead
 */

get_header();

$post_type = get_post_type();

?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			
			<div class="entry-content">
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-12 xlarge-10">

							<header class="page-header">
								<h1 class="page-title">
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'trailhead' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							</header><!-- .page-header -->
				
							<?php
							
							if( $post_type == 'expert-qa' ):
								$title = get_the_title();  
								$post = get_post();
								$content = apply_filters('the_content', $post->post_content);	
							?>	
								<div class="wp-block-accordion-drawers">
									<ul class="accordion bg-white box-shadow-5-15-10 br-10" 
									data-multi-expand="true"
									data-allow-all-closed="true"
									data-accordion>
							<?php endif;
							
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								
								if( $post_type == 'expert-qa' ):
								?>
								
								<li class="accordion-item" data-accordion-item>
									<a class="p p-2 relative" href="#<?=sanitize_title($title);?>" class="accordion-title">
										<div class="grid-x">
											<div class="cell shrink">
												<strong>Q:</strong>
											</div>
											<div class="cell auto">
												<?=wp_kses_post($title);?>
											</div>
										</div>
									</a>
									<div class="accordion-content p" data-tab-content id="<?=sanitize_title($title);?>">
										<div class="grid-x">
											<div class="cell shrink">
												<strong>A:</strong>
											</div>
											<div class="cell auto">
												<?=wp_kses_post($content);?>
											</div>
										</div>
									</div>
								</li>
								
								<?php else:

									get_template_part( 'template-parts/content', 'search' );	
								
								endif;
								
							endwhile;
							
							if( $post_type == 'expert-qa' ):?>
							
									</ul>
								</div>
							
							<?php endif;
							
							the_posts_navigation();
				
						else :
				
							get_template_part( 'template-parts/content', 'none' );
				
						endif;
						?>
						
					</div>
				</div>	
			</div>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
