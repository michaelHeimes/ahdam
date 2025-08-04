<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package trailhead
 */

get_header();

$post_type = get_post_type();

$policy_procedures_icon = get_field('policy_procedures_icon', 'option') ?? null;
$template_icon = get_field('template_icon', 'option') ?? null;
$tip_sheet_icon = get_field('tip_sheet_icon', 'option') ?? null;

$date = '';
$post_type_tag  = '';

if( $post_type === 'event' ) {
	$post_type_tag = 'Event';
	$event_date = get_field('event_date') ?? null;
	if( $event_date  ) {
		$date_raw = DateTime::createFromFormat( 'Ymd', $event_date );
		$date = $date_raw->format( 'm.d.Y' );	
	}
}

if( $post_type === 'news' ) {
	$post_type_tag = 'News';
	$date = get_the_date('m.d.Y');
	$author_name = get_field('news_author') ?? null;
}

if( $post_type === 'podcast' ) {
	$post_type_tag = 'Podcast';
	$podcast_date = get_field('podcast_date') ?? null;
	if( $podcast_date  ) {
		$date_raw = DateTime::createFromFormat( 'Ymd', $podcast_date );
		$date = $date_raw->format( 'm.d.Y' );	
	}
}

if( $post_type === 'webinar' ) {
	$post_type_tag = 'Webinar';
	$webinar_date = get_field('webinar_date') ?? null;
	if( $webinar_date  ) {
		$date_raw = DateTime::createFromFormat( 'Ymd', $webinar_date );
		$date = $date_raw->format( 'm.d.Y' );	
	}
}

$newsletter_post_disclaimer = get_field('newsletter_post_disclaimer', 'option') ?? null;

$banner_img_type = '';
$thumbnail_id = '';
$bg_class = 'bg-black';

if( $post_type === 'policy-and-procedure' ) {
	$banner_img_type = 'icon-banner';
	$thumbnail_id = $policy_procedures_icon['id'] ?? null;
	$bg_class = 'bg-sky-blue';
} else if( $post_type === 'template' ){
	$banner_img_type = 'icon-banner';
	$thumbnail_id = $template_icon['id'] ?? null;
	$bg_class = 'bg-pink';
} else if( $post_type === 'tip-sheet' ){
	$banner_img_type = 'icon-banner';
	$thumbnail_id = $tip_sheet_icon['id'] ?? null;
	$bg_class = 'bg-violet';
} else {
	$thumbnail_id = get_post_thumbnail_id() ?? null;
}

?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<?php
			while ( have_posts() ) :
				the_post();?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('grid-x grid-padding-x align-center'); ?>>
					<header class="entry-header cell small-12<?php if( !$thumbnail_id ) { echo ' no-thumb'; };?>  <?=$banner_img_type;?>">
						<div class="bg-light-gray">
							<div class="grid-x grid-padding-x align-center">
								<?php if( $thumbnail_id ):?>
									<div class="cell small-12 medium-4">
										<div class="thumb-wrap has-object-fit-img <?=$bg_class;?> h-100 grid-x align-middle align-center">
											<?=wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );?>
											<?php if( $post_type === 'news' || $post_type === 'webinar' || $post_type === 'podcast' ):?>
												<div class="tag h6 color-white">
													<b><?=esc_html($post_type_tag);?></b>
												</div>
											<?php endif;?>
										</div>
									</div>
								<?php endif;?>
								<div class="cell medium-8">
									<div class="text-wrap">
										<div class="date">
											<?=$date;?>
										</div>
										<h1><?php the_title();?></h1>
										<?php if( $post_type === 'news' && $author_name ):?>
											<div class="h3">
												<?=wp_kses_post($author_name);?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
					</header><!-- .entry-header -->
								
					<div class="entry-content cell small-12">
						<div class="grid-x grid-padding-x align-center">
							<div class="ec-inner cell small-12 tablet-10 xlarge-9">
								<?php
								the_content(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									)
								);
								?>
								<?php if( $post_type === 'newsletter' && $newsletter_post_disclaimer ):?>
									<div class="disclaimer">
										<hr>
										<?=wp_kses_post($newsletter_post_disclaimer);?>
									</div>
								<?php endif;?>
							</div>
						</div>
					</div><!-- .entry-content -->
				
					<footer class="entry-footer">
						<?php trailhead_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-<?php the_ID(); ?> -->
	
			<?php endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
