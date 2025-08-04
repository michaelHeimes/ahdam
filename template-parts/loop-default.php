<?php
$thumbnail_id = get_post_thumbnail_id();
$gated = get_field('gated');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('relative cell archive-card default'); ?> role="article">
	<?php if( $thumbnail_id ):?>
		<div class="thumb-wrap br-10 overflow-hidden grid-x align-justify bg-black relative z-1">
			<?=wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );?>
			<div class="date-wrap cell shrink grid-x relative z-1">
				<div class="date text-center">
					<div class="month h6 uppercase">
					</div>
					<div class="day h2">
					</div>
				</div>
			</div>
			<?php if( $gated && !is_user_logged_in() ) {
				get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
			};?>
		</div>
	<?php endif;?>
	<div class="title">
		<?php get_template_part('template-parts/content', 'byline-title');?>
	</div>
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
