<?php

function steam_stats_activate() {
	$options = get_option( 'steam_stats_options' );

	if( empty( $options ) ) {
		// Never been run before.
		steam_stats_create_default_options();
	}
	else if( $options['db_version'] < STEAM_STATS_DB_VERSION ) {
		// New version, upgrade time!
		steam_stats_upgrade_options();
	}
	
	$options = get_option( 'steam_stats_options' );
	$options['version'] = STEAM_STATS_VERSION;
	$options['db_version'] = STEAM_STATS_DB_VERSION;
	update_option( 'steam_stats_options', $options );
}

function steam_stats_create_default_options() {
	$options = array();
	
	$options['cache'] = array();
	
	update_option( 'steam_stats_options', $options );
}

function steam_stats_upgrade_options() {
	$options = get_option( 'steam_stats_options' );
	
	update_option( 'steam_stats_options', $options );
}

function steam_stats_uninstall() {
	delete_option( 'steam_stats_options' );
}
?>