<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes)
{
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}

add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more()
{
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}

add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 */
if (!function_exists('sage_the_custom_logo')) :
  function sage_the_custom_logo()
  {
    if (function_exists('the_custom_logo')) {
      $custom_logo = '<img src="' . wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') . '" alt="' . get_bloginfo('name') . '" />';
      echo $custom_logo;
    }
  }
endif;


/**
 * Numeric page navigation
 *
 * Use this function to create pagingation links that are styleable with Twitter Bootstrap
 * http://www.lanexa.net/2012/09/add-twitter-bootstrap-pagination-to-your-wordpress-theme/
 */
if (!function_exists('page_navi')) :
  function page_navi($before = '', $after = '')
  {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page) {
      return;
    }
    if (empty($paged) || $paged == 0) {
      $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;
    if ($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if ($start_page <= 0) {
      $start_page = 1;
    }

    echo $before . '<ul class="pagination">' . "";
    if ($paged > 1) {
      $first_page_text = "<span class='glyphicon glyphicon-home'></span>";
      echo '<li class="prev"><a href="' . get_pagenum_link() . '" title="First">' . $first_page_text . '</a></li>';
    }

    $prevposts = get_previous_posts_link('&laquo;');
    if ($prevposts) {
      echo '<li>' . $prevposts . '</li>';
    } else {
      echo '<li class="disabled"><a href="#">&laquo;</a></li>';
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
      if ($i == $paged) {
        echo '<li class="active"><a href="#">' . $i . '</a></li>';
      } else {
        echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
      }
    }
    echo '<li class="">';
    next_posts_link('&raquo;');
    echo '</li>';
    if ($end_page < $max_page) {
      $last_page_text = "»";
      echo '<li class="next"><a href="' . get_pagenum_link($max_page) . '" title="Last">' . $last_page_text . '</a></li>';
    }
    echo '</ul>' . $after . "";
  }
endif;
