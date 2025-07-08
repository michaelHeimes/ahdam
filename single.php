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
	$author_name = get_the_author();
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

$thumbnail_id = get_post_thumbnail_id();
?>

	<main id="primary" class="site-main">
		<div class="grid-container">
			<?php
			while ( have_posts() ) :
				the_post();?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('grid-x grid-padding-x align-center'); ?>>
					<header class="entry-header cell small-12<?php if( !$thumbnail_id ) { echo ' no-thumb'; };?>">
						<div class="bg-light-gray">
							<div class="grid-x grid-padding-x align-center">
								<?php if( $thumbnail_id ):?>
									<div class="cell small-12 medium-4">
										<div class="thumb-wrap has-object-fit-img bg-black h-100">
											<?=wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );?>
											<div class="tag h6 color-white">
												<b><?=esc_html($post_type_tag);?></b>
											</div>
										</div>
									</div>
								<?php endif;?>
								<div class="cell medium-8">
									<div class="text-wrap">
										<div class="date">
											<?=$date;?>
										</div>
										<h1><?php the_title();?></h1>
										<?php if( $post_type === 'news' ):?>
											<div class="h3">
												By <?=esc_html( get_the_author() );?>
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
