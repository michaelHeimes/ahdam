<?php
$thumbnail_id = get_post_thumbnail_id() ?? null;
$gated = get_field('gated');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('relative cell archive-card'); ?> role="article">
	<?php if( $thumbnail_id || $webinar_date ):?>
		<div class="thumb-icon-wrap has-object-fit-img bg-black">
			<?php if( $thumbnail_id ) {
				echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
			};?>
			<div class="date-live-wrap grid-x relative z-1 align-right">
				<div class="pod-icon uppercase cell auto text-right">
					<svg width="31" viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg"><circle cx="15.5" cy="15.5" r="15.5" fill="#211CD1"/><path fill="#fff" d="M16.15 18.57c1.62-.07 2.86-1.5 2.86-3.15v-5.26c0-1.65-1.24-3.08-2.86-3.15-1.72-.08-3.14 1.32-3.14 3.06v5.45c0 1.74 1.42 3.14 3.14 3.06zM22 15.3v-1.92a.55.55 0 0 0-.54-.55h-.56a.57.57 0 0 0-.56.58v1.78c0 2.4-1.82 4.45-4.17 4.54-2.46.09-4.49-1.93-4.49-4.42v-2.05a.57.57 0 0 0-.56-.58h-.52a.59.59 0 0 0-.58.6v2.03c0 3.09 2.25 5.64 5.16 6.06v1.93h-3.39c-.29 0-.52.24-.52.53v.65c0 .29.23.52.51.52h8.27c.3 0 .55-.25.55-.56v-.63a.5.5 0 0 0-.5-.51h-3.24v-1.93c2.91-.42 5.16-2.97 5.16-6.06z"/></svg>
				</div>
			</div>
			<?php if( $gated && !is_user_logged_in() ) {
				get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
			};?>
		</div>
		<div class="title">
			<h3 class="h6 m-0">
				<?php the_title();?>
			</h3>
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
