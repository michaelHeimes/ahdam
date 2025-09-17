<?php
$global_gated_content_copy_login_prompt = get_field('global_gated_content_copy_login_prompt', 'option') ?? null;
$global_gated_content_copy_register_prompt = get_field('global_gated_content_copy_register_prompt', 'option') ?? null;

$global_gated_content_notification_copy = get_field('global_gated_content_notification_copy', 'option') ?? null;

$login = get_field('header_login', 'option') ?? null;
$join = get_field('header_join', 'option') ?? null;
?>
<div class="part-gated-content-alert">
	<div class="grid-container">
		<?php if( $global_gated_content_copy_login_prompt || $global_gated_content_copy_register_prompt ):?>
			<div class="grid-x grid-padding-x align-center">
				<?php if( $global_gated_content_copy_login_prompt ):?>
					<div class="left form-wrap cell small-12 tablet-6">
						<?=$global_gated_content_copy_login_prompt;?>
					</div>
				<?php endif;?>
				<?php if( $global_gated_content_copy_register_prompt ):?>
					<div class="right form-wrap cell small-12 tablet-6">
						<?=$global_gated_content_copy_register_prompt;?>
					</div>
				<?php endif;?>
			</div>
		<?php endif;?>
		<div class="grid-x grid-padding-x align-center hide">
			<div class="cell small-12 xlarge-10 xlarge-8 text-center">
				<div class="inner<?php if( !is_page_template('page-templates/custom-page-members-only.php') ):?> bg-light-gray<?php endif;?>">
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
											'btn1-classes' => 'navy-outline',
											'btn2' => $join,
											'btn2-classes' => '',
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
											'btn1-classes' => 'navy-outline',
											'btn2' => $join,
											'btn2-classes' => '',
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