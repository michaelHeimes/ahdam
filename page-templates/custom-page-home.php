<?php
if(!defined('ABSPATH')) {
	exit;
}
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

$m_banner_text = $fields['m_banner_text'] ?? null;
$m_banner_button_link = $fields['m_banner_button_link'] ?? null;
$m_banner_featured_ctas = $fields['m_banner_featured_ctas'] ?? null;

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
	'order'          => 'DESC',
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
);
$news_query = new WP_Query( $news_args );

$upcoming_podcast_args = array(
	'post_type'      => 'podcast',
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
$upcoming_podcast_query = new WP_Query( $upcoming_podcast_args );

$latest_podcast_args = array(
	'post_type'      => 'podcast',
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
$latest_podcast_query = new WP_Query( $latest_podcast_args );

$global_webinars_page = get_field('global_webinars_page', 'option') ?? null;
$global_events_page = get_field('global_events_page', 'option') ?? null;
$global_news_page = get_field('global_news_page', 'option') ?? null;
$global_podcasts_page = get_field('global_podcasts_page', 'option') ?? null;

$testimonials = $fields['testimonials'] ?? null;
$testimonials_title = $fields['testimonials_title'] ?? null;

$member_spotlight_posts = $fields['member_spotlight_posts'] ?? null;

$partnerships = $fields['partnerships'] ?? null;
$partnerships_page_link = $fields['partnerships_page_link'] ?? null;

$current_user_name = wp_get_current_user()->display_name;
$first_name = explode(' ', $current_user_name)[0];


?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<?php if( is_user_logged_in() ):?>
						
						<?php if( $m_banner_text || $m_banner_button_link || $m_banner_featured_ctas || $first_name ):?>
							<header class="entry-header home-banner member">
								<div class="grid-container">
									<div class="inner bg-light-gray br-10 overflow-hidden">
										<div class="grid-x grid-padding-x align-middle">
											<div class="left cell small-12 large-5">
												<div class="h1">Welcome <?=esc_html($first_name);?></div>
												<?php if( $m_banner_text ):?>
													<div class="h3"><?=wp_kses_post($m_banner_text);?></div>
												<?php endif;?>
												<?php if( $m_banner_button_link ) :?>
													<div class="btn-wrap">
														<?php get_template_part('template-parts/part', 'btn-link',
															array(
																'link' => $m_banner_button_link, 
																'classes' => 'black',
															),
														);?>	
													</div>
												<?php endif;?>
											</div>
											<?php if( $m_banner_featured_ctas ):?>
												<div class="right cell small-12 large-7">
													<div class="cards grid-x grid-padding-x align-center">
														<?php foreach($m_banner_featured_ctas  as $cta):
															$icon = $cta['icon'] ?? null;
															$title = $cta['title'] ?? null;
															$link = $cta['link'] ?? null;	
														?>
															<div class="card cell small-12 medium-4 text-center">
															<?php
															$is_link = $link && isset($link['url']);
															$link_url = $is_link ? $link['url'] : '';
															$link_title = $is_link ? $link['title'] : '';
															$link_target = $is_link && isset($link['target']) ? $link['target'] : '_self';
															?>
															
															<<?= $is_link ? 'a' : 'div'; ?>
																class="inner relative h-100 bg-white box-shadow-5-15-10 br-10 color-black grid-x flex-dir-column align-middle align-justify"
																<?= $is_link ? ' href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"' : ''; ?>
															>
																<div class="top">
																	<?php if( $icon ): ?>
																		<div class="icon-wrap" style="display: inline-block; max-width: 58px;">
																			<?= wp_get_attachment_image( $icon['id'], 'large', false, [ 'class' => 'style-svg' ] ); ?>
																		</div>
																	<?php endif; ?>
																
																	<?php if( $title ): ?>
																		<p class="p-2">
																			<b><?= wp_kses_post($title); ?></b>
																		</p>
																	<?php endif; ?>
																</div>
																<?php if( $is_link && $link_title ): ?>
																	<div class="learn-more h6" style="opacity: 0;">
																		<u><b><?= esc_html($link_title); ?></b></u>
																	</div>
																<?php endif; ?>
															</<?= $is_link ? 'a' : 'div'; ?>>
															</div>
														<?php endforeach;?>
													</div>
												</div>
											<?php endif;?>
										</div>
									</div>
								</div>
							</header>
						<?php endif;?>
						
					<?php else:?>
											
						<?php if( $nm_banner_heading || $nm_banner_text || $nm_banner_graphic || $nm_banner_cta_rows ):?>
							<header class="entry-header home-banner non-member">
								<div class="grid-container">
									<div class="grid-x grid-padding-x align-center">
										<?php if( $nm_banner_heading || $nm_banner_text || $nm_banner_button_link_1 || $nm_banner_button_link_2 ):?>
											<div class="left cell small-12 medium-6 large-auto grid-x align-middle">
												<div>
													<div class="grid-x align-center">
														<?php if( $nm_banner_heading ):?>
															<h1 class="color-white small-12 medium-11 medium-12">
																<?=wp_kses_post($nm_banner_heading);?>
															</h1>
														<?php endif;?>
														<?php if( $nm_banner_text ):?>
															<p class="p-3 color-white small-12 medium-11 medium-12">
																<?=wp_kses_post($nm_banner_text);?>
															</p>
														<?php endif;?>
													</div>
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
											<div class="middle cell small-12 medium-6 large-auto grid-x align-middle">
												<?=wp_get_attachment_image( $nm_banner_graphic['id'], 'full' );?>
											</div>
										<?php endif;?>
										<?php if( $nm_banner_cta_rows ):?>
											<div class="right cell small-12 medium-8 large-auto grid-x align-bottom relative">
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
						
					<?php endif;?>

					<section class="body" itemprop="text">
						<?php if ( $upcoming_webinar_query->have_posts() || $latest_webinar_query->have_posts() ) :?>
							<section class="webinars home-cpt-row" id="webinars">
								<div class="grid-container">
									<div class="section-header grid-x grid-padding-x">
										<div class="cell shrink title-wrap">
											<h2 class="m-0 h5">Webinars</h2>
										</div>
										<div class="cell auto hr-wrap">
											<hr>
										</div>
									</div>
									<div class="body grid-x grid-padding-x align-center">
										<?php if ( $upcoming_webinar_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-11 medium-5 tablet-4 xlarge-3" id="upcoming-webinars">
												<div class="grid-x card-grid">
													<div class="cell small-12">
														<div class="title h6 uppercase">
															Upcoming
														</div>
													</div>
													<?php while ( $upcoming_webinar_query->have_posts() ) : $upcoming_webinar_query->the_post(); 
														$webinar_date = get_field('webinar_date') ?? null;	
														if( $webinar_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
														}
														$gated = get_field('gated');
													?>
														<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-12'); ?> role="article">
															<div class="bg-light-gray relative h-100 br-10">
																<div class="grid-x color-black h-100">
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
																			<h3 class="h6 weight-400 m-0">
																				<?php the_title();?>
																			</h3>
																		</div>
																	<?php endif;?>
																</div>
																<?php if( $gated && !is_user_logged_in() ):?>
																	<button class="reveal-trigger z-1 absolute-link-trigger" data-open="gated-content-alert">
																		<?php get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');?>
																		<span class="show-for-sr">
																			This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																		</span>
																	</button>
																<?php else:?>
																	<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																<?php endif;?>
															</div>
														</article>
													<?php endwhile;?>
												</div>
											</div>
										<?php endif;?>
										<?php if ( $latest_webinar_query->have_posts() ) :?>
											<div class="home-cpt-main cell small-12 medium-11 medium-7 tablet-8 xlarge-9" id="latest-webinars">
												<div class="title h6 uppercase">
													Latest
												</div>
												<div class="card-grid grid-x small-up-1 medium-up-2 tablet-up-3 xlarge-up-4 pad-right">
													<?php $i = 1; while ( $latest_webinar_query->have_posts() ) : $latest_webinar_query->the_post(); 
														$webinar_date = get_field('webinar_date') ?? null;	
														if( $webinar_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
														}
														$thumbnail_id = get_post_thumbnail_id();
														$host_images = get_field('host_images') ?? null;
														$gated = get_field('gated');
													?>
														<div class="cell<?php if( $i > 1 ):?> show-for-medium<?php endif;?><?php if( $i > 2 ):?> show-for-tablet<?php endif;?><?php if( $i > 3 ):?> show-for-xlarge<?php endif;?>">
															<?php get_template_part('template-parts/loop', 'webinar');?>
														</div>
													<?php $i++; endwhile;?>
												</div>
												<?php if( $global_webinars_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_webinars_page);?>">
															View <span class="inline-icon-wrap">Webinars
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if ( $events_query->have_posts() || $news_query->have_posts() ) :?>
							<section class="events-news home-cpt-row" id="events-news">
								<div class="grid-container">
									<div class="body grid-x grid-padding-x align-center">
										<?php if ( $events_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-11 medium-5 tablet-4 xlarge-3" id="events">
												<div class="section-header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h5">Events</h2>
													</div>
													<div class="cell auto hr-wrap">
														<hr>
													</div>
												</div>
												<div class="grid-x card-grid">
													<?php while ( $events_query->have_posts() ) : $events_query->the_post(); 
														$event_date = get_field('cpt_event_date') ?? null;	
														if( $event_date ) {
															$date = DateTime::createFromFormat( 'Ymd', $event_date );
														}
														$gated = get_field('gated');
													?>
														<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-12'); ?> role="article">
															<div class="bg-light-gray relative h-100 br-10">
																<div class="grid-x color-black h-100">
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
																			<h3 class="h6 weight-400 m-0">
																				<?php the_title();?>
																			</h3>
																		</div>
																	<?php endif;?>
																</div>
																<?php if( $gated && !is_user_logged_in() ):?>
																	<button class="reveal-trigger z-1 absolute-link-trigger" data-open="gated-content-alert">
																		<div class="reveal-trigger-overlay grid-x align-middle align-center">
																			<svg width="31" height="31" viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg" fill="none">
																			<circle cx="15.5" cy="15.5" r="15.5" fill="#fff"/>
																			<path fill="#C84DFF" clip-path="url(#a)" d="M21.246 13.2h-.474v-1.94c0-2.9-2.59-5.26-5.77-5.26-3.181 0-5.77 2.36-5.77 5.26v1.94h-.475c-.97 0-1.757.718-1.757 1.602v7.596C7 23.284 7.787 24 8.757 24h12.486c.97 0 1.757-.717 1.757-1.602v-7.596c0-.884-.785-1.601-1.754-1.601Zm-5.508 5.504v.995c0 .15-.131.268-.296.268h-.884c-.162 0-.293-.121-.293-.268v-.995c-.403-.226-.673-.627-.673-1.09 0-.71.63-1.282 1.41-1.282.778 0 1.406.575 1.406 1.282 0 .46-.27.864-.67 1.09Zm2.504-5.504h-6.48v-1.94c0-1.63 1.451-2.954 3.24-2.954 1.787 0 3.24 1.324 3.24 2.954v1.94Z"/>
																			<defs>
																				<clipPath id="a">
																				<path d="M7 6h16v18H7z" fill="#fff"/>
																				</clipPath>
																			</defs>
																			</svg>
																		</div>
																		<span class="show-for-sr">
																			This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																		</span>
																	</button>
																<?php else:?>
																	<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																<?php endif;?>
															</div>
														</article>
													<?php endwhile;?>
												</div>
												<?php if( $global_events_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_events_page);?>">
															View <span class="inline-icon-wrap">Events
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
										<?php if ( $news_query->have_posts() ) :?>
											<div class="home-cpt-main news-row cell small-12 medium-11 medium-7 tablet-8 xlarge-9" id="news">
												<div class="section-header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h5">News</h2>
													</div>
													<div class="cell auto hr-wrap">
														<hr>
													</div>
												</div>
												<div class="grid-x grid-padding-x pad-right">
													<div class="cell small-12 large-8 show-for-xlarge">
														<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
															$thumbnail_id = get_post_thumbnail_id(); 
															$gated = get_field('gated');
														?>
																
															<?php if( $i == 1 ):?>
																<article id="post-<?php the_ID(); ?>" <?php post_class('featured relative h-100'); ?> role="article">
																	<div class="card-grid grid-x h-100">
																		<?php if( $thumbnail_id ):?>
																			<div class="cell small-12 large-6">
																				<div class="thumb-wrap has-object-fit-img bg-black h-100">
																					<?php if( $thumbnail_id ) {
																						echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
																					};?>
																					<?php if( $gated && !is_user_logged_in() ) {
																						get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																					};?>
																				</div>
																			</div>
																		<?php endif;?>
																		<div class="title-wrap cell small-12 large-6">
																			<?php get_template_part('template-parts/content', 'byline-title');?>
																			<?php if ( has_excerpt() ) : ?>
																				<div class="excerpt">
																					<?= esc_html( get_the_excerpt() ); ?>
																				</div>
																			<?php endif; ?>
																		</div>
																	</div>
																	<?php if( $gated && !is_user_logged_in() ):?>
																		<button class="reveal-trigger z-1 absolute-link-trigger" data-open="gated-content-alert">
																			<span class="show-for-sr">
																				This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																			</span>
																		</button>
																	<?php else:?>
																		<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																	<?php endif;?>
																</article>
															<?php endif;?>
															
														<?php $i++; endwhile;?>
													</div>
													<div class="cell small-12 xlarge-4 medium-no-pad-right">
														<div class="grid-x grid-padding-x">
															<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
																$thumbnail_id = get_post_thumbnail_id(); 
																$gated = get_field('gated');
															?>
															
																<?php if( $i == 1 ):?>
																	<article id="post-<?php the_ID(); ?>" <?php post_class('stacked relative hide-for-xlarge cell small-6 medium-12 large-6 xlarge-12'); ?> role="article">
																		<div class="card-grid grid-x">
																			<?php if( $thumbnail_id ):?>
																				<div class="cell small-12 medium-4">
																					<div class="thumb-wrap relative bg-black has-object-fit-img">
																						<?php if( $thumbnail_id ) {
																							echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
																						};?>
																						<?php if( $gated && !is_user_logged_in() ) {
																							get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																						};?>
																					</div>
																				</div>
																			<?php endif;?>
																			<div class="title-wrap cell small-12 medium-8">
																				<?php get_template_part('template-parts/content', 'byline-title');?>
																			</div>
																		</div>
																		<?php if( $gated && !is_user_logged_in() ):?>
																			<button class="reveal-trigger absolute-link-trigger" data-open="gated-content-alert">
																				<span class="show-for-sr">
																					This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																				</span>
																			</button>
																		<?php else:?>
																			<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																		<?php endif;?>
																	</article>
																<?php endif;?>
														
																<?php if( $i >= 2 ):?>
																	<article id="post-<?php the_ID(); ?>" <?php post_class('stacked relative cell small-6 medium-12 large-6 xlarge-12'); ?> role="article">
																		<div class="card-grid grid-x">
																			<?php if( $thumbnail_id ):?>
																				<div class="cell small-12 medium-4">
																					<div class="thumb-wrap relative bg-black has-object-fit-img">
																						<?php if( $thumbnail_id ) {
																							echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
																						};?>
																						<?php if( $gated && !is_user_logged_in() ) {
																							get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																						};?>
																					</div>
																				</div>
																			<?php endif;?>
																			<div class="title-wrap cell small-12 medium-8">
																				<?php get_template_part('template-parts/content', 'byline-title');?>
																			</div>
																		</div>
																		<?php if( $gated && !is_user_logged_in() ):?>
																			<button class="reveal-trigger absolute-link-trigger" data-open="gated-content-alert">
																				<span class="show-for-sr">
																					This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																				</span>
																			</button>
																		<?php else:?>
																			<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																		<?php endif;?>
																	</article>
																<?php endif;?>
														
															<?php $i++; endwhile;?>
														</div>
													</div>
												</div>
												<?php if( $global_news_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_news_page);?>">
															View <span class="inline-icon-wrap">News
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if ( $upcoming_podcast_query->have_posts() || $latest_podcast_query->have_posts() ) :?>
							<section class="podcasts home-cpt-row" id="podcasts">
								<div class="grid-container">
									<div class="section-header grid-x grid-padding-x">
										<div class="cell shrink title-wrap">
											<h2 class="m-0 h5">Podcasts</h2>
										</div>
										<div class="cell auto hr-wrap">
											<hr>
										</div>
									</div>
									<div class="body grid-x grid-padding-x align-center">
										<?php if ( $upcoming_podcast_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-11 medium-5 tablet-4 xlarge-3" id="upcoming-podcasts">
												<div class="title h6 uppercase">
													Upcoming
												</div>
												<div class="grid-x card-grid">
													<?php while ( $upcoming_podcast_query->have_posts() ) : $upcoming_podcast_query->the_post(); 
														$podcast_date = get_field('podcast_date') ?? null;	
														if( $podcast_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $podcast_date );
														}
														$gated = get_field('gated');
													?>
														<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 medium-6 tablet-12'); ?> role="article">
															<div class="bg-light-gray relative h-100 br-10">
																<div class="grid-x color-black h-100">
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
																			<h3 class="h6 weight-400 m-0">
																				<?php the_title();?>
																			</h3>
																		</div>
																	<?php endif;?>
																</div>
																<?php if( $gated && !is_user_logged_in() ):?>
																	<button class="reveal-trigger z-1 absolute-link-trigger" data-open="gated-content-alert">
																		<?php get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');?>
																		<span class="show-for-sr">
																			This triggers a modal that informs the user that the content is gated and how to Join and gain access.
																		</span>
																	</button>
																<?php else:?>
																	<a class="color-black z-1 absolute-link-trigger" href="<?=esc_url(get_the_permalink());?>" aria-label="Read the article: <?php the_title();?>"></a>
																<?php endif;?>
															</div>
														</article>
													<?php endwhile;?>
												</div>
											</div>
										<?php endif;?>
										<?php if ( $latest_podcast_query->have_posts() ) :?>
											<div class="home-cpt-main cell small-12 medium-11 medium-7 tablet-8 xlarge-9" id="latest-podcasts">
												<div class="title h6 uppercase">
													Latest
												</div>
												<div class="card-grid grid-x small-up-2 medium-up-2 large-up-4 pad-right">
													<?php while ( $latest_podcast_query->have_posts() ) : $latest_podcast_query->the_post(); 
														get_template_part('template-parts/loop', 'podcast');
													?>
													<?php endwhile;?>
												</div>
												<?php if( $global_podcasts_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_podcasts_page);?>">
															View <span class="inline-icon-wrap">Podcasts
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if( $testimonials_title || $testimonials ):?>
							<section class="testimonials bg-light-gray"id="testimonials">
								<div class="grid-container">
									<div class="grid-x grid-padding-x align-center">
										<div class="cell small-12 medium-11 tablet-10 large-9">
											<div class="inner bg-white box-shadow-5-15-10 br-10 text-center">
												<?php if( $testimonials_title ):?>
													<h2 class="h3">
														<?=wp_kses_post($testimonials_title);?>
													</h2>
												<?php endif;?>
												<?php if( $testimonials ):?>
													<div class="overflow-hidden">
														<div class="testimonials-slider">
															<div class="swiper-wrapper">
																<?php foreach($testimonials as $post):
																	setup_postdata($post);
																	$quote = get_field('quote') ?? null;
																	$company = get_field('company') ?? null;
																?>
																	<div class="swiper-slide">
																		<?php if( $quote ):?>
																			<div class="p p-3">
																				<?=wp_kses_post($quote);?>
																			</div>
																		<?php endif;?>
																		<hr>
																		<?php if( $company ):?>
																			<div class="h6 uppercase">
																				<?=wp_kses_post($company);?>
																			</div>
																		<?php endif;?>
																		<div class="h3">
																			<?php the_title();?>
																		</div>
																	</div>
																<?php endforeach;?>
															</div>
															<?php if( count($testimonials) > 1 ):?>
																<div class="btns-wrap grid-x align-center">
																	<div class="cell shrink">
																		<div class="swiper-btn swiper-button-prev">
																			<svg width="31" height="31" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.34 10.45h6.25c.22 0 .41-.2.41-.45s-.19-.45-.41-.45H8.34l2.52-2.79a.48.48 0 0 0 0-.63.38.38 0 0 0-.57 0l-3.2 3.55a.5.5 0 0 0 0 .64l3.2 3.55a.38.38 0 0 0 .57 0 .48.48 0 0 0 0-.63l-2.52-2.79Z" fill="#6357FD"/><rect x=".5" y=".5" width="20" height="20" rx="10" stroke="#6357FD"/></svg>
																		</div>
																	</div>
																	<div class="cell shrink">
																		<div class="swiper-btn swiper-button-next">
																			<svg width="31" height="31" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 10c0 .25.18.45.4.45h6.25l-2.53 2.79a.48.48 0 0 0 0 .63.38.38 0 0 0 .57 0l3.2-3.55c.04-.05.06-.1.08-.15v-.02l.03-.06v-.03a.3.3 0 0 0 0-.24l-.03-.06v-.02a.45.45 0 0 0-.08-.14L11.2 6.13a.38.38 0 0 0-.57 0 .48.48 0 0 0 0 .63l2.51 2.79H6.4A.45.45 0 0 0 6 10Z" fill="#6357FD"/><rect x=".5" y=".5" width="20" height="20" rx="10" stroke="#6357FD"/></svg>
																		</div>
																	</div>
																</div>
															<?php endif;?>
														</div>
													</div>
												<?php endif;?>
											</div>
										</div>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if($member_spotlight_posts):?>
							<section class="member-spotlights color-white relative" id="member-spotlights">
								<div class="grid-container">
									<div class="grid-x grid-padding-x align-center">
										<div class="cell small-12 xlarge-10">
											<header class="section-header grid-x grid-padding-x align-middle">
												<div class="cell shrink title-wrap">
													<div class="title h6 uppercase">
														Member Spotlight
													</div>
												</div>
												<div class="cell auto hr-wrap">
													<hr>
												</div>
											</header>
											<div class="section-body overflow-hidden">
												<div class="member-spotlight-slider">
													<div class="swiper-wrapper">
														<?php foreach($member_spotlight_posts as $post):
															setup_postdata($post);
															$featured_image_ID = get_post_thumbnail_id() ?? null;
															$title = get_the_title();	
															$homepage_slider_fields = get_field('homepage_slider_fields') ?? null;
															if($homepage_slider_fields) {
																$large_text = $homepage_slider_fields['large_text'] ?? null;
																$text = $homepage_slider_fields['text'] ?? null;
															}
														?>
															<div class="swiper-slide">
																<div class="grid-x grid-margin-x align-middle">
																	<?php if($featured_image_ID):?>
																		<div class="left cell small-12 medium-5">
																			<div class="img-wrap">
																				<?=wp_get_attachment_image( $featured_image_ID, 'large' );?>
																			</div>
																		</div>
																	<?php endif;?>
																	<div class="right cell small-12 medium-7">
																		<div class="inner">
																			<h3><?=wp_kses_post($title);?></h3>
																			<?php if($large_text):?>
																				<p class="p-3">
																					<?=wp_kses_post($large_text);?>
																				</p>
																			<?php endif;?>
																			<?php if($text):?>
																				<p>
																					<?=wp_kses_post($text);?>
																				</p>
																			<?php endif;?>
																			<div class="btn-wrap">
																				<?php get_template_part('template-parts/part', 'btn-link',
																					array(
																						'link' => get_the_permalink(),
																						'classes' => 'black',
																						'attrs' => 'rel="bookmark"',
																						'is-permalink' => 'true',
																						'link-title' => 'Read More',
																					),
																				);?>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endforeach;?>
													</div>
													<?php if( count($member_spotlight_posts) > 1 ):?>
														<div class="nav grid-x grid-padding-x small-up-2 tablet-up-4 relative z-1">
															<?php $i = 0; foreach($member_spotlight_posts as $post):
															setup_postdata($post);
																$homepage_slider_fields = get_field('homepage_slider_fields') ?? null;
																if($homepage_slider_fields) {
																	$member_detail = $homepage_slider_fields['member_detail'] ?? null;
																}
															?>
																<div class="cell">
																	<div class="swiper-page br-10 relative text-center<?php if( $i == 0 ):?> active<?php endif;?>" data-slide="<?=$i;?>">
																		<?php if($member_detail):?>
																			<div class="title h6">
																				<?=wp_kses_post($member_detail);?>
																			</div>
																		<?php endif;?>
																		<div class="h5"><b><?php the_title();?></b></div>
																	</div>
																</div>
															<?php $i++; endforeach;?>
														</div>
													<?php endif;?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if( $partnerships || $partnerships_page_link ):?>
							<section class="partnerships" id="partnerships">
								<div class="grid-container">
									<div class="grid-x grid-padding-x align-center">
										<div class="cell small-12 xlarge-10">
											<header class="section-header grid-x grid-padding-x align-middle">
												<div class="cell shrink title-wrap">
													<div class="title h6 uppercase">
														AHDAM Partnerships
													</div>
												</div>
												<div class="cell auto hr-wrap">
													<hr>
												</div>
											</header>
											<?php if($partnerships):?>
												<div class="section-body overflow-hidden">
													<div class="grid-x grid-padding-x">
														<div class="cell small-12 medium-6">
															<div class="partnerships-slider overflow-hidden">
																<div class="swiper-wrapper">
																	<?php foreach($partnerships as $partnership):
																		$dark_logo = $partnership['dark_logo'] ?? null;	
																		$partner_name = $partnership['partner_name'] ?? null;
																		$large_text = $partnership['large_text'] ?? null;	
																		$text = $partnership['text'] ?? null;	
																	?>
																		<div class="swiper-slide">
																			<?php if($dark_logo):?>
																				<div class="logo-wrap">
																					<?=wp_get_attachment_image( $dark_logo['id'], 'full' );?>
																				</div>
																			<?php endif;?>
																			<?php if($large_text):?>
																				<p class="p-3">
																					<?=wp_kses_post($large_text);?>
																				</p>
																			<?php endif;?>
																			<?php if($text):?>
																				<p>
																					<?=wp_kses_post($text);?>
																				</p>
																			<?php endif;?>
																			<?php if( $partnerships_page_link ):?>
																				<div class="btn-wrap">
																					<?php get_template_part('template-parts/part', 'btn-link',
																						array(
																							'link' => $partnerships_page_link ,
																							'classes' => 'violet',
																						),
																					);?>
																				</div>
																			<?php endif;?>
																		</div>
																	<?php endforeach;?>
																</div>
															</div>
														</div>
														<?php if( count($partnerships) > 1 ):?>
															<div class="cell small-12 medium-6">
																<div class="nav grid-x card-grid h-100 relative z-1">
																	<?php $i = 0; foreach($partnerships as $partnership):
																		$partner_name = $partnership['partner_name'] ?? null;
																		$light_logo = $partnership['light_logo'] ?? null;	
																	?>
																		<div class="cell small-6 h-100">
																			<div class="swiper-page br-10 overflow-hidden bg-black relative grid-x align-middle align-center text-center<?php if( $i == 0 ):?> active<?php endif;?>" data-slide="<?=$i;?>">
																				<div class="show-for-sr">
																					Slides to <?=esc_html($partner_name);?>
																				</div>
																				<div class="logo-wrap">
																					<?=wp_get_attachment_image( $light_logo['id'], 'full' );?>
																				</div>
																			</div>
																		</div>
																	<?php $i++; endforeach;?>
																</div>
															</div>
														<?php endif;?>
													</div>
												</div>
											<?php endif;?>
										</div>
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