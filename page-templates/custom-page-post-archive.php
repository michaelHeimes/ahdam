<?php
/**
 * Template name: Post Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$content = get_the_content();
$post_type_to_show = get_field('post_type_to_show') ?? null;
?>
	<div class="content archive-<?=sanitize_title($post_type_to_show);?>">
		<div class="inner-content">
		
			<main id="primary" class="site-main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="grid-container">
					
						<?php get_template_part('template-parts/part', 'page-banner');?>
						
						<?php if (has_blocks(get_the_ID()) || trim(strip_tags($content)) !== '') :?>
							<div class="grid-x grid-padding-x align-center entry-content">
								<div class="cell small-12 xlarge-10">
									<div class="wp-block-content-wrap">
										<?php the_content();?>
									</div>
								</div>
							</div>
						<?php endif;?>
					
						<?php if( $post_type_to_show  == 'webinar' ):?>
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
									<h2 class="h6">
										Upcoming
									</h2>
									<?php echo do_shortcode('[ajax_load_more 
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
										]');?>
									
								</div>
							</div>
						<?php endif;?>
											
						<div class="grid-x grid-padding-x align-center">
							<div class="cell small-12 xlarge-10">
								
								<?php if( $post_type_to_show  == 'webinar' ):?>
									<h2 class="h6">
										Archives
									</h2>
									<?php echo do_shortcode('[ajax_load_more 
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
										]');?>
								<?php else:?>
									
									<?php echo do_shortcode('[ajax_load_more 
										container_type="div"
										css_classes="grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 large-up-4 xlarge-up-5 card-grid" 
										post_type="' . $post_type_to_show . '" 
										posts_per_page="20" 
										meta_type="CHAR" 
										scroll="false" 
										template="default"
									]');?>
									
								<?php endif;?>
							</div>
						</div>
						
					</div>
					
				</article>
			</main>
			
		</div>
	</div>

<?php
get_footer();