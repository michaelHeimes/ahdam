<?php 
$gated = get_field('gated');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('relative cell archive-card'); ?> role="article">
	<?php if( $gated && !is_user_logged_in() ):?>
		<button class="reveal-trigger absolute-link-trigger z-1" data-open="gated-content-alert">
			<span class="show-for-sr">
				This triggers a modal that informs the user that the content is gated and how to Join and gain access.
			</span>
		</button>
	<?php else:?>
		<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
	<?php endif;?>
	<h3 class="h5"><?php the_title();?></h3>
</article>