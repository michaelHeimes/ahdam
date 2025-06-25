<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $header_logo = get_field('header_logo', 'option') ?? null;
 $ask_the_experts = get_field('ask_the_experts', 'option') ?? null;
?>

<div class="top-bar-wrap grid-container relative">

	<div class="top-bar" id="top-bar-menu">
	
		<div class="top-bar-left float-left">
			
			<div class="site-branding show-for-sr">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$trailhead_description = get_bloginfo( 'description', 'display' );
				if ( $trailhead_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $trailhead_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			
			<?php if( $header_logo ):?>
				<ul class="menu">
					<li class="logo">
						<a href="<?php echo home_url(); ?>" rel="home">
							<?=wp_get_attachment_image(  $header_logo['id'], 'full');?>
						</a>
					</li>
				</ul>
			<?php endif;?>
						
		</div>
		<div class="top-bar-right show-for-tablet">
			<div class="grid-x align-right">
				<div class="cell shrink">
					<?php trailhead_top_nav();?>
				</div>
			</div>
		</div>
		<div class="menu-toggle-wrap top-bar-right float-right hide-for-tablet">
			<ul class="menu">
				<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
				<li><a id="menu-toggle" data-toggle="off-canvas"><span></span><span></span><span></span></a></li>
			</ul>
		</div>
	</div>
	<?php if( $ask_the_experts ):
		$icon = $ask_the_experts['icon'] ?? null; 	
		$link = $ask_the_experts['link'] ?? null; 	
		if( $link ):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
	?>
		<a class="ask-experts-cta uppercase bg-violet color-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
			<?php if($icon) {
				echo wp_get_attachment_image( $icon['id'], 'full' );
			};?>
			<b><?php echo esc_html( $link_title ); ?></b>
		</a>

	<?php endif; endif;?>
</div>
