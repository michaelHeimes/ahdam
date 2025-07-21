<?php
$link = $args['link'] ?? null;
$classes = $args['classes'] ?? null;
$attrs = $args['attrs'] ?? null;
$is_permalink = $args['is-permalink'] ?? null;
$icon = $args['icon'] ?? null;
if( $is_permalink == 'true' ) {
	$link_url = $link;
	$link_title = $args['link-title'] ?? null;
	$link_target = '_self';
} 

if( $link && $is_permalink !== 'true' || $is_permalink !== 'true' ) {
	$link_url = $link['url'];
	$link_title = $link['title'];
	$link_target = $link['target'] ? $link['target'] : '_self';
}
if($link_url):
?>	
	<div>
		<a class="button <?=esc_html($classes);?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" <?=$attrs;?>>		
			<?php
			// Split title into words and wrap last word with SVG
			
			if($icon) {
				echo $icon;
				if( $link_title ) {
					echo '<span class="show-for-sr">' . $link_title . '</span>';
				}
			} else {
			
				$title_words = explode(' ', $link_title);
				if (count($title_words) > 1) {
					$last_word = array_pop($title_words);
					$title_html = implode(' ', $title_words) . ' <span class="inline-icon-wrap">' . esc_html($last_word) . '
						<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#fff"/></svg>
					</span>';
				} else {
					$title_html = '<span class="inline-icon-wrap">' . esc_html($link_title) . '
						<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#fff"/></svg>
					</span>';
				}
				echo $title_html;
				
			}
			?>		
	
		</a>	
	</div>
<?php endif;?>