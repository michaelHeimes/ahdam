<?php
/**
 * The template part for displaying an author byline
 */
 $date = get_the_date('m.d.Y');
 $author_name = get_field('news_author') ?? null;
?>

<div class="byline p p-2">
	<?php if( $date ):?>
		<div class="date">
			<b><?=$date;?></b>
		</div>
	<?php endif;?>
	<h3 class="h6 weight-400">
		<?php the_title();?>
	</h3>
	<?php if( $author_name ):?>
		<div class="author">
			<b><?=esc_html( $author_name );?></b>
		</div>
	<?php endif;?>
</div>	
