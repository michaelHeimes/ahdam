<?php
$webinar_date = get_field('webinar_date') ?? null;	
if( $webinar_date  ) {
	$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
}
$thumbnail_id = get_post_thumbnail_id();
$host_images = get_field('host_images') ?? null;
$gated = get_field('gated');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('relative cell archive-card'); ?> role="article">
	<?php if( $host_images || $webinar_date ):?>
		<div class="thumb-date-wrap br-10 overflow-hidden grid-x align-justify bg-black relative z-1 h-100">
			<div class="date-wrap cell small-12 grid-x flex-dir-column relative z-1">
				<div class="date">
					<div class="month h6 uppercase">
						<?=$date->format( 'M' ); ?>
					</div>
				</div>
				<div class="title">
					<h3 class="h6 m-0">
						<?php the_title();?>
					</h3>
				</div>
			</div>
			<?php if( $gated && !is_user_logged_in() ) {
				get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
			};?>
		</div>
	<?php endif;?>
	<?php if( $gated && !is_user_logged_in() ):?>
		<button class="reveal-trigger absolute-link-trigger z-1" data-open="gated-content-alert">
			<span class="show-for-sr">
				This triggers a modal that informs the user that the content is gated and how to Join and gain access.
			</span>
		</button>
	<?php else:?>
		<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
	<?php endif;?>
</article>
