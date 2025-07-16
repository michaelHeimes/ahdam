<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $ask_the_experts = get_field('header_ask_the_experts', 'option') ?? null;
 $login = get_field('header_login', 'option') ?? null;
 $join = get_field('header_join', 'option') ?? null;
?>

<div class="off-canvas position-right" id="off-canvas" data-off-canvas style="display: none;">

	<div class="inner">
		
		<?php if( $login || $join ):?>
			<div class="cell small-12">
				<?php if( $login  || $join ) {
					get_template_part('template-parts/part', 'btn-group',
						array(
							'btn1' => $login,
							'btn1-classes' => 'black-outline',
							'btn2' => $join,
							'btn2-classes' => 'violet',
						),
					);
				};?>
			</div>
		<?php endif;?>
	
		<?php trailhead_top_nav_non_member();?>
		
		<?php if( $ask_the_experts ):
			$icon = $ask_the_experts['icon'] ?? null; 	
			$link = $ask_the_experts['link'] ?? null; 	
			if( $link ):
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
		?>
			<a class="ask-experts-cta uppercase bg-violet color-white hide-for-large text-center" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<?php if($icon) {
					echo wp_get_attachment_image( $icon['id'], 'full' );
				};?>
				<b><?php echo esc_html( $link_title ); ?></b>
			</a>
		
		<?php endif; endif;?>
		
	</div>	

</div>
