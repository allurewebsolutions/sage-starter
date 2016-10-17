<?php use Roots\Sage\Titles; ?>

<!-- Jumbotron -->
<div class="jumbotron">
  <div class="container">
    <h1><?= Roots\Sage\Titles\title(); ?></h1>
    <?php if (get_theme_mod('jumbotron-tagline') != '') : ?>
      <h4><?php echo get_theme_mod('jumbotron-tagline'); ?></h4>
    <?php endif; ?>
  </div>
</div>

