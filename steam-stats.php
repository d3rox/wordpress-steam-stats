<?php //encoding: utf-8
/*
Plugin Name: Steam Stats
Plugin URI: http://pento.net/projects/wordpress-steam-stats-plugin/
Description: A plugin to display your Steam Gameplay statistics in any page or post.
Version: 0.1
Author: Gary Pendergast
Author URI: http://pento.net/
Text Domain: steam-stats
Tags: steam, stats, statistics, steam community, games, tf2, l4d, l4d2, cs, cs2
*/

/*
    Copyright 2010 Gary Pendergast (http://pento.net/)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Version
define( 'STEAM_STATS_VERSION', '0.1' );
define( 'STEAM_STATS_DB_VERSION', 1 );

// Define the URL to the plugin folder
define( 'STEAM_STATS_FOLDER', 'steam-stats' );
if( ! defined( 'STEAM_STATS_URL' ) )
	define( 'STEAM_STATS_URL', WP_PLUGIN_URL . '/' . STEAM_STATS_FOLDER );

// Define the basename
define( 'STEAM_STATS_BASENAME', plugin_basename(__FILE__) );

// Our Shortcodes
global $steam_stats_shortcodes;
$steam_stats_shortcodes = array( 'steam_profile', 'steam_recent_games', 'steam_friends', 'steam_groups', 'steam_games' );

//
// Load Steam Stats
//

// Global functions
require_once( dirname( __FILE__ ) . '/functions.php' );

// Setup (for installation/upgrades)
require_once( dirname( __FILE__ ) . '/setup.php' );

// Shortcode handling
require_once( dirname( __FILE__ ) . '/shortcodes.php' );

// Add hooks at the end
require_once( dirname( __FILE__ ) . '/hooks.php' );

?>