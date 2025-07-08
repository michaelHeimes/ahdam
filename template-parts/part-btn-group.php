<?php
$flex_classes = $args['flex-classes'] ?? null;
$btn1 = $args['btn1'] ?? null;
$btn1Classes = $args['btn1-classes'] ?? null;
$btn2 = $args['btn2'] ?? null;
$btn2Classes = $args['btn2-classes'] ?? null;
?>
<div class="grid-x btn-group <?=esc_attr( $flex_classes );?>">
	<?php if( $btn1 ) {
		get_template_part('template-parts/part', 'btn-link',
			array(
				'link' => $btn1, 
				'classes' => $btn1Classes,
			),
		);	
	}?>
	<?php if( $btn2 ) {
		get_template_part('template-parts/part', 'btn-link',
			array(
				'link' => $btn2, 
				'classes' => $btn2Classes,
			),
		);	
	}?>
</div>