<?php

function steam_stats_get_data( $username ) {
	$options = get_option( 'steam_stats_options' );
	
	// Check if the cache doesn't exist, or if it's older than 15 minutes.
	if( ! array_key_exists( $username, $options['cache'] ) || $options['cache'][$username]['timestamp'] + 15*60 < time() ) {
		$profile = simplexml_load_file( "http://steamcommunity.com/id/$username/?xml=1", 'SimpleXMLElement', LIBXML_NOCDATA );
		$games = simplexml_load_file( "http://steamcommunity.com/id/$username/games/?xml=1" );
		
		if( ! $profile )
			return new WP_Error( 'steam_profile_retrieval_failed', __( 'The request to Steam Community failed.', 'steam-stats' ) );

		if( isset( $profile->error ) )
			return new WP_Error( 'steam_server_error', sprintf( __( 'Steam returned the following error: %1s', 'steam-stats' ), $profile->error ) );
			
		$options['cache'][$username]['profile'] = $profile->asXML();
		$options['cache'][$username]['games'] = $games->asXML();
		$options['cache'][$username]['timestamp'] = time();
		
		update_option( 'steam_stats_options', $options );
	}
	
	$data = $options['cache'][$username];
	
	$data['profile'] = simplexml_load_string( $data['profile'], 'SimpleXMLElement', LIBXML_NOCDATA );
	$data['games'] = simplexml_load_string( $data['games'], 'SimpleXMLElement', LIBXML_NOCDATA );
	
	return $data;
}

function steam_stats_display_init() {
	wp_enqueue_style( 'steam-stats-display', STEAM_STATS_URL . '/css/display.css', false, STEAM_STATS_VERSION );
}

function steam_stats_plugin_row_meta( $links, $file ) {
	if( STEAM_STATS_BASENAME == $file ) {
		$links[] = '<a href="http://www.amazon.com/wishlist/1ORKI9ZG875BL">' . __( 'My Amazon Wish List', 'jobman' ) . '</a>';
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=gary%40pento%2enet&item_name=WordPress%20Plugin%20(Steam%20Stats)&item_number=Support%20Open%20Source&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8">' . __( 'Donate with PayPal', 'jobman' ) . '</a>';
	}
	
	return $links;
}

function steam_stats_load_translation_file() {
	load_plugin_textdomain( 'steam_stats', '', STEAM_STATS_FOLDER . '/translations' );
}

?>