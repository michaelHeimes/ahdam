<?php
$gated_content_login_join_page = get_field('gated_content_login_join_page', 'option') ?? null;
if($gated_content_login_join_page):
?>
	<a class="gated-reveal-trigger-overlay" href="<?= esc_url($gated_content_login_join_page); ?>" aria-label="This is gated content. This links you to the login or join page"></a>

<?php endif;?>