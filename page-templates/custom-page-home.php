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

$member_spotlight_posts = get_field('member_spotlight_posts') ?? null;

$partnerships = get_field('partnerships') ?? null;
$partnerships_page_link = get_field('partnerships_page_link') ?? null;

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
					<section class="body" itemprop="text">
						<?php if ( $upcoming_webinar_query->have_posts() || $latest_webinar_query->have_posts() ) :?>
							<section class="webinars home-cpt-row">
								<div class="grid-container">
									<div class="section-header grid-x grid-padding-x">
										<div class="cell shrink title-wrap">
											<h2 class="m-0 h5">Webinars</h2>
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
													$gated = get_field('gated');
												?>
													<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray relative'); ?> role="article">
														<div class="grid-x color-black">
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
													</article>
												<?php endwhile;?>
											</div>
										<?php endif;?>
										<?php if ( $latest_webinar_query->have_posts() ) :?>
											<div class="home-cpt-main cell small-12 medium-9">
												<div class="title h6 uppercase">
													Latest
												</div>
												<div class="card-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-4 pad-right">
													<?php while ( $latest_webinar_query->have_posts() ) : $latest_webinar_query->the_post(); 
														$webinar_date = get_field('webinar_date') ?? null;	
														if( $webinar_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $webinar_date );
														}
														$thumbnail_id = get_post_thumbnail_id();
														$host_images = get_field('host_images') ?? null;
														$gated = get_field('gated');
													?>
														<div class="cell">
															<article id="post-<?php the_ID(); ?>" <?php post_class('relative'); ?> role="article">
																<?php if( $host_images || $webinar_date ):?>
																	<div class="thumb-date-wrap grid-x align-justify bg-black relative z-1">
																		<div class="date-wrap cell shrink grid-x relative z-1">
																			<div class="date text-center">
																				<div class="month h6 uppercase">
																					<?=$date->format( 'M' ); ?>
																				</div>
																				<div class="day h2">
																					<?=$date->format( 'd' ); ?>
																				</div>
																			</div>
																		</div>
																		<?php if( $host_images ):?>
																			<div class="host-images cell auto relative z-1<?php if( count($host_images) > 1 ):?> grid<?php endif;?>">
																				<?php foreach( $host_images as $image_id ): ?>
																					<div class="image-wrap cell overflow-hidden">
																						<?=wp_get_attachment_image( $image_id, 'medium' ); ?>
																					</div>
																				<?php endforeach;?>
																			</div>
																		<?php endif;?>
																		<?php if( $gated && !is_user_logged_in() ) {
																			get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																		};?>
																	</div>
																	<div class="title">
																		<h3 class="h6 m-0">
																			<?php the_title();?>
																		</h3>
																	</div>
																<?php endif;?>
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
														</div>
													<?php endwhile;?>
												</div>
												<?php if( $global_webinars_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_webinars_page);?>">
															View <span class="inline-icon-wrap">Webinars
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="a" fill="#201F1F"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/><path d="m6.657 4.446.74.672 1.515-1.672H6.657v1ZM4.13 7.235l-.741-.672-.002.002.743.67Zm.571.633.743.67-.743-.67Zm3.203-3.554-.743-.67.743.67Zm.05-.067.837.548.164-.25v-.298h-1Zm0-.018-.899-.436-.1.206v.23h1Zm.029-.058.9.437.1-.207v-.23h-1Zm0-.027-.947-.32-.053.156v.164h1Zm.014-.058-.99-.137-.003.019-.002.018.995.1Zm0-.087L7 3.929l-.007.104.014.103L7.998 4Zm0-.09.998-.069-.001-.015-.002-.015-.995.1Zm-.014-.056h-1v.165l.053.156.947-.32Zm0-.027h1v-.23l-.1-.206-.9.436Zm-.028-.058h-1v.23l.1.207.9-.437Zm0-.018h1v-.325l-.192-.263-.808.588Zm-.05-.069.808-.588-.03-.043-.036-.039-.743.67ZM4.701.13 3.959.8l.743-.67Zm-.57.633-.744.67.743-.67Zm2.514 2.788v1h2.25l-1.507-1.67-.743.67ZM0 4h-1c0 .698.534 1.447 1.403 1.447v-2C.83 3.446 1 3.793 1 4H0Zm.403.447v1h6.254v-2H.403v1Zm6.254 0-.742-.671L3.39 6.563l.741.672.741.67 2.526-2.787-.741-.672ZM4.13 7.235l-.743-.67c-.5.555-.5 1.417 0 1.972l.743-.67.743-.669c.103.114.14.245.14.353a.528.528 0 0 1-.14.353l-.743-.67Zm0 .633-.743.67a1.376 1.376 0 0 0 2.057 0l-.743-.67-.743-.67c.108-.12.273-.2.458-.2.184 0 .35.08.457.2l-.743.67Zm.571 0 .743.67 3.203-3.554-.743-.67-.743-.67L3.96 7.199l.743.67Zm3.203-3.554.743.67a1.54 1.54 0 0 0 .144-.189l-.836-.548-.837-.548c-.002.004.013-.021.043-.054l.743.67Zm.05-.067h1V4.23h-2v.018h1Zm0-.018.9.437.028-.058-.9-.437-.899-.437-.028.059.9.436Zm.029-.058h1v-.027h-2v.027h1Zm0-.027.947.32c.01-.03.048-.14.062-.278l-.995-.1-.995-.1a.8.8 0 0 1 .021-.12c.006-.024.012-.04.013-.042l.947.32Zm.014-.058.99.137c.017-.12.017-.241 0-.362L7.998 4l-.99.137a.684.684 0 0 1 0-.187l.99.137Zm0-.087.998.069a1.663 1.663 0 0 0 0-.228l-.998.07L7 3.977a.351.351 0 0 1 0-.048l.998.069Zm0-.09.995-.1c-.015-.15-.06-.27-.062-.276l-.947.32-.947.32a.826.826 0 0 1-.034-.165l.995-.099Zm-.014-.056h1v-.027h-2v.027h1Zm0-.027.9-.436-.029-.058-.9.436-.899.437.028.058.9-.437Zm-.028-.058h1V3.75h-2v.018h1Zm0-.018.808-.588-.05-.069-.809.588-.809.588.05.07.81-.589Zm-.05-.069.742-.67L5.445-.54l-.743.67-.743.67 3.204 3.55.742-.669ZM4.701.13l.743-.67a1.376 1.376 0 0 0-2.057 0l.743.67.743.67a.617.617 0 0 1-.457.199.617.617 0 0 1-.458-.2l.743-.67Zm-.57 0-.744-.67c-.5.555-.5 1.418 0 1.973l.743-.67.743-.67c.103.115.14.246.14.353a.528.528 0 0 1-.14.353L4.13.13Zm0 .633-.743.67L5.904 4.22l.742-.67.743-.67L4.874.093l-.743.67Zm2.514 2.788v-1H.403v2h6.243v-1Zm-6.243 0v-1C-.466 2.551-1 3.301-1 4h2a.574.574 0 0 1-.597.552v-1Z" fill="#201F1F" mask="url(#a)"/></svg></span>
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
							<section class="events-news home-cpt-row">
								<div class="grid-container">
									<div class="body grid-x grid-padding-x">
										<?php if ( $events_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-3">
												<div class="section-header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h5">Events</h2>
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
													$gated = get_field('gated');
												?>
													<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray relative'); ?> role="article">
														<div class="grid-x color-black">
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
													</article>
												<?php endwhile;?>
												<?php if( $global_events_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_events_page);?>">
															View <span class="inline-icon-wrap">Events
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="a" fill="#201F1F"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/><path d="m6.657 4.446.74.672 1.515-1.672H6.657v1ZM4.13 7.235l-.741-.672-.002.002.743.67Zm.571.633.743.67-.743-.67Zm3.203-3.554-.743-.67.743.67Zm.05-.067.837.548.164-.25v-.298h-1Zm0-.018-.899-.436-.1.206v.23h1Zm.029-.058.9.437.1-.207v-.23h-1Zm0-.027-.947-.32-.053.156v.164h1Zm.014-.058-.99-.137-.003.019-.002.018.995.1Zm0-.087L7 3.929l-.007.104.014.103L7.998 4Zm0-.09.998-.069-.001-.015-.002-.015-.995.1Zm-.014-.056h-1v.165l.053.156.947-.32Zm0-.027h1v-.23l-.1-.206-.9.436Zm-.028-.058h-1v.23l.1.207.9-.437Zm0-.018h1v-.325l-.192-.263-.808.588Zm-.05-.069.808-.588-.03-.043-.036-.039-.743.67ZM4.701.13 3.959.8l.743-.67Zm-.57.633-.744.67.743-.67Zm2.514 2.788v1h2.25l-1.507-1.67-.743.67ZM0 4h-1c0 .698.534 1.447 1.403 1.447v-2C.83 3.446 1 3.793 1 4H0Zm.403.447v1h6.254v-2H.403v1Zm6.254 0-.742-.671L3.39 6.563l.741.672.741.67 2.526-2.787-.741-.672ZM4.13 7.235l-.743-.67c-.5.555-.5 1.417 0 1.972l.743-.67.743-.669c.103.114.14.245.14.353a.528.528 0 0 1-.14.353l-.743-.67Zm0 .633-.743.67a1.376 1.376 0 0 0 2.057 0l-.743-.67-.743-.67c.108-.12.273-.2.458-.2.184 0 .35.08.457.2l-.743.67Zm.571 0 .743.67 3.203-3.554-.743-.67-.743-.67L3.96 7.199l.743.67Zm3.203-3.554.743.67a1.54 1.54 0 0 0 .144-.189l-.836-.548-.837-.548c-.002.004.013-.021.043-.054l.743.67Zm.05-.067h1V4.23h-2v.018h1Zm0-.018.9.437.028-.058-.9-.437-.899-.437-.028.059.9.436Zm.029-.058h1v-.027h-2v.027h1Zm0-.027.947.32c.01-.03.048-.14.062-.278l-.995-.1-.995-.1a.8.8 0 0 1 .021-.12c.006-.024.012-.04.013-.042l.947.32Zm.014-.058.99.137c.017-.12.017-.241 0-.362L7.998 4l-.99.137a.684.684 0 0 1 0-.187l.99.137Zm0-.087.998.069a1.663 1.663 0 0 0 0-.228l-.998.07L7 3.977a.351.351 0 0 1 0-.048l.998.069Zm0-.09.995-.1c-.015-.15-.06-.27-.062-.276l-.947.32-.947.32a.826.826 0 0 1-.034-.165l.995-.099Zm-.014-.056h1v-.027h-2v.027h1Zm0-.027.9-.436-.029-.058-.9.436-.899.437.028.058.9-.437Zm-.028-.058h1V3.75h-2v.018h1Zm0-.018.808-.588-.05-.069-.809.588-.809.588.05.07.81-.589Zm-.05-.069.742-.67L5.445-.54l-.743.67-.743.67 3.204 3.55.742-.669ZM4.701.13l.743-.67a1.376 1.376 0 0 0-2.057 0l.743.67.743.67a.617.617 0 0 1-.457.199.617.617 0 0 1-.458-.2l.743-.67Zm-.57 0-.744-.67c-.5.555-.5 1.418 0 1.973l.743-.67.743-.67c.103.115.14.246.14.353a.528.528 0 0 1-.14.353L4.13.13Zm0 .633-.743.67L5.904 4.22l.742-.67.743-.67L4.874.093l-.743.67Zm2.514 2.788v-1H.403v2h6.243v-1Zm-6.243 0v-1C-.466 2.551-1 3.301-1 4h2a.574.574 0 0 1-.597.552v-1Z" fill="#201F1F" mask="url(#a)"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
										<?php if ( $news_query->have_posts() ) :?>
											<div class="home-cpt-main news-row cell small-12 medium-9">
												<div class="section-header grid-x grid-padding-x">
													<div class="cell shrink title-wrap">
														<h2 class="m-0 h5">News</h2>
													</div>
													<div class="cell auto hr-wrap">
														<hr>
													</div>
												</div>
												<div class="grid-x grid-padding-x pad-right">
													<div class="cell small-12 medium-8">
														<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
															$thumbnail_id = get_post_thumbnail_id(); 
															$gated = get_field('gated');
														?>
																
															<?php if( $i == 1 ):?>
																<article id="post-<?php the_ID(); ?>" <?php post_class('featured relative'); ?> role="article">
																	<div class="card-grid grid-x grid-padding-x">
																		<?php if( $thumbnail_id ):?>
																			<div class="cell small-12 medium-6">
																				<div class="thumb-wrap has-object-fit-img bg-black">
																					<?php if( $thumbnail_id ) {
																						echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
																					};?>
																					<?php if( $gated && !is_user_logged_in() ) {
																						get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																					};?>
																				</div>
																			</div>
																		<?php endif;?>
																		<div class="title-wrap cell small-12 medium-6">
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
													<div class="cell small-12 medium-4 medium-no-pad-right">
														<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); 
															$thumbnail_id = get_post_thumbnail_id(); 
															$gated = get_field('gated');
														?>
													
															<?php if( $i >= 2 ):?>
																<article id="post-<?php the_ID(); ?>" <?php post_class('stacked relative'); ?> role="article">
																	<div class="card-grid grid-x grid-padding-x">
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
												<?php if( $global_news_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_news_page);?>">
															View <span class="inline-icon-wrap">News
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="a" fill="#201F1F"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/><path d="m6.657 4.446.74.672 1.515-1.672H6.657v1ZM4.13 7.235l-.741-.672-.002.002.743.67Zm.571.633.743.67-.743-.67Zm3.203-3.554-.743-.67.743.67Zm.05-.067.837.548.164-.25v-.298h-1Zm0-.018-.899-.436-.1.206v.23h1Zm.029-.058.9.437.1-.207v-.23h-1Zm0-.027-.947-.32-.053.156v.164h1Zm.014-.058-.99-.137-.003.019-.002.018.995.1Zm0-.087L7 3.929l-.007.104.014.103L7.998 4Zm0-.09.998-.069-.001-.015-.002-.015-.995.1Zm-.014-.056h-1v.165l.053.156.947-.32Zm0-.027h1v-.23l-.1-.206-.9.436Zm-.028-.058h-1v.23l.1.207.9-.437Zm0-.018h1v-.325l-.192-.263-.808.588Zm-.05-.069.808-.588-.03-.043-.036-.039-.743.67ZM4.701.13 3.959.8l.743-.67Zm-.57.633-.744.67.743-.67Zm2.514 2.788v1h2.25l-1.507-1.67-.743.67ZM0 4h-1c0 .698.534 1.447 1.403 1.447v-2C.83 3.446 1 3.793 1 4H0Zm.403.447v1h6.254v-2H.403v1Zm6.254 0-.742-.671L3.39 6.563l.741.672.741.67 2.526-2.787-.741-.672ZM4.13 7.235l-.743-.67c-.5.555-.5 1.417 0 1.972l.743-.67.743-.669c.103.114.14.245.14.353a.528.528 0 0 1-.14.353l-.743-.67Zm0 .633-.743.67a1.376 1.376 0 0 0 2.057 0l-.743-.67-.743-.67c.108-.12.273-.2.458-.2.184 0 .35.08.457.2l-.743.67Zm.571 0 .743.67 3.203-3.554-.743-.67-.743-.67L3.96 7.199l.743.67Zm3.203-3.554.743.67a1.54 1.54 0 0 0 .144-.189l-.836-.548-.837-.548c-.002.004.013-.021.043-.054l.743.67Zm.05-.067h1V4.23h-2v.018h1Zm0-.018.9.437.028-.058-.9-.437-.899-.437-.028.059.9.436Zm.029-.058h1v-.027h-2v.027h1Zm0-.027.947.32c.01-.03.048-.14.062-.278l-.995-.1-.995-.1a.8.8 0 0 1 .021-.12c.006-.024.012-.04.013-.042l.947.32Zm.014-.058.99.137c.017-.12.017-.241 0-.362L7.998 4l-.99.137a.684.684 0 0 1 0-.187l.99.137Zm0-.087.998.069a1.663 1.663 0 0 0 0-.228l-.998.07L7 3.977a.351.351 0 0 1 0-.048l.998.069Zm0-.09.995-.1c-.015-.15-.06-.27-.062-.276l-.947.32-.947.32a.826.826 0 0 1-.034-.165l.995-.099Zm-.014-.056h1v-.027h-2v.027h1Zm0-.027.9-.436-.029-.058-.9.436-.899.437.028.058.9-.437Zm-.028-.058h1V3.75h-2v.018h1Zm0-.018.808-.588-.05-.069-.809.588-.809.588.05.07.81-.589Zm-.05-.069.742-.67L5.445-.54l-.743.67-.743.67 3.204 3.55.742-.669ZM4.701.13l.743-.67a1.376 1.376 0 0 0-2.057 0l.743.67.743.67a.617.617 0 0 1-.457.199.617.617 0 0 1-.458-.2l.743-.67Zm-.57 0-.744-.67c-.5.555-.5 1.418 0 1.973l.743-.67.743-.67c.103.115.14.246.14.353a.528.528 0 0 1-.14.353L4.13.13Zm0 .633-.743.67L5.904 4.22l.742-.67.743-.67L4.874.093l-.743.67Zm2.514 2.788v-1H.403v2h6.243v-1Zm-6.243 0v-1C-.466 2.551-1 3.301-1 4h2a.574.574 0 0 1-.597.552v-1Z" fill="#201F1F" mask="url(#a)"/></svg></span>
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
							<section class="webinars home-cpt-row">
								<div class="grid-container">
									<div class="section-header grid-x grid-padding-x">
										<div class="cell shrink title-wrap">
											<h2 class="m-0 h5">Podcasts</h2>
										</div>
										<div class="cell auto hr-wrap">
											<hr>
										</div>
									</div>
									<div class="body grid-x grid-padding-x">
										<?php if ( $upcoming_podcast_query->have_posts() ) :?>
											<div class="home-cpt-sidebar cell small-12 medium-3">
												<div class="title h6 uppercase">
													Upcoming
												</div>
												<?php while ( $upcoming_podcast_query->have_posts() ) : $upcoming_podcast_query->the_post(); 
													$podcast_date = get_field('podcast_date') ?? null;	
													if( $podcast_date  ) {
														$date = DateTime::createFromFormat( 'Ymd', $podcast_date );
													}
													$gated = get_field('gated');
												?>
													<article id="post-<?php the_ID(); ?>" <?php post_class('bg-light-gray relative'); ?> role="article">
														<div class="grid-x color-black">
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
													</article>
												<?php endwhile;?>
											</div>
										<?php endif;?>
										<?php if ( $latest_podcast_query->have_posts() ) :?>
											<div class="home-cpt-main cell small-12 medium-9">
												<div class="title h6 uppercase">
													Latest
												</div>
												<div class="card-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-4 pad-right">
													<?php while ( $latest_podcast_query->have_posts() ) : $latest_podcast_query->the_post(); 
														$podcast_date = get_field('webinar_date') ?? null;	
														if( $podcast_date  ) {
															$date = DateTime::createFromFormat( 'Ymd', $podcast_date );
														}
														$thumbnail_id = get_post_thumbnail_id();
														$gated = get_field('gated');
													?>
														<div class="cell">
															<article id="post-<?php the_ID(); ?>" <?php post_class('relative'); ?> role="article">
																<?php if( $thumbnail_id || $webinar_date ):?>
																	<div class="thumb-date-wrap has-object-fit-img bg-black">
																		<?php if( $thumbnail_id ) {
																			echo wp_get_attachment_image( $thumbnail_id, 'large', false, [ 'class' => 'img-fill' ] );
																		};?>
																		<div class="date-live-wrap grid-x z-1 align-right">
																			<div class="pod-icon uppercase cell auto text-right">
																				<svg viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg"><circle cx="15.5" cy="15.5" r="15.5" fill="#C84DFF"/><g clip-path="url(#a)"><path fill="#fff" d="M16.15 18.57c1.62-.07 2.86-1.5 2.86-3.15v-5.26c0-1.65-1.24-3.08-2.86-3.15-1.72-.08-3.14 1.32-3.14 3.06v5.45c0 1.74 1.42 3.14 3.14 3.06zM22 15.3v-1.92a.55.55 0 0 0-.54-.55h-.56a.57.57 0 0 0-.56.58v1.78c0 2.4-1.82 4.45-4.17 4.54-2.46.09-4.49-1.93-4.49-4.42v-2.05a.57.57 0 0 0-.56-.58h-.52a.59.59 0 0 0-.58.6v2.03c0 3.09 2.25 5.64 5.16 6.06v1.93h-3.39c-.29 0-.52.24-.52.53v.65c0 .29.23.52.51.52h8.27c.3 0 .55-.25.55-.56v-.63a.5.5 0 0 0-.5-.51h-3.24v-1.93c2.91-.42 5.16-2.97 5.16-6.06z"/></g><defs><clipPath id="a"><path fill="#fff" d="M10 7h12v18H10z"/></clipPath></defs></svg>
																			</div>
																		</div>
																		<?php if( $gated && !is_user_logged_in() ) {
																			get_template_part('template-parts/part', 'gated-reveal-trigger-overlay');
																		};?>
																	</div>
																	<div class="title">
																		<h3 class="h6 m-0">
																			<?php the_title();?>
																		</h3>
																	</div>
																<?php endif;?>
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
														</div>
													<?php endwhile;?>
												</div>
												<?php if( $global_podcasts_page ):?>
													<div class="archive-link-wrap grid-x align-right">
														<a class="h6 uppercase m-0" href="<?=esc_url($global_podcasts_page);?>">
															View <span class="inline-icon-wrap">Podcasts
															<svg width="11" height="11" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="a" fill="#201F1F"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#201F1F"/><path d="m6.657 4.446.74.672 1.515-1.672H6.657v1ZM4.13 7.235l-.741-.672-.002.002.743.67Zm.571.633.743.67-.743-.67Zm3.203-3.554-.743-.67.743.67Zm.05-.067.837.548.164-.25v-.298h-1Zm0-.018-.899-.436-.1.206v.23h1Zm.029-.058.9.437.1-.207v-.23h-1Zm0-.027-.947-.32-.053.156v.164h1Zm.014-.058-.99-.137-.003.019-.002.018.995.1Zm0-.087L7 3.929l-.007.104.014.103L7.998 4Zm0-.09.998-.069-.001-.015-.002-.015-.995.1Zm-.014-.056h-1v.165l.053.156.947-.32Zm0-.027h1v-.23l-.1-.206-.9.436Zm-.028-.058h-1v.23l.1.207.9-.437Zm0-.018h1v-.325l-.192-.263-.808.588Zm-.05-.069.808-.588-.03-.043-.036-.039-.743.67ZM4.701.13 3.959.8l.743-.67Zm-.57.633-.744.67.743-.67Zm2.514 2.788v1h2.25l-1.507-1.67-.743.67ZM0 4h-1c0 .698.534 1.447 1.403 1.447v-2C.83 3.446 1 3.793 1 4H0Zm.403.447v1h6.254v-2H.403v1Zm6.254 0-.742-.671L3.39 6.563l.741.672.741.67 2.526-2.787-.741-.672ZM4.13 7.235l-.743-.67c-.5.555-.5 1.417 0 1.972l.743-.67.743-.669c.103.114.14.245.14.353a.528.528 0 0 1-.14.353l-.743-.67Zm0 .633-.743.67a1.376 1.376 0 0 0 2.057 0l-.743-.67-.743-.67c.108-.12.273-.2.458-.2.184 0 .35.08.457.2l-.743.67Zm.571 0 .743.67 3.203-3.554-.743-.67-.743-.67L3.96 7.199l.743.67Zm3.203-3.554.743.67a1.54 1.54 0 0 0 .144-.189l-.836-.548-.837-.548c-.002.004.013-.021.043-.054l.743.67Zm.05-.067h1V4.23h-2v.018h1Zm0-.018.9.437.028-.058-.9-.437-.899-.437-.028.059.9.436Zm.029-.058h1v-.027h-2v.027h1Zm0-.027.947.32c.01-.03.048-.14.062-.278l-.995-.1-.995-.1a.8.8 0 0 1 .021-.12c.006-.024.012-.04.013-.042l.947.32Zm.014-.058.99.137c.017-.12.017-.241 0-.362L7.998 4l-.99.137a.684.684 0 0 1 0-.187l.99.137Zm0-.087.998.069a1.663 1.663 0 0 0 0-.228l-.998.07L7 3.977a.351.351 0 0 1 0-.048l.998.069Zm0-.09.995-.1c-.015-.15-.06-.27-.062-.276l-.947.32-.947.32a.826.826 0 0 1-.034-.165l.995-.099Zm-.014-.056h1v-.027h-2v.027h1Zm0-.027.9-.436-.029-.058-.9.436-.899.437.028.058.9-.437Zm-.028-.058h1V3.75h-2v.018h1Zm0-.018.808-.588-.05-.069-.809.588-.809.588.05.07.81-.589Zm-.05-.069.742-.67L5.445-.54l-.743.67-.743.67 3.204 3.55.742-.669ZM4.701.13l.743-.67a1.376 1.376 0 0 0-2.057 0l.743.67.743.67a.617.617 0 0 1-.457.199.617.617 0 0 1-.458-.2l.743-.67Zm-.57 0-.744-.67c-.5.555-.5 1.418 0 1.973l.743-.67.743-.67c.103.115.14.246.14.353a.528.528 0 0 1-.14.353L4.13.13Zm0 .633-.743.67L5.904 4.22l.742-.67.743-.67L4.874.093l-.743.67Zm2.514 2.788v-1H.403v2h6.243v-1Zm-6.243 0v-1C-.466 2.551-1 3.301-1 4h2a.574.574 0 0 1-.597.552v-1Z" fill="#201F1F" mask="url(#a)"/></svg></span>
														</a>
													</div>
												<?php endif;?>
											</div>
										<?php endif;?>
									</div>
								</div>
							</section>
						<?php endif;?>
						
						<?php if($member_spotlight_posts):?>
							<section class="member-spotlights color-white relative">
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
																	<div class="swiper-page relative text-center<?php if( $i == 0 ):?> active<?php endif;?>" data-slide="<?=$i;?>">
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
							<section class="partnerships">
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
																<div class="nav grid-x grid-padding-x h-100 small-up-1 medium-up-2 relative z-1">
																	<?php $i = 0; foreach($partnerships as $partnership):
																		$partner_name = $partnership['partner_name'] ?? null;
																		$light_logo = $partnership['light_logo'] ?? null;	
																	?>
																		<div class="cell h-100">
																			<div class="swiper-page h-100 bg-black relative grid-x align-middle align-center text-center<?php if( $i == 0 ):?> active<?php endif;?>" data-slide="<?=$i;?>">
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