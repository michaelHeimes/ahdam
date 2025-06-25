<?php
/**
 * Template name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$nm_banner_heading = $fields['nm_banner_heading'] ?? null;
$nm_banner_text = $fields['nm_banner_text'] ?? null;
$nm_banner_button_link_1 = $fields['nm_banner_button_link_1'] ?? null;
$nm_banner_button_link_2 = $fields['nm_banner_button_link_2'] ?? null;
$nm_banner_graphic = $fields['nm_banner_graphic'] ?? null;
$nm_banner_cta_rows = $fields['nm_banner_cta_rows'] ?? null;

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if( $nm_banner_heading || $nm_banner_text || $nm_banner_graphic || $nm_banner_cta_rows ):?>
						<header class="entry-header home-banner">
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<?php if( $nm_banner_heading || $nm_banner_text || $nm_banner_button_link_1 || $nm_banner_button_link_2 ):?>
										<div class="left cell small-12 medium-4 large-4 grid-x align-middle">
											<div>
												<?php if( $nm_banner_heading ):?>
													<h1 class="color-white">
														<?=wp_kses_post($nm_banner_heading);?>
													</h1>
												<?php endif;?>
												<?php if( $nm_banner_text ):?>
													<p class="p-3 color-white">
														<?=wp_kses_post($nm_banner_text);?>
													</p>
												<?php endif;?>
												<?php if( $nm_banner_button_link_1 || $nm_banner_button_link_2 ) {
													get_template_part('template-parts/part', 'btn-group',
														array(
															'btn1' => $nm_banner_button_link_1,
															'btn1-classes' => '',
															'btn2' => $nm_banner_button_link_2,
															'btn2-classes' => 'white-outline',
														),
													);
												};?>
											</div>
										</div>
									<?php endif;?>
									<?php if( $nm_banner_graphic ):?>
										<div class="middle cell small-12 large-auto grid-x align-middle">
											<?=wp_get_attachment_image( $nm_banner_graphic['id'], 'full' );?>
										</div>
									<?php endif;?>
									<?php if( $nm_banner_cta_rows ):?>
										<div class="right cell small-12 medium-4 grid-x align-bottom relative">
											<nav class="small-12">
												<ul class="menu vertical">
													<?php $count = count($nm_banner_cta_rows); $i = 1; foreach($nm_banner_cta_rows as $row):
														$icon = $row['icon'] ?? null;	
														$title = $row['title'] ?? null;	
														$text = $row['text'] ?? null;	
														$button_link = $row['button_link'] ?? null;
														$button_class = $row['button_class'] ?? null;	
													?>
														<li class="grid-x">
															<?php if( $icon ):?>
																<div class="icon-wrap cell shrink">
																	<div class="inner">
																		<?=wp_get_attachment_image( $icon['id'], 'full' );?>
																	</div>
																</div>
															<?php endif;?>
															<?php if( $title || $text ):?>
																<div class="cell auto">
																	<?php if( $title ):?>
																		<h2 class="h5">
																			<?=wp_kses_post($title );?>
																		</h2>
																	<?php endif;?>
																	<?php if( $text ):?>
																		<p class="p-2">
																			<?=wp_kses_post($text );?>
																		</p>
																	<?php endif;?>
																</div>
															<?php endif;?>
															<?php if( $button_link ):?>
																<div class="cell auto">
																	<?php get_template_part('template-parts/part', 'btn-link',
																		array(
																			'link' => $button_link, 
																			'classes' => $button_class . ' small-12',
																		),
																	);?>	
																</div>															
															<?php endif;?>
															<?php if( $count !== $i ):?>
																<hr class="small-12">
															<?php endif;?>
														</li>
													<?php $i++; endforeach;?>
												</ul>
											</nav>
										</div>
									<?php endif;?>
								</div>
							</div>
						</header><!-- .entry-header -->
					<?php endif;?>
					<section class="entry-content" itemprop="text">
						<?php the_content(); ?>
					</section> <!-- end article section -->
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();