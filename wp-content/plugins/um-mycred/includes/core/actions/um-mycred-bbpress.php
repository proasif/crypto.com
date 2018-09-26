<?php
if ( ! defined( 'ABSPATH' ) ) exit;


	/***
	***	@hide role
	***/
	add_action( 'um_bbpress_theme_after_reply_author_details', 'um_mycred_bb_norole' );
	function um_mycred_bb_norole() {
		if ( ! UM()->options()->get('mycred_hide_role') ) return; ?>
		
		<style type="text/css">
			div.bbp-author-role {display: none !important}
		</style>
		
		<?php

	}
	
	/***
	***	@show rank
	***/
	add_action( 'um_bbpress_theme_after_reply_author_details', 'um_mycred_bb_rank' );
	function um_mycred_bb_rank() {
		if ( ! UM()->options()->get('mycred_show_bb_rank') ) return;
		if ( !function_exists('mycred_get_users_rank') ) return;
		$reply_author_id = get_post_field( 'post_author', bbp_get_reply_id() );
		$rank = mycred_get_users_rank( $reply_author_id );
		
		// If the user has a rank, $rank will be an object
		if ( is_object( $rank ) ) {

			// Show rank title
			echo "<div class=\"um-mycred-bb-rank\">".$rank->title."</div>";
			
		}

	}
	
	/***
	***	@show points
	***/
	add_action( 'um_bbpress_theme_after_reply_author_details', 'um_mycred_bb_points' );
	function um_mycred_bb_points() {
		if ( ! UM()->options()->get('mycred_show_bb_points') ) return;
		$reply_author_id = get_post_field( 'post_author', bbp_get_reply_id() ); ?>
		
		<div class="um-mycred-bb-points"><?php echo UM()->myCRED_API()->get_points( $reply_author_id ); ?></div>
		
		<?php

	}
	
	/***
	***	@show progress
	***/
	add_action( 'um_bbpress_theme_after_reply_author_details', 'um_mycred_bb_rank_bar' );
	function um_mycred_bb_rank_bar() {
		if ( ! UM()->options()->get('mycred_show_bb_progress') ) return;
		
		if ( ! function_exists('mycred_get_users_rank') ) return;
		
		$user_id = get_post_field( 'post_author', bbp_get_reply_id() );
		
		$rank = mycred_get_users_rank( $user_id );
		
		if ( is_object( $rank ) ) {
			$progress = '<span class="um-mycred-progress um-tip-n" title="'. $rank->title . ' ' . (int) UM()->myCRED_API()->get_rank_progress( $user_id ) . '%"><span class="um-mycred-progress-done" style="" data-pct="'.UM()->myCRED_API()->get_rank_progress( $user_id ).'"></span></span>';
			
			?>
			
			<div class="um-mycred-bb-progress"><?php echo $progress; ?></div>
			
			<?php
		}

	}