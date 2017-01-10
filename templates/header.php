<?php
// This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
// somewhere in your theme.
?>

<?php if (!get_theme_mod('hide-header')) { ?>
  <header class="container-fluid">
    <div class="row">
      <div class="banner navbar navbar-default navbar-static-top affix" role="banner">
        <div class="container">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
              <?php
              /**
               * Display logo from Appearance > Customize or blog name if logo not set
               */
              has_custom_logo() ? Roots\Sage\Extras\sage_the_custom_logo() : bloginfo('name'); ?>
            </a>
          </div>

          <nav class="collapse navbar-collapse" role="navigation">
            <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu([
                'theme_location' => 'primary_navigation'
                , 'walker' => new wp_bootstrap_navwalker()
                , 'menu_class' => 'nav navbar-nav pull-right'
              ]);
            endif;
            ?>
          </nav>
        </div><!-- /.container -->
      </div><!-- /.navbar -->
    </div><!-- /.row -->


    <?php
    /**
     * Pull in header content defined by ACF plugin
     */
    if (class_exists('acf')) {
      get_template_part('templates/components/header-content');
    }
    ?>

  </header><!-- /.container-fluid -->

<?php } ?>
