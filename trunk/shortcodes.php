<?php

function steam_stats_shortcode( $atts, $content, $tag ) {
	$options = get_option( 'steam_stats_options' );
	
	$defaults = array( 
					'username' => '',
					'limit' => 5,
					'unplayed' => 0
				);
	$atts = shortcode_atts( $defaults, 
	switch( $tag ) {
		case 'steam_profile':
		case 'steam_friends':
		case 'steam_groups':
		case 'steam_games':
	}
}
?>