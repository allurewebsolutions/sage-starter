<footer class="content-info">
  <div class="container-fluid footer-widgets">
    <div class="container">
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
  </div>
  <div class="container-fluid footer-bottom">
    <div class="container">
      <p class="copyright">
        <?php echo get_theme_mod('copyright', 'Copyright ' . current_time('Y') . ' &copy; <a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a>. All Rights Reserved.'); ?>
      </p>
    </div>
  </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

<?php
/**
 * Pull in header options defined by ACF plugin
 */
if (class_exists('acf')) {
  get_template_part('templates/components/header-options');
}
?>
