<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;


function customize_register($wp_customize)
{
  /**
   * Add postMessage support
   */
  $wp_customize->get_setting('blogname')->transport = 'postMessage';

  /**
   * Add Custom Theme Options
   */
  $wp_customize->add_panel('theme_options', array(
    'priority' => 10,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Theme Options', 'textdomain'),
    'description' => __('Theme specific options', 'textdomain'),
  ));

  /**
   * Inner Page Banner
   */
  $wp_customize->add_section('jumbotron', array(
    'priority' => 10,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Jumbotron', 'textdomain'),
    'description' => 'The is the jumbotron that appears below the header and above the page content. It container the page title and an optional tagline.',
    'panel' => 'theme_options',
  ));

  $wp_customize->add_setting('jumbotron-tagline', array(
    //'default' => 'Welcome to ' . get_bloginfo('name'),
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'transport' => '',
    //'sanitize_callback' => 'esc_textarea',
  ));

  $wp_customize->add_control('jumbotron-tagline', array(
    'type' => 'textarea',
    'priority' => 10,
    'section' => 'jumbotron',
    'label' => __('Jumbotron Tagline', 'textdomain'),
    'description' => 'You can use HTML here',
  ));


  /**
   * Footer Section
   */
  $wp_customize->add_section('footer', array(
    'priority' => 10,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Footer', 'textdomain'),
    'description' => '',
    'panel' => 'theme_options',
  ));

  $wp_customize->add_setting('copyright', array(
    'default' => 'Copyright ' . current_time('Y') . ' &copy; ' . get_bloginfo('name') . '. All Rights Reserved.',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'transport' => '',
    //'sanitize_callback' => 'esc_textarea',
  ));

  $wp_customize->add_control('copyright', array(
    'type' => 'textarea',
    'priority' => 10,
    'section' => 'footer',
    'label' => __('Footer Copyright', 'textdomain'),
    'description' => 'You can use HTML here',
  ));
}

add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js()
{
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}

add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
