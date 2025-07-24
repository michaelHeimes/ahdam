<?php
/**
 * Template name: Webinars Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
?>
	<div class="content">
		<div class="inner-content">
		
			<main id="primary" class="site-main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="grid-container">
					
						<?php get_template_part('template-parts/part', 'page-banner');?>
					
						<div class="grid-x grid-padding-x align-center">
							<div class="cell small-12 xlarge-10">
								<h2 class="h6">
									Upcoming
								</h2>
								<?php if ( have_posts() ) :
						
									echo do_shortcode('[ajax_load_more 
										container_type="div"
										css_classes="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 large-up-4 xlarge-up-5 card-grid" 
										post_type="webinar" 
										posts_per_page="20" 
										order="ASC" 
										orderby="meta_value" 
										meta_key="webinar_date" 
										meta_compare=">=" 
										meta_value="' . date('Ymd') . '" 
										meta_type="CHAR" 
										scroll="false" 
										template="default"
									]');
						
								else :
						
									get_template_part( 'template-parts/content', 'none' );
						
								endif;
								?>
								
							</div>
						</div>
											
						<div class="grid-x grid-padding-x align-center">
							<div class="cell small-12 xlarge-10">
								<h2 class="h6">
									Archives
								</h2>
								<?php if ( have_posts() ) :
						
									echo do_shortcode('[ajax_load_more 
										container_type="div"
										css_classes="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 large-up-4 xlarge-up-5 card-grid" 
										post_type="webinar" 
										posts_per_page="20" 
										order="ASC" 
										orderby="meta_value" 
										meta_key="webinar_date" 
										meta_compare="&lt;" 
										meta_value="' . date('Ymd') . '" 
										meta_type="CHAR" 
										scroll="false" 
										template="default"
									]');
						
								else :
						
									get_template_part( 'template-parts/content', 'none' );
						
								endif;
								?>
								
							</div>
						</div>
						
					</div>
					
				</article>
			</main>
			
		</div>
	</div>

<?php
get_footer();