<?php
if ( ! defined( 'ABSPATH' ) ) exit;


	/***
	***	@reset user cached balance
	***/
	add_action('mycred_update_user_balance', 'um_mycred_reset_cache', 9999, 4 );
	function um_mycred_reset_cache( $user_id, $current_balance, $amount, $type ) {
		delete_option( "um_cache_userdata_{$user_id}" );
	}
	
	/***
	***	@on account page when social login is enabled
	***/
	add_action('um_social_login_after_provider_title', 'um_mycred_social_login_credit', 10, 2);
	function um_mycred_social_login_credit( $provider, $array ) {
		if ( ! UM()->options()->get('mycred_'.$provider) ) return;
		if ( UM()->Social_Login_API()->is_connected( get_current_user_id(), $provider ) ) return;
		
		$points = UM()->options()->get('mycred_'.$provider.'_points');
		
		?>
		
		<div class="um-mycred-light"><?php printf(__('Add %s points to your balance by connecting to this network.','um-mycred'), $points); ?></div>
		
		<?php
	}
	
	/***
	***	@errors for transfering points
	***/
	add_action( 'um_submit_account_points_tab_errors_hook', 'um_mycred_account_transfer_errors');
	function um_mycred_account_transfer_errors( $args ) {
		if ( isset($_POST['um_mycred_transfer']) && $_POST['um_mycred_transfer'] != _e( 'Confirm Transfer', 'um-mycred' ) ) {
			if ( $_POST['mycred_transfer_uid'] && $_POST['mycred_transfer_amount'] ) {
			
				$user = $_POST['mycred_transfer_uid'];
				$amount = $_POST['mycred_transfer_amount'];
				
				if ( !um_user('can_transfer_mycred') ) {
					$r = UM()->account()->tab_link( 'points' );
					$r = add_query_arg( 'err', 'mycred_unauthorized', $r );
					exit( wp_redirect( $r ) );
				}
				
				if ( is_numeric( $user ) ){
					if ( $user == get_current_user_id() ) {
						$r = UM()->account()->tab_link( 'points' );
						$r = add_query_arg( 'err', 'mycred_myself', $r );
						exit( wp_redirect( $r ) );
					}
					if ( ! UM()->user()->user_exists_by_id( $user ) ) {
						$r = UM()->account()->tab_link( 'points' );
						$r = add_query_arg( 'err', 'mycred_invalid_user', $r );
						exit( wp_redirect( $r ) );
					}
				} else {
					if ( !username_exists( $user ) && !email_exists( $user ) ) {
						$r = UM()->account()->tab_link( 'points' );
						$r = add_query_arg( 'err', 'mycred_invalid_user', $r );
						exit( wp_redirect( $r ) );
					}
				}
				
				if ( is_numeric( $user ) ) {
					$user_id = $user;
				} else if ( is_email( $user ) ){
					$user_id = email_exists( $user );
				} else {
					$user_id = username_exists( $user );
				}
				
				// check if user can receive points
				um_fetch_user( $user_id );
				if ( um_user('cannot_receive_mycred') ) {
					$r = UM()->account()->tab_link('points');
					$r = add_query_arg( 'err', 'mycred_cant_receive', $r );
					exit( wp_redirect( $r ) );
				}
				
				if ( !is_numeric($amount) ) {
					$r = UM()->account()->tab_link('points');
					$r = add_query_arg( 'err', 'mycred_invalid_amount', $r );
					exit( wp_redirect( $r ) );
				}
				
				if ( $amount > UM()->myCRED_API()->get_points_clean( get_current_user_id() ) ) {
					$r = UM()->account()->tab_link('points');
					$r = add_query_arg( 'err', 'mycred_not_enough_balance', $r );
					exit( wp_redirect( $r ) );
				}

				UM()->myCRED_API()->transfer( get_current_user_id(), $user_id, $amount );
				$r = UM()->account()->tab_link('points');
				$r = add_query_arg( 'updated', 'mycred_transfer_done', $r );
				exit( wp_redirect( $r ) );
				
			}
		}
		
	}