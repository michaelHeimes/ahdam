<?php
$fields = get_fields();
$banner_alt_title = $fields['banner_alt_title'] ?? null;
$banner_text = $fields['banner_text'] ?? null;
$banner_image_id = '';
$thumbnail_id = get_post_thumbnail_id();
$banner_image = $fields['banner_image'] ?? null;
if( $banner_image ) {
   $banner_image_id = $banner_image['id'] ?? null;
} elseif($thumbnail_id) {
   $banner_image_id = $thumbnail_id ?? null;;
}
?>
<header class="entry-header page-banner">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-middle">
			<div class="left cell small-12 medium-7">
				<div class="inner">
					<?php if( $banner_alt_title ):?>
						<h1><?=wp_kses_post($banner_alt_title);?></h1>
					<?php else:?>
						<h1><?php the_title();?></h1>
					<?php endif;?>
					<?php if( $banner_text ):?>
						<p class="h3">
							<b><?=wp_kses_post($banner_text);?></b>
						</p>
					<?php endif;?>
				</div>
			</div>
			<?php if( $banner_image_id ):?>
				<div class="right cell small-12 medium-5">
					<div class="img-wrap">
						<?=wp_get_attachment_image( $banner_image_id, 'large' ); ?>
					</div>
				</div>
			<?php endif;?>
			<div class="cell small-12">
				<hr class="m-0">
			</div>
		</div>
	</div>
</header>