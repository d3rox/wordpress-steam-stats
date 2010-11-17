<?php

function steam_stats_shortcode( $atts, $content, $tag ) {
	$options = get_option( 'steam_stats_options' );
	
	$defaults = array( 
					'username' => '',
					'limit' => 5,
					'unplayed' => 0
				);

	$atts = shortcode_atts( $defaults, $atts );
	
	if( empty( $atts['username'] ) )
		return __( 'Username must be specified', 'steam-stats' );

	$data = steam_stats_get_data( $atts['username'] );
	
	if( is_wp_error( $data ) )
		return $data->get_error_message();
	
	switch( $tag ) {
		case 'steam_profile':
			$content = '<p class="steam_stats steam_profile">';
			if( isset( $data['profile']->avatarIcon ) )
				$content .= '<img src="' . $data['profile']->avatarFull . '" />';
			$content .= "<span><a href='http://steamcommunity.com/id/{$atts['username']}/'>{$data['profile']->steamID}</a></span>";
			$content .= '<span>' . sprintf( __( 'Location: %1s', 'steam-stats' ), $data['profile']->location ) . '</span>';
			$content .= '<span>' . sprintf( __( 'Member Since: %1s', 'steam-stats' ), $data['profile']->memberSince ) . '</span>';
			$content .= '<span>' . sprintf( __( 'Steam Rating: %1s', 'steam-stats' ), $data['profile']->steamRating ) . '</span>';
			$content .= '<span>' . sprintf( __( 'Recent Play Time: %1s hours', 'steam-stats' ), $data['profile']->hoursPlayed2Wk ) . '</span>';
			$content .= '</p>';
			
			return $content;
		case 'steam_recent_games':
			$content = '<p class="steam_stats steam_recent_games">';
			for( $ii = 0; $ii < $atts['limit'] && isset( $data['games']->games->game[$ii]->hoursLast2Weeks ); $ii++ ) {
				$game = $data['games']->games->game[$ii];
				
				$content .= '<img src="' . $game->logo . '" />';
				$content .= "<span><a href='{$game->storeLink}'>{$game->name}</a></span>";
				$content .= '<span>' . sprintf( __( 'Recent Play Time: %1s hours', 'steam-stats' ), $game->hoursLast2Weeks ) . '</span>';
				$content .= '<span>' . sprintf( __( 'Total Play Time: %1s hours', 'steam-stats' ), $game->hoursOnRecord ) . '</span>';
			}
			$content .= '</p>';
			
			return $content;
		case 'steam_friends':
		case 'steam_groups':
		case 'steam_games':
	}
}
?>