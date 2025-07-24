<?php
$global_gated_content_notification_copy = get_field('global_gated_content_notification_copy', 'option') ?? null;

$login = get_field('header_login', 'option') ?? null;
$join = get_field('header_join', 'option') ?? null;
?>
<div class="part-gated-content-alert">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12 xlarge-10 xlarge-8 text-center">
				<div class="bg-light-gray">
					<?php if( $global_gated_content_notification_copy || $login || $join ):?>
						<?php if( $global_gated_content_notification_copy ) {
							echo wp_kses_post($global_gated_content_notification_copy);
						};?>

						
							<?php if( $login || $join ) :?>
								<div class="link-wrap">
									<?php get_template_part('template-parts/part', 'btn-group',
										array(
											'flex-classes' => 'align-center',
											'btn1' => $login,
											'btn1-classes' => 'black-outline',
											'btn2' => $join,
											'btn2-classes' => 'violet',
										),
									);?>
								</div>
							<?php endif;?>
					
						<?php else:?>
							
							<h2>This is content that is for members only.</h2>							
							<?php if( $login  || $join ) :?>
								<div class="link-wrap">
									<?php get_template_part('template-parts/part', 'btn-group',
										array(
											'flex-classes' => 'align-center',
											'btn1' => $login,
											'btn1-classes' => 'black-outline',
											'btn2' => $join,
											'btn2-classes' => 'violet',
										),
									);?>
								</div>
							<?php endif;?>
					
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>