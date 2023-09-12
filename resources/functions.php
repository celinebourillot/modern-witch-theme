<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

@ini_set( 'upload_max_size' , '128M' );

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page([
        'page_title' => get_bloginfo('name') . ' Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
        'capability' => 'edit_theme_options',
        'position'   => '999',
        'autoload'   => true
    ]);

};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
            'product-fields' => require dirname(__DIR__).'/config/acf-fields/customtypes-fields.php',
            'page-fields' => require dirname(__DIR__).'/config/acf-fields/page-fields.php',
            'blog-fields' => require dirname(__DIR__).'/config/acf-fields/blog-fields.php',
            'setting-fields' => require dirname(__DIR__).'/config/acf-fields/setting-fields.php',
            'breadcrumb' => require dirname(__DIR__).'/config/breadcrumb.php',
            'helpers' => require dirname(__DIR__).'/config/helpers.php',
            'woocommerce' => require dirname(__DIR__).'/config/woocommerce.php',
        ]);
    }, true);

    function excerpt($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
          array_pop($excerpt);
          $excerpt = implode(" ",$excerpt).'...';
        } else {
          $excerpt = implode(" ",$excerpt);
        }	
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;
      }

add_filter('asl_search_phrase_before_cleaning', 'asl_replace_characters', 10, 1);
function asl_replace_characters( $s ) {
	$characters = "'’‘"; 	 // Type characters one after another
	$replace_with = ' ';     // Replace them with this (space by default)

	// ------------------------------------------------------------------
	if ( is_array($s) ) {
		if ( isset($s['s']) && !$s['_ajax_search'] )
			$s['s'] = str_replace(str_split($characters), $replace_with, $s['s']);
	} else {
		$s = str_replace(str_split($characters), $replace_with, $s);
	}
    return $s;
}
      