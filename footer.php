<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
$footer_logo = get_field('footer_logo', 'option') ?? null;
?>

				<footer id="colophon" class="site-footer">
					<div class="site-info">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="cell small-12">
									
									<?php if( $footer_logo ):?>
										<ul class="menu">
											<li class="logo">
												<a href="<?php echo home_url(); ?>" rel="home">
													<?=wp_get_attachment_image(  $footer_logo['id'], 'full');?>
												</a>
											</li>
										</ul>
									<?php endif;?>

									<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_s' ) ); ?>">
										<?php
										/* translators: %s: CMS name, i.e. WordPress. */
										printf( esc_html__( 'Proudly powered by %s', '_s' ), 'WordPress' );
										?>
									</a>
									<span class="sep"> | </span>
										<?php
										/* translators: 1: Theme name, 2: Theme author. */
										printf( esc_html__( 'Theme: %1$s by %2$s.', '_s' ), '_s', '<a href="https://automattic.com/">Automattic</a>' );
										?>
								</div>
							</div>
						</div>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

</body>
</html>
