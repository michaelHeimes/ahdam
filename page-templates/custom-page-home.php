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

$today = current_time('Ymd'); // get today's date in Ymd format in WP timezone

$upcoming_webinar_args = array(
	'post_type'      => 'webinar',
	'posts_per_page' => -1,
	'meta_key'       => 'webinar_date',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'     => 'webinar_date',
			'value'   => $today,
			'compare' => '>',
			'type'    => 'CHAR'
		)
	)
);
$upcoming_webinar_query = new WP_Query( $upcoming_webinar_args );

$latest_webinar_args = array(
	'post_type'      => 'webinar',
	'posts_per_page' => 4,
	'meta_key'       => 'webinar_date',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'     => 'webinar_date',
			'value'   => $today,
			'compare' => '<',
			'type'    => 'CHAR'
		)
	)
);
$latest_webinar_query = new WP_Query( $latest_webinar_args );
$events_args = array(
	'post_type'      => 'event',
	'posts_per_page' => 2,
	'meta_key'       => 'event_date',
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key'     => 'event_date',
			'value'   => $today,
			'compare' => '>',
			'type'    => 'CHAR'
		)
	)
);
$events_query = new WP_Query( $events_args );

$news_args = array(
	'post_type'      => 'news',
	'posts_per_page' => 3,
	'orderby'        => 'meta_value',
	'order'          => 'ASC',
);
$news_query = new WP_Query( $news_args );

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
										<div class="left cell small-12 medium-4 large-auto grid-x align-middle">
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
										<div class="right cell small-12 medium-4 large-auto grid-x align-bottom relative">
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
																		<p>
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
						<?php if ( $upcoming_webinar_query->have_posts() || $latest_webinar_query->have_posts() ) :?>
							<section class="webinars home-cpt-row">
								<div class="grid-container">
									<div class="header grid-x grid-padding-x">
										<div class="cell shrink title-wrap">
											<h2 class="m-0 h4">Webinars</h2>
										</div>
										<div class="cell auto hr-wrap">
											<hr>
										</div>
									</div>
									<div class="body grid-x grid-padding-x">
										<?php if ( $upcoming_webinar_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-3">
												<div class="title h6 uppercase">
													Upcoming
												</div>
												<?php while ( $upcoming_webinar_query->have_posts() ) : $upcoming_webinar_query->the_post(); 
													$webinar_date = get_field('webinar_date') ?? null;	
													if( $webinar_date  ) {
														$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
													}
												?>
													<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray'); ?> role="article">
														<a href="<?=get_the_permalink();?>" class="grid-x color-black">
															<?php if( $webinar_date ):?>
																<div class="cell shrink date bg-violet color-white text-center grid-x flex-dir-column align-middle align-center">
																	<div class="month h6 uppercase">
																		<?=$date->format( 'M' ); ?>
																	</div>
																	<div class="day h2 m-0">
																		<?=$date->format( 'd' ); ?>
																	</div>
																</div>
																<div class="cell auto title grid-x align-middle">
																	<h3 class="h6 m-0">
																		<?php the_title();?>
																	</h3>
																</div>
															<?php endif;?>
														</a>
													</article>
												<?php endwhile;?>
											</div>
										<?php endif;?>
										<?php if ( $latest_webinar_query->have_posts() ) :?>
											<div class="home-cpt-main cell small-12 medium-9">
												<div class="title h6 uppercase">
													Latest
												</div>
												<div class="card-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-4">
													<?php while ( $latest_webinar_query->have_posts() ) : $latest_webinar_query->the_post(); 
														$webinar_date = get_field('webinar_date') ?? null;	
														if( $webinar_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
														}
														$thumbnail_image = get_field('thumbnail_image') ?? null;
													?>
														<article id="post-<?php the_ID(); ?>" <?php post_class('cell'); ?> role="article">
															<a class="relative color-black" href="<?=esc_url(get_the_permalink());?>">
																<?php if( $thumbnail_image || $webinar_date ):?>
																	<div class="thumb-date-wrap has-object-fit-img bg-black">
																		<?php if( $thumbnail_image ) {
																			echo wp_get_attachment_image( $thumbnail_image['id'], 'large', false, [ 'class' => 'img-fill' ] );
																		};?>
																		<div class="date-live-wrap grid-x z-1">
																			<div class="date cell shrink text-center">
																				<div class="month h6 uppercase">
																					<?=$date->format( 'M' ); ?>
																				</div>
																				<div class="day h2">
																					<?=$date->format( 'd' ); ?>
																				</div>
																			</div>
																			<div class="live uppercase cell auto text-right">
																				<span class="bg-pink">Live</span>
																			</div>
																		</div>
																	</div>
																	<div class="title">
																		<h3 class="h6 m-0">
																			<?php the_title();?>
																		</h3>
																	</div>
																<?php endif;?>
															</a>
														</article>
													<?php endwhile;?>
												</div>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						
						
						
						<?php if ( $events_query->have_posts() || $news_query->have_posts() ) :?>
							<section class="events-news home-cpt-row">
								<div class="grid-container">
									<div class="body grid-x grid-padding-x">
										<?php if ( $events_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-3">
												<div class="header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h4">Events</h2>
													</div>
													<div class="cell auto hr-wrap">
														<hr>
													</div>
												</div>
												<?php while ( $events_query->have_posts() ) : $events_query->the_post(); 
													$event_date = get_field('cpt_event_date') ?? null;	
													if( $event_date ) {
														$date = DateTime::createFromFormat( 'Ymd', $event_date );
													}
												?>
													<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray'); ?> role="article">
														<a href="<?=get_the_permalink();?>" class="grid-x color-black">
															<?php if( $webinar_date ):?>
																<div class="cell shrink date bg-violet color-white text-center grid-x flex-dir-column align-middle align-center">
																	<div class="month h6 uppercase">
																		<?=$date->format( 'M' ); ?>
																	</div>
																	<div class="day h2 m-0">
																		<?=$date->format( 'd' ); ?>
																	</div>
																</div>
																<div class="cell auto title grid-x align-middle">
																	<h3 class="h6 m-0">
																		<?php the_title();?>
																	</h3>
																</div>
															<?php endif;?>
														</a>
													</article>
												<?php endwhile;?>
											</div>
										<?php endif;?>
										<?php if ( $news_query->have_posts() ) :?>
											<div class="home-cpt-main news-row cell small-12 medium-9">
												<div class="header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h4">News</h2>
													</div>
													<div class="cell auto hr-wrap">
														<hr>
													</div>
												</div>
												<div class="card-grid grid-x grid-padding-x">
													<div class="cell small-12 medium-4">
														<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
															$thumbnail_id = get_post_thumbnail_id(); 
														?>
																
															<?php if( $i == 1 ):?>
																<article id="post-<?php the_ID(); ?>" <?php post_class('featured'); ?> role="article">
																	<a class="relative color-black" href="<?=esc_url(get_the_permalink());?>">
																		<?php if( $thumbnail_image ):?>
																			<div class="thumb-date-wrap has-object-fit-img bg-black">
																				<?php if( $thumbnail_image ) {
																					echo wp_get_attachment_image( $thumbnail_image, 'large', false, [ 'class' => 'img-fill' ] );
																				};?>
																			</div>
																		<?php endif;?>
																		<?php the_title();?>
																	</a>
																</article>
															<?php endif;?>
															
														<?php $i++; endwhile;?>
													</div>
													<div class="cell small-12 medium-8">
														<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
															$thumbnail_id = get_post_thumbnail_id(); 
														?>
													
															<?php if( $i >= 2 ):?>
																<article id="post-<?php the_ID(); ?>" <?php post_class('stacked'); ?> role="article">
																	<a class="relative grid-x grid-padding-x color-black" href="<?=esc_url(get_the_permalink());?>">
																		<?php if( $thumbnail_image ):?>
																			<div class="thumb-wrap cell shrink relative">
																				<?php if( $thumbnail_image ) {
																					echo wp_get_attachment_image( $thumbnail_image, 'large', false, [ 'class' => 'img-fill' ] );
																				};?>
																			</div>
																		<?php endif;?>
																		<div class="cell auto">
																			<?php the_title();?>
																		</div>
																	</a>
																</article>
															<?php endif;?>
													
														<?php $i++; endwhile;?>
													</div>
												</div>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						
						
						
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