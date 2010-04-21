<?php 

// Hook for initial setup
register_activation_hook( WP_PLUGIN_DIR . '/' . STEAM_STATS_FOLDER . '/steam-stats.php', 'steam_stats_activate' );

// Huh. Upgrades.
add_filter( 'upgrader_post_install', 'steam_stats_activate' );

// Translation hook
add_action( 'init', 'steam_stats_load_translation_file' );

foreach( $steam_stats_shortcodes as $sss ) {
	add_shortcode( $sss, 'steam_stats_shortcode' );
}

// Uninstall function
if( function_exists( 'register_uninstall_hook' ) )
	register_uninstall_hook( WP_PLUGIN_DIR . '/' . STEAM_STATS_FOLDER . '/steam-stats.php', 'steam_stats_uninstall' );

?>