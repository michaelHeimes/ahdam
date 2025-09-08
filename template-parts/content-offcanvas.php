<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $ask_the_experts = get_field('header_ask_the_experts', 'option') ?? null;
 $login = get_field('header_login', 'option') ?? null;
 $join = get_field('header_join', 'option') ?? null;
 $training_center = get_field('header_training_center', 'option') ?? null;
 $header_member_dashboard = get_field('header_member_dashboard', 'option') ?? null;
?>

<div class="off-canvas position-right" id="off-canvas" data-off-canvas style="display: none;">

	<div class="inner">
		<?php if( is_user_logged_in() ):?>
			<?php if( $training_center ||  $header_member_dashboard ) :?>
				<div class="cell small-12">
					<?php get_template_part('template-parts/part', 'btn-group',
						array(
							'flex-classes' => 'align-middle member align-justify',
							'btn1' =>  $training_center ,
							'btn1-classes' => '',
							'btn2' => $header_member_dashboard,
							'btn2-classes' => 'yellow no-arrow',
							'icon2' => '<svg width="20" height="23" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="m224 256a128 128 0 1 0 0-256 128 128 0 1 0 0 256zm-45.7 48c-98.5 0-178.3 79.8-178.3 178.3 0 16.4 13.3 29.7 29.7 29.7h388.6c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3z" fill="#050D57"/></svg>',
						),
					);?>
				</div>
			<?php endif;?>
			
			<?php trailhead_top_nav_member();?>
			
		<?php else:?>
			
			<?php if( $login || $join ):?>
				<div class="cell small-12">
					<?php get_template_part('template-parts/part', 'btn-group',
							array(
								'flex-classes' => 'non-member',
								'btn1' => $login,
								'btn1-classes' => 'navy-outline',
								'btn2' => $join,
								'btn2-classes' => 'yellow',
							),
						);
					;?>
				</div>
			<?php endif;?>
			
			<?php trailhead_top_nav_non_member();?>
			
		<?php endif;?>
		
		<?php if( $ask_the_experts ):
			$icon = $ask_the_experts['icon'] ?? null; 	
			$link = $ask_the_experts['link'] ?? null; 	
			if( $link ):
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
		?>
			<a class="ask-experts-cta uppercase bg-blue color-white text-center" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<?php if($icon) {
					echo wp_get_attachment_image( $icon['id'], 'full' );
				};?>
				<b><?php echo esc_html( $link_title ); ?></b>
			</a>
		
		<?php endif; endif;?>
		
	</div>	

</div>
