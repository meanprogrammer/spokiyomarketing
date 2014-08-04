<?php
/**
 * Plugin Name: Email only mailchimp Subscribe 
 * Plugin URI: http://www.wphigh.com/portfolio/my-hello-dolly
 * Description:This plugin make you custom lyrics, quotes or any other words in the upper right of your admin screen on every page, like Hello Dolly plugin.
 * Version: 1.0.0
 * Author: wphigh
 * Author URI: http://www.wphigh.com
 * Text Domain: my_hello_dolly
 * License: GPLv2 or later
 */
 
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2 or later, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Hooks the WordPress admin_head action to inject some JS.
 *
 * @return void
 * @author Simon Wheatley
 **/
function eoms_admin_js() {
	echo <<<END
<script type="text/javascript">
//<![CDATA[
	jQuery('#signuplink').click(function(){
		alert('hello');
	});
//]]>
</script>
END;
}

function eoms_init() {
	// Call this function on the get_pages filter
	// (get_pages filter appears to only be called on the "consumer" side of WP,
	// the admin side must use another function to get the pages. So we're safe to
	// remove these pages every time.)
	//add_filter('get_pages','ep_exclude_pages');
	// Load up the translation gear
	//$locale = get_locale();
	//$folder = rtrim( basename( dirname( __FILE__ ) ), '/' );
	//$mo_file = trailingslashit( WP_PLUGIN_DIR ) . "$folder/locale/" . EP_TD . "-$locale.mo";
	//load_textdomain( EP_TD, $mo_file );
}

function eoms_admin_init() {
	// Add panels into the editing sidebar(s)
	//global $wp_version;
	//add_meta_box('ep_admin_meta_box', __( 'Exclude Pages', EP_TD ), 'ep_admin_sidebar_wp25', 'page', 'side', 'low');

	// Set the exclusion when the post is saved
	//add_action('save_post', 'ep_update_exclusions');

	// Add the JS & CSS to the admin header
	//add_action('admin_head', 'ep_admin_css');
	add_action('admin_footer', 'eoms_admin_js');

	// Call this function on our very own hec_show_dbx filter
	// This filter is harmless to add, even if we don't have the 
	// Hide Editor Clutter plugin installed as it's using a custom filter
	// which won't be called except by the HEC plugin.
	// Uncomment to show the control by default
	// add_filter('hec_show_dbx','ep_hec_show_dbx');
}

// HOOK IT UP TO WORDPRESS

add_action( 'init', 'eoms_init' );
add_action( 'admin_init', 'eoms_admin_init' );

?>