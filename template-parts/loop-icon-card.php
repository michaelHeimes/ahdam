<?php
$post_type = get_post_type();
$policy_procedures_icon = get_field('policy_procedures_icon', 'option') ?? null;
$template_icon = get_field('template_icon', 'option') ?? null;
$tip_sheet_icon = get_field('tip_sheet_icon', 'option') ?? null;

$icon = '';
$bg_class = '';

if( $post_type == 'policy-and-procedure' ) {
	$icon = $policy_procedures_icon;
	$bg_class = 'bg-sky-blue';
}

if( $post_type == 'template' ) {
	$icon = $template_icon;
	$bg_class = 'bg-pink';
}

if( $post_type == 'tip-sheet' ) {
	$icon = $tip_sheet_icon;
	$bg_class = 'bg-violet';
}

$gated = get_field('gated');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('relative overflow-hidden cell archive-card icon-card'); ?> role="article">
	<div class="grid-x h-100<?php if( $icon ):?> br-10 overflow-hidden<?php endif;?>">
		<?php if( $icon ):?>
			<div class="cell small-3 h-100">
				<div class="icon-wrap h-100 grid-x align-center <?=$bg_class;?>">
					<?=wp_get_attachment_image( $icon['id'], 'medium' );?>
				</div>
			</div>
		<?php endif;?>
		<div class="cell auto h-100 bg-light-gray h-100 grid-x align-middle">
			<h3 class="p weight-400<?php if( !$icon ):?> br-10<?php endif;?>">
				<?php the_title();?>
			</h3>
		</div>
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
