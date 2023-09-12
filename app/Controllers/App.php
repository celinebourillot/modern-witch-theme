<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return str_replace("Archives: ", "", get_the_archive_title());
        }
        if (is_search()) {
            return sprintf(__('Search Results for "%s"', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public function themesettings()
    {
      return (object) array(
      'logo' => get_field('logo_header','option'),
      'name' => get_field('company_name','option'),
      'favicon' => get_field('favicon','option'),
      'address' => get_field('company_address','option'),
      'footerInfo' => get_field('footer_info','option'),
      'facebook' => get_field('facebook','option'),
      'twitter' => get_field('twitter','option'),
      'linkedin' => get_field('linkedin','option'),
      'instagram' => get_field('instagram','option'),
      'google' => get_field('google','option'),
      'youtube' => get_field('youtube','option'),
      'tracking_code' => get_field('header_code','option')
      );

    }
}
