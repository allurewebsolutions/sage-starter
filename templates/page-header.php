<?php if (function_exists('bcn_display') && !is_front_page() && !get_theme_mod('hide-breadcrumbs')) {
  /** breadcrumbs **/
  get_template_part('templates/components/breadcrumbs');
} ?>

<?php if (!get_theme_mod('hide-jumbotron')) {
  get_template_part('templates/components/jumbotron');
}
