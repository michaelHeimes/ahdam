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
 $mailing_list_heading = get_field('mailing_list_heading', 'option') ?? null;
 $mailing_list_text = get_field('mailing_list_text', 'option') ?? null;
 $mailing_list_form_id = get_field('mailing_list_form_id', 'option') ?? null;
 $footer_logo = get_field('footer_logo', 'option') ?? null;
 $footer_about_heading = get_field('footer_about_heading', 'option') ?? null;
 $footer_about_text = get_field('footer_about_text', 'option') ?? null;
 $footer_address = get_field('footer_address', 'option') ?? null;
 $footer_directions = get_field('footer_directions', 'option') ?? null;
 $footer_information_links = get_field('footer_information_links', 'option') ?? null; 
?>
	<div class="reveal large" id="gated-content-alert" data-reveal>
		<?php get_template_part('template-parts/part', 'members-only-content');?>
	</div>

				<footer id="colophon" class="site-footer bg-black">
					<div class="site-info">
						<div class="grid-container">
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12 xlarge-10">
									<?php if( $mailing_list_heading || $mailing_list_text || $mailing_list_form_id ):?>
										<div class="form">
											<?php if( $mailing_list_heading ):?>
												<h2><?=wp_kses_post($mailing_list_heading);?></h2>
											<?php endif;?>
											<?php if( $mailing_list_text ):?>
												<div class="text-wrap">
													<?=wp_kses_post($mailing_list_text);?>
												</div>
											<?php endif;?>
											<?php if( $mailing_list_form_id ):?>
												<div class="form-wrap">
													<?php gravity_form( $mailing_list_form_id, false, false, false, '', true, '' ); ?>
												</div>
											<?php endif;?>
										</div>
									<?php endif;?>
									
									<div class="grid-x grid-padding-x">
										<?php if( $footer_logo ):?>
											<div class="cell small-12 medium-5">
												<ul class="menu">
													<li class="logo">
														<a href="<?php echo home_url(); ?>" rel="home">
															<?=wp_get_attachment_image(  $footer_logo['id'], 'full');?>
														</a>
													</li>
												</ul>
												<?php if( $footer_about_heading || $footer_about_text ):?>
													<div class="footer-about">
														<?php if( $footer_about_heading ):?>
															<h2 class="h6"><?=wp_kses_post($footer_about_heading);?></h2>
														<?php endif;?>
														<?php if( $footer_about_text ):?>
															<div class="text-wrap">
																<?=wp_kses_post($footer_about_text);?>
															</div>
														<?php endif;?>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
										<div class="cell small-12 medium-7">
											<div class="grid-x grid-padding-x">
												<?php if( $footer_address || $footer_directions ):?>
													<div class="cell small-12 large-4">
														<h3 class="h6 uppercase color-pink">Location</h3>
														<?php if( $footer_directions ):?>
															<a class="color-white" href="<?=esc_url($footer_directions);?>" aria-label="Links to directions" target="_blank">
														<?php endif;?>
															<?php if( $footer_address ):?>
																<u><?=wp_kses_post($footer_address);?></u>
															<?php endif;?>
														<?php if( $footer_directions ):?>
															</a>
														<?php endif;?>
													</div>
												<?php endif;?>
												<div class="cell small-12 large-6">
													<?php trailhead_footer_navigation();?>
												</div>
											</div>
											<?php if( $footer_information_links || $footer_hours ):?>
												<div class="grid-x grid-padding-x">
													<?php if( $footer_information_links ):?>
														<div class="cell small-12 large-4">
															<h3 class="h6">Information</h3>
														</div>
													<?php endif;?>
													
												</div>
											<?php endif;?>
										</div>
									</div>
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
