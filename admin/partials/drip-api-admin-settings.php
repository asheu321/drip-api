<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
	<?php
	do_settings_sections( 'gd_drip_api' );
	settings_fields( 'gd_drip_api' );
	
	// output save settings button
	submit_button( 'Save Settings' );
	?>
	</form>
</div>
