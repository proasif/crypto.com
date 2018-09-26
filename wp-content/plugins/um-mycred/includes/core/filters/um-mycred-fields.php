<?php
if ( ! defined( 'ABSPATH' ) ) exit;


	/***
	***	@extend core fields
	***/
	add_filter("um_predefined_fields_hook", 'um_mycred_add_field', 10 );
	function um_mycred_add_field($fields){

		$fields['mycred_default'] = array(
				'title' => __('myCRED Balance','um-mycred'),
				'metakey' => 'mycred_default',
				'type' => 'text',
				'label' => __('myCRED Balance','um-mycred'),
				'required' => 0,
				'public' => 1,
				'editable' => 0,
				'icon' => 'um-faicon-trophy',
		);
		
		$fields['mycred_progress'] = array(
				'title' => __('myCRED Progress','um-mycred'),
				'metakey' => 'mycred_progress',
				'type' => 'text',
				'label' => __('myCRED Progress','um-mycred'),
				'required' => 0,
				'public' => 1,
				'editable' => 0,
				'edit_forbidden' => 1,
				'show_anyway' => true,
				'custom' => true,
		);
		
		$fields['mycred_badges'] = array(
				'title' => __('myCRED Badges','um-mycred'),
				'metakey' => 'mycred_badges',
				'type' => 'text',
				'label' => __('myCRED Badges','um-mycred'),
				'required' => 0,
				'public' => 1,
				'editable' => 0,
				'edit_forbidden' => 1,
				'show_anyway' => true,
				'custom' => true,
		);
		
		$fields['mycred_rank'] = array(
            'title' => __('myCRED Rank','um-mycred'),
            'metakey' => 'mycred_rank',
            'type' => 'select',
            'label' => __('myCRED Rank','um-mycred'),
            'required' => 0,
            'public' => 1,
            'editable' => 0,
            'edit_forbidden' => 1,
            'show_anyway' => true,
            'custom' => true,
            'options' => array()
		);
		
		return $fields;
		
	}
	
	/***
	***	@number format for points
	***/
	add_filter('um_profile_field_filter_hook__mycred_default', 'um_mycred_points_value', 99, 2);
	function um_mycred_points_value( $value, $data ) {
		return UM()->myCRED_API()->get_points( um_user('ID') );
	}
	
	/***
	***	@show user rank
	***/
	add_filter('um_profile_field_filter_hook__mycred_rank', 'um_mycred_show_rank_field', 99, 2);
	function um_mycred_show_rank_field( $value, $data ) {
		if ( !function_exists('mycred_get_users_rank') ) return null;
		$user_id = um_is_core_page('user') ? um_profile_id() : um_user('ID');
		$rank = mycred_get_users_rank( $user_id );

		if ( is_object( $rank ) ) {
			return $rank->title;
		}
		return;
	}
	
	/***
	***	@show user balance
	***/
	add_filter('um_profile_field_filter_hook__mycred_badges', 'um_mycred_show_badges_field', 99, 2);
	function um_mycred_show_badges_field( $value, $data ) {
		return UM()->myCRED_API()->show_badges( um_profile_id() );
	}
	
	/***
	***	@show user progress
	***/
	add_filter('um_profile_field_filter_hook__mycred_progress', 'um_mycred_show_progress_field', 99, 2);
	function um_mycred_show_progress_field( $value, $data ) {
		if ( !function_exists('mycred_get_users_rank') ) return null;
		
		$user_id = um_profile_id();
		
		$rank = mycred_get_users_rank( $user_id );
		if ( is_object( $rank ) ) {
			$progress = '<span class="um-mycred-progress um-tip-n" title="'. $rank->title . ' ' . (int) UM()->myCRED_API()->get_rank_progress( $user_id ) . '%"><span class="um-mycred-progress-done" style="" data-pct="'.UM()->myCRED_API()->get_rank_progress( $user_id ).'"></span></span>';
		}
		
		return $progress;
		
	}
	
	add_filter('um_allowed_user_tags_patterns', 'um_mycred_allowed_user_tags');
	function um_mycred_allowed_user_tags( $tags ) {
		$tags[] = '{mycred_balance}';
		return $tags;
	}
	
	add_filter('um_profile_tag_hook__mycred_balance', 'um_profile_tag_hook__mycred_balance', 10, 2);
	function um_profile_tag_hook__mycred_balance( $value, $user_id ) {
		return UM()->myCRED_API()->get_points( $user_id );
	}


    function um_mycred_members_directory_sort_dropdown_options( $options ) {
        $options['most_mycred_points'] = __( 'Most Points', 'um-mycred' );
        $options['least_mycred_points'] = __( 'Least Points', 'um-mycred' );

        return $options;
    }
    add_filter( 'um_members_directory_sort_dropdown_options', 'um_mycred_members_directory_sort_dropdown_options', 10, 1 );