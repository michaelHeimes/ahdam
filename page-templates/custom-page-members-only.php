<?php
if(!defined('ABSPATH')) {
	exit;
}
/**
 * Template name: Member's Only Page
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
						<div class="grid-x grid-padding-x align-center entry-content">
							<div class="cell small-12 xlarge-10">
								<?php get_template_part('template-parts/part', 'members-only-content');?>
							</div>
						</div>
					</div>
					
				</article>
			</main>
			
		</div>
	</div>

<?php
get_footer();