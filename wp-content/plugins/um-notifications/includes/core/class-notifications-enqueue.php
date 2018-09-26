<?php
namespace um_ext\um_notifications\core;

if ( ! defined( 'ABSPATH' ) ) exit;


class Notifications_Enqueue {

	function __construct() {
	
		add_action('wp_enqueue_scripts',  array(&$this, 'wp_enqueue_scripts'), 9999);
		add_action('wp_footer',  array(&$this, 'wp_footer'), 9999999999999);

	}



	function wp_footer() { 
	
		if ( !is_user_logged_in() ) return;
		
	?>
		
		<script type="text/javascript">
		jQuery(document).ready(function() {

			<?php if ( UM()->options()->get( 'realtime_notify' ) == 1 ) {
				$timer = UM()->options()->get( 'realtime_notify_timer' );
				$timer = ! empty( $timer ) ? $timer : 45; ?>
				setInterval( um_load_notifications, <?php echo 1000 * $timer; ?> );
			<?php } ?>

		});
		</script>
	
	<?php }

	
	function wp_enqueue_scripts(){
		
		if ( !is_user_logged_in() ) return;

	    wp_register_script('moment', um_notifications_url . 'assets/js/moment-with-locales.min.js', '', '', true );
		wp_enqueue_script('moment');

		wp_register_script('moment-timezone', um_notifications_url . 'assets/js/moment-timezone.js', '', '', true );
		wp_enqueue_script('moment-timezone');	
		
        wp_register_style('um_notifications', um_notifications_url . 'assets/css/um-notifications.css' );
		
		wp_enqueue_style('um_notifications');
		
		wp_register_script('um_notifications', um_notifications_url . 'assets/js/um-notifications.js', array('jquery', 'wp-util'), '', true );
		wp_enqueue_script('um_notifications');
		

		// Localize time
		$timezone_array = array(
			'string' => get_option('timezone_string'),
			'offset' => get_option('gmt_offset'),
		);

		wp_localize_script( 'um_notifications', 'um_notifications_timezone', $timezone_array );

	}
	
}