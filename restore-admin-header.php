<?php
/*
Plugin Name: Restore Admin Header
Plugin URI: http://philipjohn.journallocal.co.uk/category/plugins/restore-admin-header/
Description: Add the link to your site back to the top of your WordPress admin!
Version: 0.1
Author: Philip John
Author URI: http://philipjohn.co.uk
License: GPL2
*/

/*
 * Localise the plugin
 */
load_plugin_textdomain('restore-admin-header');

/**
 * Adds the header to the admin interface
 */
function pj_rah_in_admin_header(){
?>
<div id="wphead">
<?php

if ( is_network_admin() )
	$blog_name = sprintf( __('%s Network Admin'), esc_html($current_site->site_name) );
elseif ( is_user_admin() )
	$blog_name = sprintf( __('%s Global Dashboard'), esc_html($current_site->site_name) );
else
	$blog_name = get_bloginfo('name', 'display');
if ( '' == $blog_name ) {
	$blog_name = __( 'Visit Site' );
} else {
	$blog_name_excerpt = wp_html_excerpt($blog_name, 40);
	if ( $blog_name != $blog_name_excerpt )
		$blog_name_excerpt = trim($blog_name_excerpt) . '&hellip;';
	$blog_name = $blog_name_excerpt;
	unset($blog_name_excerpt);
}
$title_class = '';
if ( function_exists('mb_strlen') ) {
	if ( mb_strlen($blog_name, 'UTF-8') > 30 )
		$title_class = 'class="long-title"';
} else {
	if ( strlen($blog_name) > 30 )
		$title_class = 'class="long-title"';
}
?>

<img id="header-logo" src="<?php echo esc_url( includes_url( 'images/blank.gif' ) ); ?>" alt="" width="16" height="16" />
<h1 id="site-heading" <?php echo $title_class ?>>
	<a href="<?php echo trailingslashit( get_bloginfo( 'url' ) ); ?>" title="<?php esc_attr_e('Visit Site') ?>">
		<span id="site-title"><?php echo $blog_name ?></span>
	</a>
</h1>
</div>
<?php
}
add_action('in_admin_header', 'pj_rah_in_admin_header');

function pj_rah_admin_head() {
	echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('restore-admin-header.css', __FILE__). '">';
}

add_action('admin_head', 'pj_rah_admin_head');

?>