<?php
/**
 * The template part for displaying an author byline
 */
 $date = get_the_date('m.d.Y');
 $author_name = get_field('news_author') ?? null;
 $post_type = get_post_type();
 
 $show_date = false;
 $show_author = false;
 
 if( $post_type == 'news' ) {
	$show_date = true;
	$show_author = true;
 }
 
?>

<div class="byline p p-2">
	<?php if( $date && $show_date ):?>
		<div class="date">
			<b><?=$date;?></b>
		</div>
	<?php endif;?>
	<h3 class="p p-2 weight-400">
		<?php the_title();?>
	</h3>
	<?php if( $author_name && $show_author ):?>
		<div class="author">
			<b>By <?=esc_html( $author_name );?></b>
		</div>
	<?php endif;?>
</div>	